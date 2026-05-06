<nav class="navbar navbar-expand-lg top-navbar navbar-dark fixed-top px-3">

    <a class="navbar-brand fw-bold" href="#">🏥 LabONLINE</a>

    <form class="d-none d-md-flex mx-auto w-50">
        <input class="form-control" type="search" placeholder="Search...">
        <button class="btn btn-primary ms-2"><i class="bi bi-search"></i></button>
    </form>

    <div class="d-flex align-items-center gap-3 text-white">
        <div class="position-relative">
            <i class="bi bi-bell-fill fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= $notification_count ?? 0 ?>
            </span>
        </div>
        <i class="bi bi-person-circle fs-4"></i>
    </div>

</nav>