<?
require_once __DIR__ . '/../../config/global.init.php';
require_once __DIR__ . '/../../config/global.user.php';

// Load in static variables
require_once __DIR__ . '/../../config/global.static.php';

if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../templates/header.applicant.php'; // Header Template 
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../templates/header.employer.php'; // Header Template 
}

// Load the HTML for user job view
if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../src/View/applicantJobView.php';
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../src/View/employerJobView.php';
}

require_once __DIR__ . '/../../templates/footer.user.php'; // Footer Template 
