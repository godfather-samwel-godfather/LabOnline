<?php
/**
 * Load once per dashboard page — DB + helpers + repositories.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/session_user.php';

require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../repositories/AppointmentRepository.php';
require_once __DIR__ . '/../repositories/LaboratoryRepository.php';
require_once __DIR__ . '/../repositories/LabTestRepository.php';
require_once __DIR__ . '/../repositories/TestResultRepository.php';
