<?php
$labTestRepo = new LabTestRepository($conn);
$tests = $labTestRepo->getAllWithCategory();
?>

<h4 class="mb-3">Lab Tests</h4>
<?php flashMessage(); ?>

<p class="text-muted small">List of available laboratory tests (seeded from database).</p>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Test Name</th>
                <th>Category</th>
                <th>Price (TZS)</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($tests)): ?>
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    No tests found. Run seed SQL for test_categories and lab_tests.
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($tests as $i => $test): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($test['test_name']) ?></td>
                <td><?= e($test['category_name'] ?? '-') ?></td>
                <td><?= number_format((float) $test['price'], 0) ?></td>
                <td><?= e($test['duration'] ?? '-') ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
