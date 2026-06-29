<?php
/**
 * AppointmentRepository — SQL zote za appointments + history.
 */

class AppointmentRepository
{
    private mysqli $conn;


    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }




// function to create a new appointment with associated tests
    public function create(array $data, array $testIds): int
    {
        $this->conn->begin_transaction();

        try {

            $sql = "INSERT INTO appointments
            (
                rebooked_from_id,
                patient_id,
                doctor_id,
                laboratory_id,
                appointment_date,
                appointment_time,
                type,
                sample_collection,
                address,
                status,
                priority,
                notes
            )
            VALUES (?,?, ?, ?, ?, ?, 'lab_test', ?, ?, 'pending', ?, ?)";


            $stmt=$this->conn->prepare($sql);


            $stmt->bind_param(
                'iiiissssss',
                $data['rebooked_from_id'],
                $data['patient_id'],
                $data['doctor_id'],
                $data['laboratory_id'],
                $data['appointment_date'],
                $data['appointment_time'],
                $data['sample_collection'],
                $data['address'],
                $data['priority'],
                $data['notes']
            );


            $stmt->execute();


            $appointmentId=(int)$this->conn->insert_id;
            


            $activitySql = "INSERT INTO activity_logs(user_id, appointment_id, laboratory_id, action)
            VALUES (?,?,?,?)";
            $activityStmt = $this->conn->prepare($activitySql);
            $action = "New appointment received";
            $activityStmt->bind_param(
                "iiis", 
                $data['patient_id'],
                $appointmentId, 
                $data['laboratory_id'],
                $action
            );
            if (!$activityStmt->execute()) {
                throw new Exception($activityStmt->error);
            }
            



            $testStmt=$this->conn->prepare(
                "INSERT INTO appointment_tests
                (appointment_id,test_id)
                VALUES (?,?)"
            );


            foreach($testIds as $testId){

                $tid=(int)$testId;

                $testStmt->bind_param(
                    'ii',
                    $appointmentId,
                    $tid
                );

                $testStmt->execute();
            }



            $this->addHistory(
                $appointmentId,
                'pending',
                $data['patient_id'],
                'Appointment created by patient'
            );


            $this->conn->commit();


            return $appointmentId;


        }catch(Throwable $e){

            $this->conn->rollback();

            die($e->getMessage());
        }

    }






// Add a new entry to the appointment history
    public function addHistory(
        int $appointmentId,
        string $status,
        int $changedBy,
        string $notes
    ): void
    {

        $stmt=$this->conn->prepare(
            "INSERT INTO appointment_history
            (
                appointment_id,
                status,
                changed_by,
                notes
            )
            VALUES (?,?,?,?)"
        );


        $stmt->bind_param(
            'isis',
            $appointmentId,
            $status,
            $changedBy,
            $notes
        );


        $stmt->execute();

    }






