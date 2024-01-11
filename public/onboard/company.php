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

    if ((isset($userType)) && ($userType == 'employer')) {

        $name = $_POST['name'] ?? null;
        $desc = $_POST['desc'] ?? null;
        $telephone = $_POST['telephone'] ?? null;
        $email = $_POST['email'] ?? null;
        $country = $_POST['country'] ?? null;
        $postcodezip = $_POST['postcodezip'] ?? null;

        // Call the onboard method
        $onboardController->userOnboardCompany($userId, $name, $desc, $telephone, $email, $country, $postcodezip);
    } elseif ((isset($userType)) && ($userType == 'applicant')) {
        header("Location: /../user/dashboard.php");
        exit();
    }
}

// Checking if EXPERIENCE onboard in complete
$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$onboardControllerCompanyCheck = new OnboardController($dbConnection);
$onboardControllerCompanyCheck->checkOnboardingCompany($userId);

require_once __DIR__ . '/../../templates/header.onboard.php'; // Header Template 

// Load the HTML for onboarding
if ((isset($userType)) && ($userType == 'applicant')) {
    // Redirect applicant to experience onboard page
    header("Location: experience.php");
    exit();
} elseif ((isset($userType)) && ($userType == 'employer')) {
    require_once __DIR__ . '/../../src/View/onboardEmployerCompany.php';
}

require_once __DIR__ . '/../../templates/footer.user.php'; // Footer Template 
