<?
require_once __DIR__ . '/../../../config/global.init.php';
require_once __DIR__ . '/../../../config/global.user.php';

use JoyApplicant\Controller\JobListController;

// Set user_id and company_id to variable
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checking CSRF token
    $token = $_POST['token'] ?? '';
    if (!hash_equals($_SESSION['token'], $token)) {
        // CSRF token does not match
        error_log('Invalid CSRF token');
        exit();
    }

    $dbConnection = require_once __DIR__ . '/../../../config/global.db.php';
    $jobListController = new JobListController($dbConnection);

    // Check if user is an EMPLOYER
    if ((isset($userType)) && ($userType == 'employer')) {

        $jobSession = $_POST['jobsession'] ?? null;
        $jobStatus = $_POST['status'] ?? null;

        // Call the dates listing method
        $jobListController->listJobLive($jobSession, $companyId, $jobStatus);
    }
}

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
    require_once __DIR__ . '/../../../src/View/employerListPublish.php';
}

require_once __DIR__ . '/../../../templates/footer.user.php'; // Footer Template 