// Update appointment status
    public function updateStatus(
        int $appointmentId,
        string $status,
        int $changedBy,
        string $notes
    ): bool
    {


        $allowed=[
            'pending',
            'paid',
            'approved',
            'rejected',
            'completed',
            'cancelled'
        ];


        if(!in_array($status,$allowed,true)){

            return false;
        }




        $this->conn->begin_transaction();


        try{


            if($status === 'rejected'){


                $stmt=$this->conn->prepare(
                    "UPDATE appointments
                     SET status=?,
                     rejection_reason=?
                     WHERE id=?"
                );


                $stmt->bind_param(
                    'ssi',
                    $status,
                    $notes,
                    $appointmentId
                );


            }else{


                $stmt=$this->conn->prepare(
                    "UPDATE appointments
                     SET status=?
                     WHERE id=?"
                );


                $stmt->bind_param(
                    'si',
                    $status,
                    $appointmentId
                );

            }



            if(!$stmt->execute()){
                throw new Exception($stmt->error);
            }
                
            



            $this->addHistory(
                $appointmentId,
                $status,
                $changedBy,
                $notes
            );



            $this->conn->commit();


            return true;


        }catch(Throwable $e){

            $this->conn->rollback();

            return false;
        }

    }
    

    // function to get all appointments for a specific patient
    public function getByPatientId(int $patientUserId): array
{

    $stmt=$this->conn->prepare(

    "SELECT a.*,
    d.full_name AS doctor_name,
    l.labo_name,
    p.payment_status

    FROM appointments a

    LEFT JOIN users d
    ON d.id=a.doctor_id

    LEFT JOIN laboratories l
    ON l.id=a.laboratory_id

    LEFT JOIN payments p
    ON p.appointment_id=a.id

    WHERE a.patient_id=?

    AND NOT EXISTS (

        SELECT 1
        FROM appointments r
        WHERE r.rebooked_from_id = a.id

    )

    ORDER BY 
    a.appointment_date DESC"

    );


    $stmt->bind_param(
        'i',
        $patientUserId
    );


    $stmt->execute();


    return $stmt->get_result()
    ->fetch_all(MYSQLI_ASSOC);

}









    // function to get all appointments for a specific laboratory
    public function getByLaboratoryId(
        int $laboratoryId,
        array $statuses
    ): array
    {


        if(empty($statuses)){

            return [];

        }



        $placeholders=implode(
            ',',
            array_fill(0,count($statuses),'?')
        );


        $types='i'.str_repeat(
            's',
            count($statuses)
        );



        $sql="SELECT

        a.id,
        a.appointment_date,
        a.appointment_time,
        a.status,
        a.priority,
        a.rejection_reason,

        u.full_name AS patient_name,
        GROUP_CONCAT(lt.test_name  SEPARATOR ', ') AS test_name,

        p.payment_status


        FROM appointments a


        JOIN users u
        ON u.id=a.patient_id


        LEFT JOIN payments p
        ON p.appointment_id=a.id

        LEFT JOIN appointment_tests at
        ON at.appointment_id=a.id

        LEFT JOIN lab_tests lt
        ON lt.id=at.test_id


        WHERE a.laboratory_id=?

        AND a.status IN($placeholders)


        GROUP BY a.id
        
        ORDER BY
        a.priority='urgent' DESC,
        a.appointment_date ASC";



        $stmt=$this->conn->prepare($sql);



        $params=array_merge(
            [$laboratoryId],
            $statuses
        );


        $stmt->bind_param(
            $types,
            ...$params
        );


        $stmt->execute();


        return $stmt->get_result()
        ->fetch_all(MYSQLI_ASSOC);

    }






   // function to get all pending appointments for a specific laboratory
    public function getPendingUploadByLaboratoryId(
        int $laboratoryId
    ): array
    {

        $stmt=$this->conn->prepare(

        "SELECT

        a.id,
        a.appointment_date,
        a.appointment_time,
        a.status,

        u.full_name AS patient_name


        FROM appointments a


        JOIN users u
        ON u.id=a.patient_id


        LEFT JOIN test_results tr
        ON tr.appointment_id=a.id


        WHERE a.laboratory_id=?

        AND a.status='approved'

        AND tr.id IS NULL"

        );


        $stmt->bind_param(
            'i',
            $laboratoryId
        );


        $stmt->execute();


        return $stmt->get_result()
        ->fetch_all(MYSQLI_ASSOC);

    }






   // function to get appointment by ID
    public function getById(int $id): ?array
    {

        $stmt=$this->conn->prepare(
            "SELECT *
             FROM appointments
             WHERE id=?
             LIMIT 1"
        );


        $stmt->bind_param(
            'i',
            $id
        );


        $stmt->execute();


        return $stmt->get_result()
        ->fetch_assoc() ?: null;

    }






    // function to get appointment by ID
    public function countByPatientAndStatus(
        int $patientId,
        string $status
    ): int
    {

        $stmt=$this->conn->prepare(
            "SELECT COUNT(*) AS total
             FROM appointments
             WHERE patient_id=?
             AND status=?"
        );


        $stmt->bind_param(
            'is',
            $patientId,
            $status
        );


        $stmt->execute();


        $row=$stmt->get_result()->fetch_assoc();


        return (int)($row['total'] ?? 0);

    }







   // function to count all appointments
    public function countAll(): int
    {

        $result=$this->conn->query(
            "SELECT COUNT(*) AS total
             FROM appointments"
        );


        $row=$result->fetch_assoc();


        return (int)($row['total'] ?? 0);

    }






// function to count all appointments for a specific laboratory and status
    public function countByLaboratoryAndStatus(
        int $labId,
        string $status
    ): int
    {

        $stmt=$this->conn->prepare(
            "SELECT COUNT(*) AS total
             FROM appointments
             WHERE laboratory_id=?
             AND status=?"
        );


        $stmt->bind_param(
            'is',
            $labId,
            $status
        );


        $stmt->execute();


        $row=$stmt->get_result()->fetch_assoc();


        return (int)($row['total'] ?? 0);

    }

    // function to get all test ids associated with an appointment
    public function getTestsByAppointmentId(int $id): array
{

$stmt=$this->conn->prepare(

"SELECT test_id
FROM appointment_tests
WHERE appointment_id=?"

);


$stmt->bind_param('i',$id);

$stmt->execute();


return array_column(
$stmt->get_result()->fetch_all(MYSQLI_ASSOC),
'test_id'
);

}

// Count appointments by status (Admin)
public function countByStatus(string $status): int
{
    $stmt = $this->conn->prepare(
        "SELECT COUNT(*) AS total
         FROM appointments
         WHERE status=?"
    );

    $stmt->bind_param(
        's',
        $status
    );

    $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();

    return (int)($row['total'] ?? 0);
}





// Get latest appointments for admin dashboard
public function getRecentAppointments(int $limit = 5): array
{

    $stmt = $this->conn->prepare(

        "SELECT 
            a.id,
            a.appointment_date,
            a.appointment_time,
            a.status,
            a.rejection_reason,

            u.full_name AS patient_name,

            l.labo_name,

            p.payment_status


        FROM appointments a


        LEFT JOIN users u
        ON u.id=a.patient_id


        LEFT JOIN laboratories l
        ON l.id=a.laboratory_id


        LEFT JOIN payments p
        ON p.appointment_id=a.id


        ORDER BY a.created_at DESC

        LIMIT ?"

    );


    $stmt->bind_param(
        'i',
        $limit
    );


    $stmt->execute();


    return $stmt->get_result()
    ->fetch_all(MYSQLI_ASSOC);

}






// Count payments by status (Admin)
public function countPayments(string $paymentStatus): int
{

    $stmt=$this->conn->prepare(

        "SELECT COUNT(*) AS total
         FROM payments
         WHERE payment_status=?"

    );


    $stmt->bind_param(
        's',
        $paymentStatus
    );


    $stmt->execute();


    $row=$stmt->get_result()->fetch_assoc();


    return (int)($row['total'] ?? 0);

}


}