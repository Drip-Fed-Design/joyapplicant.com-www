<?
require_once __DIR__ . '/../../config/global.init.php';
require_once __DIR__ . '/../../config/global.user.php';

use JoyApplicant\Controller\OnboardController;

// Set user_id to variable
$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checking CSRF token
    $token = $_POST['token'] ?? '';
    if (!hash_equals($_SESSION['token'], $token)) {
        // CSRF token does not match
        error_log('Invalid CSRF token');
        exit();
    }

    $dbConnection = require_once __DIR__ . '/../../config/global.db.php';
    $onboardController = new OnboardController($dbConnection);

    if ((isset($userType)) && ($userType == 'applicant')) {

        $visibility = $_POST['visibility'] ?? null;
        $alias = $_POST['alias'] ?? null;

        // Call the onboard method
        $onboardController->userOnboardDiscovery($userId, $visibility, $alias);
    } elseif ((isset($userType)) && ($userType == 'employer')) {
        // coming soon
    }
}

// Checking if YOU onboard in complete
$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$onboardControllerDiscoveryCheck = new OnboardController($dbConnection);
$onboardControllerDiscoveryCheck->checkOnboardingDiscovery($userId);

require_once __DIR__ . '/../../templates/header.onboard.php'; // Header Template 

// Load the HTML for onboarding
if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../src/View/onboardApplicantDiscovery.php';
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../src/View/onboardEmployerDiscovery.php';
}

require_once __DIR__ . '/../../templates/footer.user.php'; // Footer Template 
