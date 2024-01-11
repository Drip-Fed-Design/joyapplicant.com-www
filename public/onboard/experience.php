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

        $entry = $_POST['entry'] ?? null;

        // Checking IF experience is check as non (user is at entry level)
        if (!isset($entry)) {
            $role = $_POST['role'] ?? null;
            $company = $_POST['company'] ?? null;

            $current = $_POST['current'] ?? null;

            $startMonth = $_POST['startmonth'] ?? null;
            $startYear = $_POST['startyear'] ?? null;
            $endMonth = $_POST['endmonth'] ?? null;
            $endYear = $_POST['endyear'] ?? null;

            // Check if the year and month are provided, and format into Y-m-d formatting
            if ($startYear && $startMonth) {
                $startDate = new DateTime($startYear . '-' . $startMonth . '-01');
                $formattedStartDate = $startDate->format('Y-m-d');
            } else {
                $formattedStartDate = null;
            }
            if ($endYear && $endMonth) {
                // Set the DateTime to the first day of the next month and subtract one day
                $endDate = new DateTime($endYear . '-' . $endMonth . '-01');
                $endDate->modify('last day of this month');
                $formattedEndDate = $endDate->format('Y-m-d');
            } else {
                $formattedEndDate = null;
            }

            $desc = $_POST['desc'] ?? null;

            // Call the onboard method
            $onboardController->userOnboardExperience($userId, $entry, $role, $company, $current, $formattedStartDate, $formattedEndDate, $desc);
        } elseif (isset($entry)) {
            // Call the onboard method
            $onboardController->userOnboardExperienceEntry($userId, $entry);
        }
    }
}

// Checking if EXPERIENCE onboard in complete
$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$onboardControllerExperienceCheck = new OnboardController($dbConnection);
$onboardControllerExperienceCheck->checkOnboardingExperience($userId);

require_once __DIR__ . '/../../templates/header.onboard.php'; // Header Template 

// Load the HTML for onboarding
if ((isset($userType)) && ($userType == 'applicant')) {
    require_once __DIR__ . '/../../src/View/onboardApplicantExperience.php';
} elseif ((isset($userType)) && ($userType == 'employer')) {
    // Redirect employer to company onboard page
    header("Location: company.php");
    exit();
}

require_once __DIR__ . '/../../templates/footer.user.php'; // Footer Template 
