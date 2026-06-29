<?php

$id = (int)($_GET['id'] ?? 0);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $sql = "UPDATE lab_tests
            SET 
            test_name = ?,
            description = ?,
            price = ?,
            duration = ?
            WHERE id = ?";


    $stmt = $conn->prepare($sql);


    $stmt->bind_param(
        "ssdsi",
        $_POST['test_name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['duration'],
        $id
    );


    if ($stmt->execute()) {

        echo "<script>
        window.location='?page=lab_tests&msg=Test updated successfully';
        </script>";

        exit;


    } else {


        echo "<script>
        window.location='?page=lab_tests&error=Failed to update test';
        </script>";

        exit;

    }

}



$sql = "SELECT * FROM lab_tests WHERE id = ?";


$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();


$test = $stmt->get_result()->fetch_assoc();



if (!$test) {

    echo "Test not found";
    exit;

}

?>


<h4 class="mb-3">Edit Lab Test</h4>


<form method="POST">


    <div class="mb-3">

        <label class="form-label">
            Test Name
        </label>

        <input type="text" name="test_name" class="form-control" value="<?= e($test['test_name']) ?>" required>

    </div>



    <div class="mb-3">

        <label class="form-label">
            Description
        </label>

        <textarea name="description" class="form-control"><?= e($test['description']) ?></textarea>

    </div>



    <div class="mb-3">

        <label class="form-label">
            Price (TZS)
        </label>

        <input type="number" name="price" class="form-control" value="<?= $test['price'] ?>" required>

    </div>



    <div class="mb-3">

        <label class="form-label">
            Duration
        </label>

        <input type="text" name="duration" class="form-control" value="<?= e($test['duration']) ?>">

    </div>



    <button class="btn btn-primary">
        <i class="bi bi-save"></i>
        Update Test
    </button>


    <a href="?page=lab_tests" class="btn btn-secondary">
        Cancel
    </a>


</form>