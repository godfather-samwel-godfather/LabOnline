<?php

require_once '../../config/db.php';
require_once '../../repositories/LabTestRepository.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: ../../admin/dashboard.php?page=add_new_tests');
    exit;

}


$categoryName = trim($_POST['category_name'] ?? '');


if (empty($categoryName)) {

    header(
        'Location: ../../admin/dashboard.php?page=add_new_tests&error=Category name required'
    );

    exit;

}



$repo = new LabTestRepository($conn);


$success = $repo->createCategory($categoryName);



if ($success) {

    header(
        'Location: ../../admin/dashboard.php?page=add_new_tests&msg=Category added successfully'
    );

    exit;

}



header(
    'Location: ../../admin/dashboard.php?page=add_new_tests&error=Failed to add category'
);

exit;