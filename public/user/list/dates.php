<?
require_once __DIR__ . '/../../../config/global.init.php';
require_once __DIR__ . '/../../../config/global.user.php';

if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../../templates/header.applicant.php'; // Header Template 
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../../templates/header.employer.list.php'; // Header Template 
}

// Load the HTML for user dashboards
if ((isset($userType)) && ($userType == 'applicant')) {
    // Access denied: redirect applicant to dashboard page
    header("Location: ../dashboard.php");
    exit();
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../../src/View/employerListDates.php';
}

require_once __DIR__ . '/../../../templates/footer.user.php'; // Footer Template 
