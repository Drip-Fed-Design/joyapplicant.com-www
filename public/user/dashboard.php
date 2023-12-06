<?
require_once __DIR__ . '/../../config/global.init.php';
require_once __DIR__ . '/../../config/global.user.php';

require_once __DIR__ . '/../../templates/header.user.php'; // Header Template 

// Load the HTML for user dashboards
if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../src/View/applicantDashboard.php';
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../src/View/employerDashboard.php';
}

require_once __DIR__ . '/../../templates/footer.user.php'; // Footer Template 
