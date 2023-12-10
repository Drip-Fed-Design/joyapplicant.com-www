<?
require_once __DIR__ . '/../../config/global.init.php';
require_once __DIR__ . '/../../config/global.user.php';

use JoyApplicant\Controller\OnboardController;
use JoyApplicant\Controller\CompanyController;

// Set user_id to variable
$userId = $_SESSION['user_id'];

// Get employers related company ID
$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$onboardCompany = new CompanyController($dbConnection);
if ((isset($userType)) && ($userType == 'employer')) {
    $cId = $onboardCompany->companyDetails($userId);
    // Get the first company ID
    if ($cId && is_array($cId)) {
        $companyId = $cId[0]['id'];
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checking CSRF token
    $token = $_POST['token'] ?? '';
    if (!hash_equals($_SESSION['token'], $token)) {
        // CSRF token does not match
        error_log('Invalid CSRF token');
        exit();
    }

    $onboardController = new OnboardController($dbConnection);

    $visibility = $_POST['visibility'] ?? null;
    $alias = $_POST['alias'] ?? null;

    if ((isset($userType)) && ($userType == 'applicant')) {
        // Call the onboard method
        $onboardController->userOnboardDiscovery($userId, $visibility, $alias);
    } elseif ((isset($userType)) && ($userType == 'employer')) {
        // Call the onboard method
        $onboardController->userOnboardDiscoveryCompany($companyId, $userId, $visibility, $alias);
    }
}

// Checking if YOU onboard in complete
$onboardControllerDiscoveryCheck = new OnboardController($dbConnection);
if ((isset($userType)) && ($userType == 'applicant')) {
    $onboardControllerDiscoveryCheck->checkOnboardingDiscovery($userId);
} elseif ((isset($userType)) && ($userType == 'employer')) {
    $onboardControllerDiscoveryCheck->checkOnboardingDiscoveryCompany($userId);
}

require_once __DIR__ . '/../../templates/header.onboard.php'; // Header Template 

// Load the HTML for onboarding
if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../src/View/onboardApplicantDiscovery.php';
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../src/View/onboardEmployerDiscovery.php';
}

require_once __DIR__ . '/../../templates/footer.user.php'; // Footer Template 
