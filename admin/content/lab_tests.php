<?php
$labTestRepo = new LabTestRepository($conn);
$tests = $labTestRepo->getAllWithCategory();
?>


<!-- ================= WELCOME CARD ================= -->

<div class="welcome-card shadow-lg rounded-4 mb-4 p-5">

    <div class="d-flex justify-content-between align-items-center flex-wrap">


        <div>

            <h2 class="fw-bold mb-2 text-white">

                <i class="bi bi-flask me-2"></i>

                Laboratory Test Management

            </h2>


            <p class="mb-0 text-white text-muted">

                Manage available laboratory tests,
                categories, prices and test information.

            </p>


        </div>



        <div class="welcome-icon">

            <i class="bi bi-clipboard2-pulse-fill"></i>

        </div>


    </div>

</div>

<?php flashMessage(); ?>



<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Test Name</th>
                <th>Category</th>
                <th>Price (TZS)</th>
                <th>Duration</th>
                <th width="220">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($tests)): ?>
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    No tests found.
                </td>
            </tr>
            <?php else: ?>

            <?php foreach ($tests as $i => $test): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($test['test_name']) ?></td>
                <td><?= e($test['category_name'] ?? '-') ?></td>
                <td><?= number_format((float)$test['price'], 0) ?></td>
                <td><?= e($test['duration'] ?? '-') ?></td>

                <td>
                    <div class="d-flex gap-1">
                        <a href="?page=view_test&id=<?= $test['id'] ?>" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                            View
                        </a>

                        <a href="?page=edit_test&id=<?= $test['id'] ?>" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i>
                            Edit
                        </a>

                        <a href="?page=delete_test&id=<?= $test['id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this test?')">
                            <i class="bi bi-trash"></i>
                            Delete
                        </a>
                    </div>

                </td>
            </tr>
            <?php endforeach; ?>

            <?php endif; ?>
        </tbody>
    </table>
</div>