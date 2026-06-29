<?php

class ActivityLogRepository
{
    private mysqli $conn;


    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }



    public function getByLaboratoryId(int $labId): array
    {

        $stmt = $this->conn->prepare(
            "SELECT 
                al.*,
                u.full_name AS user_name,
                a.appointment_date,
                a.status

            FROM activity_logs al

            LEFT JOIN users u
            ON u.id = al.user_id

            LEFT JOIN appointments a
            ON a.id = al.appointment_id

            WHERE al.laboratory_id=?

            ORDER BY al.created_at DESC

            LIMIT 10"
        );


        $stmt->bind_param(
            'i',
            $labId
        );


        $stmt->execute();


        return $stmt->get_result()
        ->fetch_all(MYSQLI_ASSOC);

    }

}