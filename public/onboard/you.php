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

    // Check if user is an APPLICANT
    if ((isset($userType)) && ($userType == 'applicant')) {

        $firstName = $_POST['firstname'] ?? null;
        $lastName = $_POST['lastname'] ?? null;
        $telephone = $_POST['telephone'] ?? null;
        $country = $_POST['country'] ?? null;
        $postcodezip = $_POST['postcodezip'] ?? null;
        $findUs = $_POST['findus'] ?? null;

        // Call the onboard method
        $onboardController->userOnboardYou($userId, $firstName, $lastName, $telephone, $country, $postcodezip, $findUs);

        // Check if user is an EMPLOYER
    } elseif ((isset($userType)) && ($userType == 'employer')) {

        $firstName = $_POST['firstname'] ?? null;
        $lastName = $_POST['lastname'] ?? null;
        $telephone = $_POST['telephone'] ?? null;
        $country = $_POST['country'] ?? null;
        $postcodezip = $_POST['postcodezip'] ?? null;
        $findUs = $_POST['findus'] ?? null;

        // Call the onboard method
        $onboardController->userOnboardYou($userId, $firstName, $lastName, $telephone, $country, $postcodezip, $findUs);
    }
}

// Checking if YOU onboard in complete
$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$onboardControllerYouCheck = new OnboardController($dbConnection);
$onboardControllerYouCheck->checkOnboardingYou($userId);

require_once __DIR__ . '/../../templates/header.onboard.php'; // Header Template 

// Load the HTML for onboarding
if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../src/View/onboardApplicantYou.php';
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../src/View/onboardEmployerYou.php';
}

require_once __DIR__ . '/../../templates/footer.user.php'; // Footer Template 
