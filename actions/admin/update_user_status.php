<?php
/**
 * Admin: approve / activate / block user.
 * POST: user_id, status
 */
require_once __DIR__ . '/../../includes/action_bootstrap.php';
requireRole('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../../admin/dashboard.php?page=users&error=Invalid request');
}

$userId = (int) ($_POST['user_id'] ?? 0);
$status = trim($_POST['status'] ?? '');

if (!$userId || $status === '') {
    redirect('../../admin/dashboard.php?page=users&error=Missing data');
}

$userRepo = new UserRepository($conn);

if ($userRepo->updateStatus($userId, $status)) {
    redirect('../../admin/dashboard.php?page=users&msg=User status updated successfully');
}

redirect('../../admin/dashboard.php?page=users&error=Could not update user status');
