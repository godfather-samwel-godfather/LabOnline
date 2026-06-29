<?php

$id = (int)($_GET['id'] ?? 0);


if ($id > 0) {

    $labTestRepo = new LabTestRepository($conn);


    if ($labTestRepo->delete($id)) {


        echo "<script>
        window.location='?page=lab_tests&msg=Test deleted successfully';
        </script>";

        exit;


    } else {


        echo "<script>
        window.location='?page=lab_tests&error=Failed to delete test';
        </script>";

        exit;

    }

}


echo "<script>
window.location='?page=lab_tests';
</script>";

exit;

?>