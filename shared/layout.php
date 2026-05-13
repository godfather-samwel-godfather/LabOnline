<?php include __DIR__ . '/head.php'; ?>

<body>

    <?php include __DIR__ . '/topnav.php'; ?>

    <div class="d-flex">

        <div class="sidebar">
            <?php
            $role = $_SESSION['role'] ?? 'patient';
            // Tumesahihisha path hapa chini
            $sidebar_file = __DIR__ . "/../sidebars/$role.php";
            
            if(file_exists($sidebar_file)){
                include $sidebar_file;
            } else {
                echo "Sidebar not found";
            }
            ?>
        </div>

        <div class="main-content flex-grow-1 p-3" style="margin-top: 60px;">
            <?php
            if(isset($page_content) && file_exists($page_content)){
                include $page_content;
            } else {
                echo "<h4>Page Not Found!</h4>";
            }
            ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>