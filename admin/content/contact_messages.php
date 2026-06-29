<?php
// 1. Inajumuisha bootstrap kwa njia sahihi kutokea content/ folder
require_once __DIR__ . '/../../includes/bootstrap.php';

// 2. Ita Repository na Action kuvuta data zote
$contactRepository = new ContactRepository($conn);
$contactAction = new ContactAction($contactRepository);

$messagesResults = $contactAction->getAllMessages();
?>

<div class="container-fluid px-4 py-4">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">

        <!-- ================= WELCOME CARD ================= -->
        <div class="welcome-card shadow-lg rounded-4 mb-4 p-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap">


                <div>

                    <h2 class="fw-bold mb-2 text-white">

                        <i class="bi bi-envelope-paper-fill me-2"></i>

                        Contact Messages

                    </h2>


                    <p class="mb-0 text-white text-muted">

                        Manage customer inquiries,
                        read messages and send professional replies.

                    </p>


                </div>



                <div class="welcome-icon">

                    <i class="bi bi-chat-dots-fill"></i>

                </div>


            </div>

        </div>


        <div class="card-body bg-white p-4">

            <?php if ($messagesResults && $messagesResults->num_rows > 0): ?>
            <?php while($row = $messagesResults->fetch_assoc()){ ?>

            <div class="p-4 mb-4 border rounded bg-light shadow-sm" style="border-radius: 10px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="text-primary mb-0 fw-bold">
                        <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($row['name']); ?>
                    </h5>
                    <?php if ($row['status'] == 'replied'): ?>
                    <span class="badge bg-success rounded-pill px-3 py-1">Replied</span>
                    <?php else: ?>
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-1">Pending</span>
                    <?php endif; ?>
                </div>

                <hr class="my-2">

                <p class="mb-1"><strong>Email:</strong> <span
                        class="text-muted"><?= htmlspecialchars($row['email']); ?></span></p>
                <p class="mb-1"><strong>Subject:</strong> <span
                        class="fw-semibold text-dark"><?= htmlspecialchars($row['subject']); ?></span></p>
                <p class="mb-3"><strong>Message:</strong> <br><span
                        class="text-secondary"><?= nl2br(htmlspecialchars($row['message'])); ?></span></p>

                <form action="content/reply_contact.php" method="POST" class="mt-3">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">

                    <div class="mb-3">
                        <textarea name="reply" class="form-control" placeholder="Write your professional reply here..."
                            rows="3" required></textarea>
                    </div>

                    <button type="submit" name="send_reply" class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm">
                        <i class="bi bi-reply-fill me-1"></i> Send Reply
                    </button>
                </form>
            </div>

            <?php } ?>
            <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-chat-left-x display-4 text-secondary"></i>
                <p class="mt-2 fw-semibold">Hakuna ujumbe wowote uliotumwa bado.</p>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>