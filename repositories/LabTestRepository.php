<?php
/**
 * LabTestRepository — SQL za test_categories na lab_tests.
 */
class LabTestRepository
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }


    /** Vipimo vyote pamoja na category */
    public function getAllWithCategory(): array
    {
        $sql = "SELECT lt.id, lt.test_name, lt.description, lt.price, lt.duration,
                       tc.category_name
                FROM lab_tests lt
                LEFT JOIN test_categories tc 
                ON tc.id = lt.category_id
                WHERE lt.is_active = 1
                ORDER BY tc.category_name, lt.test_name";

        $result = $this->conn->query($sql);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }


    /** Majina ya vipimo kwa appointment */
    public function getNamesByAppointmentId(int $appointmentId): string
    {
        $sql = "SELECT GROUP_CONCAT(lt.test_name SEPARATOR ', ') AS names
                FROM appointment_tests at
                JOIN lab_tests lt ON lt.id = at.test_id
                WHERE at.appointment_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('i', $appointmentId);

        $stmt->execute();

        $row = $stmt->get_result()->fetch_assoc();

        return $row['names'] ?? '-';
    }


    /** Categories zote */
    public function getCategories(): array
    {
        $sql = "SELECT id, category_name
                FROM test_categories
                ORDER BY category_name";

        $result = $this->conn->query($sql);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }


    /** Add new lab test */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO lab_tests
                (
                    category_id,
                    test_name,
                    description,
                    price,
                    duration,
                    is_active
                )
                VALUES (?, ?, ?, ?, ?, 1)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "issds",
            $data['category_id'],
            $data['test_name'],
            $data['description'],
            $data['price'],
            $data['duration']
        );

        return $stmt->execute();
    }


    /** Add new category */
    public function createCategory(string $name): bool
    {
        $sql = "INSERT INTO test_categories(category_name)
                VALUES (?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $name);

        return $stmt->execute();
    }


    /** Soft delete lab test */
    public function delete(int $id): bool
    {
        $sql = "UPDATE lab_tests
                SET is_active = 0
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

}