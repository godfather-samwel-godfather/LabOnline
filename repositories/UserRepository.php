<?php
/**
 * UserRepository — SQL zote za jedwali users.
 */
class UserRepository
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /** Orodha ya watumiaji wote */
    public function getAll(): array
    {
        $sql = "SELECT id, full_name, email, phone_number, role, status, created_at
                FROM users ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /** Badilisha status (approve / block / activate) */
    public function updateStatus(int $userId, string $status): bool
    {
        $allowed = ['pending', 'active', 'inactive', 'blocked'];
        if (!in_array($status, $allowed, true)) {
            return false;
        }

        $stmt = $this->conn->prepare('UPDATE users SET status = ? WHERE id = ?');
        $stmt->bind_param('si', $status, $userId);
        return $stmt->execute();
    }

    /** Hesabu users kwa role */
    public function countByRole(string $role): int
    {
        $stmt = $this->conn->prepare('SELECT COUNT(*) AS total FROM users WHERE role = ?');
        $stmt->bind_param('s', $role);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }

    /** Jumla ya users */
    public function countAll(): int
    {
        $result = $this->conn->query('SELECT COUNT(*) AS total FROM users');
        $row = $result->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }

    /** Hesabu kwa status */
    public function countByStatus(string $status): int
    {
        $stmt = $this->conn->prepare('SELECT COUNT(*) AS total FROM users WHERE status = ?');
        $stmt->bind_param('s', $status);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }

    /** Madaktari waliopo active (dropdown) */
    public function getActiveDoctors(): array
    {
        $sql = "SELECT id, full_name FROM users WHERE role = 'doctor' AND status = 'active' ORDER BY full_name";
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}
