<?
require_once __DIR__ . '/../config/global.init.php';
require_once __DIR__ . '/../config/global.public.php';

use JoyApplicant\Controller\RegistrationController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checking CSRF token
    $token = $_POST['token'] ?? '';
    if (!hash_equals($_SESSION['token'], $token)) {
        // CSRF token does not match
        error_log('Invalid CSRF token');
        exit();
    }

    $dbConnection = require_once __DIR__ . '/../config/global.db.php';
    $registrationController = new RegistrationController($dbConnection);

    $email = $_POST['email'] ?? null;
    $type = $_POST['type'] ?? null;
    $password = $_POST['password'] ?? null;
    $passwordConfirm = $_POST['password_confirm'] ?? null;

    // Call the register method
    $registrationController->registerUser($email, $type, $password, $passwordConfirm);
}

// Header Template
require_once __DIR__ . '/../templates/header.public.php';

// Load the HTML form for registration
require_once __DIR__ . '/../src/View/registrationForm.php';

// Footer Template 
require_once __DIR__ . '/../templates/footer.public.php';
