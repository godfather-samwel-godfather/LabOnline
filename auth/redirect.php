<?php
 function redirectByRole($role){

    switch($role){
        case 'admin':
            return "../admin/dashboard.php";

        case 'doctor':
            return "../doctor/dashboard.php";

        case 'labo':
            return "../labo/dashboard.php";

        default:
            return "../patient/dashboard.php?page=home";
    }
}?>