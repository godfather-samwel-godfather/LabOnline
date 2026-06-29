<?php

$labTestRepo = new LabTestRepository($conn);
$categories = $labTestRepo->getCategories();

?>

<!-- ================= WELCOME CARD ================= -->

<div class="welcome-card shadow-lg rounded-4 mb-4 p-5">

    <div class="d-flex justify-content-between align-items-center flex-wrap">


        <div>

            <h2 class="fw-bold mb-2 text-white">

                <i class="bi bi-plus-circle me-2"></i>

                Add New Laboratory Test

            </h2>


            <p class="mb-0 text-white text-muted">

                Create a new laboratory test,
                assign categories, prices and service duration.

            </p>


        </div>



        <div class="welcome-icon">

            <i class="bi bi-file-medical-fill"></i>

        </div>


    </div>

</div>

<?php flashMessage(); ?>

<div class="card">
    <div class="card-body">

        <form method="POST" action="../actions/admin/add_test_process.php">

            <div class="mb-3">
                <label class="form-label">Test Name</label>
                <input type="text" name="test_name" class="form-control" required>
            </div>

            <div class="mb-3 d-flex gap-2">

                <select name="category_id" class="form-select" required>

                    <option value="">
                        Select Category
                    </option>

                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>">
                        <?= e($category['category_name']) ?>
                    </option>
                    <?php endforeach; ?>

                </select>

                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">

                    + Add Category

                </button>



            </div>



            <div class="mb-3">
                <label class="form-label">Description</label>

                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Price (TZS)</label>

                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Duration</label>

                <input type="text" name="duration" class="form-control" placeholder="24h" required>
            </div>

            <button type="submit" class="btn btn-primary">
                Save Test
            </button>

        </form>

    </div>
</div>
<!--model for add category moeld-->
<div class="modal fade" id="addCategoryModal">

    <div class="modal-dialog">

        <div class="modal-content">


            <form method="POST" action="../actions/admin/add_category_process.php">


                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Category
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>


                <div class="modal-body">

                    <input type="text" name="category_name" class="form-control" placeholder="Category name" required>

                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">

                        Save Category

                    </button>

                </div>


            </form>


        </div>

    </div>

</div>