<?php
/**
 * Role-based redirects + homepage booking flow (login first, then appointment page).
 */

function redirectByRole(string $role): string
{
    switch ($role) {
        case 'admin':
            return '../admin/dashboard.php';
        case 'doctor':
            return '../doctor/dashboard.php';
        case 'labo':
            return '../labo/dashboard.php';
        default:
            return '../patient/dashboard.php?page=home';
    }
}

/** Allowed redirect keys from homepage (patient pages only) */
function allowedPatientRedirects(): array
{
    return [
        'create_appointment' => '../patient/dashboard.php?page=create_appointment',
        'view_appointments'  => '../patient/dashboard.php?page=view_appointments',
    ];
}

/** Validate redirect key from URL/form */
function sanitizeRedirectKey(?string $key): ?string
{
    if (!$key) {
        return null;
    }
    $allowed = allowedPatientRedirects();
    return isset($allowed[$key]) ? $key : null;
}

/** After login: go to intended patient page or default dashboard */
function redirectAfterLogin(string $role, ?string $redirectKey = null): string
{
    if ($role === 'patient' && $redirectKey) {
        $allowed = allowedPatientRedirects();
        if (isset($allowed[$redirectKey])) {
            return $allowed[$redirectKey];
        }
    }
    return redirectByRole($role);
}

/*
  Homepage button URL — logged-in patient goes direct; others go to login first.
 
function patientPageUrl(string $pageKey): string
{
    $allowed = allowedPatientRedirects();
    if (!isset($allowed[$pageKey])) {
        return 'auth/login.php';
    }

    if (isset($_SESSION['user_id'], $_SESSION['role']) && $_SESSION['role'] === 'patient') {
        return 'patient/dashboard.php?page=' . urlencode($pageKey);
    }

    return 'auth/login.php?redirect=' . urlencode($pageKey);
}*/

/** Human-readable message for login page */
function patientPageUrl(string $pageKey, ?int $id = null): string
{
    $allowed = allowedPatientRedirects();

    if (!isset($allowed[$pageKey])) {
        return 'auth/login.php';
    }


    if (
        isset($_SESSION['user_id'], $_SESSION['role'])
        && $_SESSION['role'] === 'patient'
    ) {

        $url = 'patient/dashboard.php?page=' . urlencode($pageKey);


        if ($id !== null) {

            $url .= '&test_id=' . $id;

        }


        return $url;

    }


    $url= 'auth/login.php?redirect=' . urlencode($pageKey);
    
    if($id !== null){
        $url .= '&test_id=' . $id;    
    }

    return $url;
}




function redirectIntentMessage(?string $redirectKey): string
{
    return match ($redirectKey) {
        'create_appointment' => 'Please login or register as a patient to book an appointment.',
        'view_appointments'  => 'Please login as a patient to view your appointments.',
        default              => '',
    };
}