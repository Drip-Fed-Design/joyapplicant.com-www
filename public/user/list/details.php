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

        $jobVolunteer = $_POST['volunteer'] ?? null;
        $salaryCurrency = $_POST['currency'] ?? null;
        $salaryMin = $_POST['salarymin'] ?? null;
        $salaryMax = $_POST['salarymax'] ?? null;
        $salaryTerm = $_POST['term'] ?? null;

        $jobWhy = $_POST['why'] ?? null;
        $jobDuties = $_POST['duties'] ?? null;
        $jobBenefits = $_POST['benefits'] ?? null;
        $jobTeaser = $_POST['teaser'] ?? null;

        if (($jobWhy === '') || ($jobDuties === '') || ($jobBenefits === '')) {
            error_log('TinyMCE job listing was submitted with no content');
            $_SESSION['error_message'] = "Please make sure all detail fields are complete.";
            header("Location: details.php"); // Redirect
            exit();
        }

        // Format salary values
        $salaryMin = str_replace(',', '', $salaryMin);
        $salaryMin = (float)$salaryMin;
        $salaryMin = number_format($salaryMin, 2, '.', '');

        $salaryMax = str_replace(',', '', $salaryMax);
        $salaryMax = (float)$salaryMax;
        $salaryMax = number_format($salaryMax, 2, '.', '');

        // Call the details listing method
        $jobListController->listJobDetails($jobSession, $companyId, $jobVolunteer, $salaryCurrency, $salaryMin, $salaryMax, $salaryTerm, $jobWhy, $jobDuties, $jobBenefits, $jobTeaser);
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
    require_once __DIR__ . '/../../../src/View/employerListDetails.php';
}

require_once __DIR__ . '/../../../templates/footer.user.php'; // Footer Template 
