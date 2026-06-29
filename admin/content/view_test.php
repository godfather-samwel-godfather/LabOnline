<?php
$id = (int)($_GET['id'] ?? 0);

$labTestRepo = new LabTestRepository($conn);

$sql = "SELECT lt.*, tc.category_name
        FROM lab_tests lt
        LEFT JOIN test_categories tc 
        ON tc.id = lt.category_id
        WHERE lt.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$test = $stmt->get_result()->fetch_assoc();

if (!$test) {
    echo "<div class='alert alert-danger'>Test not found</div>";
    exit;
}
?>


<h4 class="mb-3">Test Details</h4>

<table class="table table-bordered">

    <tr>
        <th>Name</th>
        <td><?= e($test['test_name']) ?></td>
    </tr>

    <tr>
        <th>Category</th>
        <td><?= e($test['category_name']) ?></td>
    </tr>

    <tr>
        <th>Description</th>
        <td><?= e($test['description']) ?></td>
    </tr>

    <tr>
        <th>Price</th>
        <td><?= number_format($test['price']) ?> TZS</td>
    </tr>

    <tr>
        <th>Duration</th>
        <td><?= e($test['duration']) ?></td>
    </tr>

</table>


<a href="?page=lab_tests" class="btn btn-secondary">
    Back
</a>