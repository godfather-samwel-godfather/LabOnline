 <?php
$current_page = $_GET['page'] ?? 'home';

function active($p, $current){ 
    // Tunatumia 'active' class ya bootstrap na rangi ya bluu
    return ($p === $current) ? 'bg-primary shadow-sm' : ''; 
}
?>

 <div class="sidebar d-none d-md-flex flex-column p-3 vh-100 position-fixed sidebar-bg text-white"
     style="width: 250px; top: 56px;">
     <div class="nav nav-pills flex-column mb-auto gap-1">
         <a href="dashboard.php?page=home"
             class=" nav-link d-flex align-items-center gap-2 p-2 text-white <?= active('home', $current_page) ?>">
             <i class="bi bi-speedometer2"></i><span>Dashboard</span>
         </a>

         <a href="dashboard.php?page=view_patients_list"
             class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= active('view_patients_list', $current_page) ?>">
             <i class="bi bi-people-fill"></i><span>view Patients List</span>
         </a>

         <a href="dashboard.php?page=view_appointments"
             class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= active('view_appointments', $current_page) ?>">
             <i class=" bi bi-calendar-check"></i><span>view appointments</span>
         </a>

         <a href="dashboard.php?page=appointment_action"
             class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= active('appointment_action', $current_page) ?>">
             <i class="bi bi-file-medical"></i><span>appointment action</span>
         </a>

         <a href="dashboard.php?page=request_labo_test"
             class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= active('request_labo_test', $current_page) ?>">
             <i class="bi bi-journal-text"></i><span>request labo test</span>
         </a>

         <a href="dashboard.php?page=view_labo_results"
             class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= active('view_labo_results', $current_page) ?>">
             <i class="bi bi-gear-fill"></i><span>view labo results</span>
         </a>
         <a href="dashboard.php?page=create_prescription"
             class="nav-link d-flex align-items-center gap-2 p-2 text-white <?= active('create_prescription', $current_page) ?>">
             <i class="bi bi-journal-text"></i><span>create prescription</span>
         </a>

     </div>
     <div class="nav nav-pills flex-column mt-auto pb-5">
         <hr class="text-white-50">
         <a href="../auth/logout.php" class="nav-link text-white d-flex align-items-center gap-3">
             <i class="bi bi-box-arrow-right"></i>
             <span>Logout</span>
         </a>
     </div>
 </div>