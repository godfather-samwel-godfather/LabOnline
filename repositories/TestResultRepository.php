<?php
/**
 * TestResultRepository — SQL za test_results.
 */
class TestResultRepository
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Pakia matokeo + kamilisha appointment (transaction).
     */
    public function uploadAndComplete(
        int $appointmentId,
        int $uploadedBy,
        string $resultFile,
        string $remarks
    ): bool {
        $this->conn->begin_transaction();

        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO test_results (appointment_id, uploaded_by, result_file, remarks, status)
                 VALUES (?, ?, ?, ?, 'uploaded')"
            );
            $stmt->bind_param('iiss', $appointmentId, $uploadedBy, $resultFile, $remarks);
            $stmt->execute();

            $update = $this->conn->prepare("UPDATE appointments SET status = 'completed' WHERE id = ?");
            $update->bind_param('i', $appointmentId);
            $update->execute();

            $history = $this->conn->prepare(
                "INSERT INTO appointment_history (appointment_id, status, changed_by, notes)
                 VALUES (?, 'completed', ?, 'Lab uploaded test result')"
            );
            $history->bind_param('ii', $appointmentId, $uploadedBy);
            $history->execute();

            $this->conn->commit();
            return true;
        } catch (Throwable $e) {
            $this->conn->rollback();
            return false;
        }
    }

    /** Matokeo ya mgonjwa */
    public function getByPatientUserId(int $patientUserId): array
    {
        $sql = "SELECT tr.id, tr.result_file, tr.remarks, tr.status, tr.uploaded_at,
                       a.id AS appointment_id, a.appointment_date
                FROM test_results tr
                JOIN appointments a ON a.id = tr.appointment_id
                WHERE a.patient_id = ?
                ORDER BY tr.uploaded_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $patientUserId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /** Matokeo kwa daktari (wagonjwa wake) */
    public function getByDoctorUserId(int $doctorUserId): array
    {
        $sql = "SELECT tr.id, tr.result_file, tr.remarks, tr.status, tr.uploaded_at,
                       a.id AS appointment_id, p.full_name AS patient_name
                FROM test_results tr
                JOIN appointments a ON a.id = tr.appointment_id
                JOIN users p ON p.id = a.patient_id
                WHERE a.doctor_id = ?
                ORDER BY tr.uploaded_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $doctorUserId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
