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

    /**
     * Unda appointment mpya pamoja na vipimo (transaction).
     * @return int appointment id
     */
    public function create(array $data, array $testIds): int
    {
        $this->conn->begin_transaction();

        try {
            $sql = "INSERT INTO appointments
                    (patient_id, doctor_id, laboratory_id, appointment_date, appointment_time,
                     type, sample_collection, address, status, priority, notes)
                    VALUES (?, ?, ?, ?, ?, 'lab_test', ?, ?, 'pending', ?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(
                'iiissssss',
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

            $appointmentId = (int) $this->conn->insert_id;

            $testStmt = $this->conn->prepare(
                'INSERT INTO appointment_tests (appointment_id, test_id) VALUES (?, ?)'
            );

            foreach ($testIds as $testId) {
                $tid = (int) $testId;
                $testStmt->bind_param('ii', $appointmentId, $tid);
                $testStmt->execute();
            }

            $this->addHistory($appointmentId, 'pending', $data['patient_id'], 'Appointment created by patient');

            $this->conn->commit();
            return $appointmentId;
        } catch (Throwable $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    /** Rekodi mabadiliko ya status */
    public function addHistory(int $appointmentId, string $status, int $changedBy, string $notes): void
    {
        $stmt = $this->conn->prepare(
            'INSERT INTO appointment_history (appointment_id, status, changed_by, notes) VALUES (?, ?, ?, ?)'
        );
        $stmt->bind_param('isis', $appointmentId, $status, $changedBy, $notes);
        $stmt->execute();
    }

    /** Badilisha status ya appointment */
    public function updateStatus(int $appointmentId, string $status, int $changedBy, string $notes): bool
    {
        $allowed = ['pending', 'approved', 'completed', 'cancelled'];
        if (!in_array($status, $allowed, true)) {
            return false;
        }

        $this->conn->begin_transaction();
        try {
            $stmt = $this->conn->prepare('UPDATE appointments SET status = ? WHERE id = ?');
            $stmt->bind_param('si', $status, $appointmentId);
            $stmt->execute();

            $this->addHistory($appointmentId, $status, $changedBy, $notes);
            $this->conn->commit();
            return true;
        } catch (Throwable $e) {
            $this->conn->rollback();
            return false;
        }
    }

    /** Miadi ya mgonjwa (users.id) */
    public function getByPatientId(int $patientUserId): array
    {
        $sql = "SELECT a.*, d.full_name AS doctor_name, l.labo_name
                FROM appointments a
                LEFT JOIN users d ON d.id = a.doctor_id
                LEFT JOIN laboratories l ON l.id = a.laboratory_id
                WHERE a.patient_id = ?
                ORDER BY a.appointment_date DESC, a.appointment_time DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $patientUserId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /** Miadi ya daktari */
    public function getByDoctorId(int $doctorUserId): array
    {
        $sql = "SELECT a.*, p.full_name AS patient_name, l.labo_name
                FROM appointments a
                JOIN users p ON p.id = a.patient_id
                LEFT JOIN laboratories l ON l.id = a.laboratory_id
                WHERE a.doctor_id = ?
                ORDER BY a.appointment_date DESC, a.appointment_time DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $doctorUserId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /** Maombi ya maabara */
    public function getByLaboratoryId(int $laboratoryId, array $statuses): array
    {
        if (empty($statuses)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($statuses), '?'));
        $types = 'i' . str_repeat('s', count($statuses));

        $sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.status, a.priority,
                       u.full_name AS patient_name
                FROM appointments a
                JOIN users u ON u.id = a.patient_id
                WHERE a.laboratory_id = ? AND a.status IN ($placeholders)
                ORDER BY a.priority DESC, a.appointment_date ASC, a.appointment_time ASC";

        $stmt = $this->conn->prepare($sql);
        $params = array_merge([$laboratoryId], $statuses);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /** Appointments zisizo na matokeo bado (kwa upload) */
    public function getPendingUploadByLaboratoryId(int $laboratoryId): array
    {
        $sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.status,
                       u.full_name AS patient_name
                FROM appointments a
                JOIN users u ON u.id = a.patient_id
                LEFT JOIN test_results tr ON tr.appointment_id = a.id
                WHERE a.laboratory_id = ?
                  AND a.status IN ('pending', 'approved')
                  AND tr.id IS NULL
                ORDER BY a.appointment_date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $laboratoryId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /** Hesabu kwa patient + status */
    public function countByPatientAndStatus(int $patientId, string $status): int
    {
        $stmt = $this->conn->prepare(
            'SELECT COUNT(*) AS total FROM appointments WHERE patient_id = ? AND status = ?'
        );
        $stmt->bind_param('is', $patientId, $status);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }

    /** Jumla ya appointments */
    public function countAll(): int
    {
        $result = $this->conn->query('SELECT COUNT(*) AS total FROM appointments');
        $row = $result->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }

    /** Hesabu kwa lab + status */
    public function countByLaboratoryAndStatus(int $labId, string $status): int
    {
        $stmt = $this->conn->prepare(
            'SELECT COUNT(*) AS total FROM appointments WHERE laboratory_id = ? AND status = ?'
        );
        $stmt->bind_param('is', $labId, $status);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }
    /**
 * Get appointment by ID used for payment processing and other operations. afterwards, you can use 
 * the appointment ID to retrieve related payment information.
 * so this work together with the PaymentRepository to manage payments for appointments.
 * without this method, you would have to query the database directly to get the appointment details before processing a payment.
 */
public function getById(int $id): ?array
{
    $sql = "
        SELECT *
        FROM appointments
        WHERE id = ?
        LIMIT 1
    ";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param(
        'i',
        $id
    );

    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_assoc() ?: null;
}
}