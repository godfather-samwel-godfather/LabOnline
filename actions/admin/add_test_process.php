<?php

require_once '../../config/db.php';

require_once '../../repositories/LabTestRepository.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/dashboard.php?page=add_new_tests');
    exit;
}

$categoryId = (int) ($_POST['category_id'] ?? 0);
$testName   = trim($_POST['test_name'] ?? '');
$description = trim($_POST['description'] ?? '');
$price      = (float) ($_POST['price'] ?? 0);
$duration   = trim($_POST['duration'] ?? '');

if (
    !$categoryId ||
    empty($testName) ||
    empty($description) ||
    !$price ||
    empty($duration)
) {
    header('Location: ../../admin/dashboard.php?page=add_new_tests');
    exit;
}

$repo = new LabTestRepository($conn);

$success = $repo->create([
    'category_id' => $categoryId,
    'test_name'   => $testName,
    'description' => $description,
    'price'       => $price,
    'duration'    => $duration
]);

if ($success) {

    header(
        'Location: ../../admin/dashboard.php?page=lab_tests&msg=Lab test added successfully'
    );

    exit;
}

header(
    'Location: ../../admin/dashboard.php?page=add_new_tests&error=Failed to add test'
);

exit;