<?
require_once __DIR__ . '/../config/global.init.php';
require_once __DIR__ . '/../config/global.public.php';

use JoyApplicant\Controller\AuthenticateController;

$email = $_GET['email'] ?? '';
$pwtoken = $_GET['pwtoken'] ?? '';

$dbConnection = require_once __DIR__ . '/../config/global.db.php';
$authenticateController = new AuthenticateController($dbConnection);

// Validate the email and token
if (!$authenticateController->passwordResetToken($email, $pwtoken)) {
    echo 'Invalid or expired password reset token.';
} else {

    // The token is valid, allow the user to reset their password
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Checking CSRF token
        $token = $_POST['token'] ?? '';
        if (!hash_equals($_SESSION['token'], $token)) {
            // CSRF token does not match
            error_log('Invalid CSRF token');
            exit();
        }

        $newPassword = $_POST['password_new'] ?? '';
        $confirmPassword = $_POST['password_confirm'] ?? '';

        // Server-side validation for the new password
        if (empty($newPassword) || empty($confirmPassword)) {
            echo 'Please enter and confirm your new password.';
        } elseif ($newPassword !== $confirmPassword) {
            echo 'Passwords do not match.';
        } else {
            // Attempt to reset the password
            if ($authenticateController->resetPassword($email, $newPassword)) {
                echo 'Your password has been updated. Please login with your new password.';
            } else {
                echo 'Failed to update the password. Please try again.';
            }
        }
    }
}

// Header Template
require_once __DIR__ . '/../templates/header.public.php';

// Load the HTML form for reset
require_once __DIR__ . '/../src/View/resetForm.php';

// Footer Template 
require_once __DIR__ . '/../templates/footer.public.php';
