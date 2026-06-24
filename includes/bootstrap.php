<?php
/**
 * *this file is loaded on every page of the dashboard. it site for dependency injection and loading of repositories and helpers.
 * Load once per dashboard page — DB + helpers + repositories.
 */

require_once __DIR__ . '/../config/db.php';

require_once __DIR__ . '/helpers.php';

require_once __DIR__ . '/session_user.php';


// Repositories
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../repositories/AppointmentRepository.php';
require_once __DIR__ . '/../repositories/LaboratoryRepository.php';
require_once __DIR__ . '/../repositories/LabTestRepository.php';
require_once __DIR__ . '/../repositories/TestResultRepository.php';
require_once __DIR__ . '/../repositories/ContactRepository.php';


// Actions for users or visitor on website
require_once __DIR__ . '/../actions/ContactAction.php';
//Actions for admin
require_once __DIR__ . '/../actions/admin/adminContactAction.php';
// Actions for patient payments
require_once __DIR__ . '/../repositories/PaymentRepository.php';