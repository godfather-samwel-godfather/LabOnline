<?php
/**
 * LaboratoryRepository — SQL za jedwali laboratories.
 */
class LaboratoryRepository
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /** Pata laboratories.id kwa user aliye login (role labo) */
    public function getIdByUserId(int $userId): ?int
    {
        $stmt = $this->conn->prepare('SELECT id FROM laboratories WHERE user_id = ? LIMIT 1');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ? (int) $row['id'] : null;
    }

    /** Orodha ya maabara (dropdown kwa patient) */
    public function getAll(): array
    {
        $sql = "SELECT id, labo_name, location FROM laboratories ORDER BY labo_name";
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}
