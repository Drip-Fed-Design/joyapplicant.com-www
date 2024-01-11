<?
require_once __DIR__ . '/../config/global.init.php';
require_once __DIR__ . '/../config/global.public.php';

use JoyApplicant\Controller\AuthenticateController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checking CSRF token
    $token = $_POST['token'] ?? '';
    if (!hash_equals($_SESSION['token'], $token)) {
        // CSRF token does not match
        error_log('Invalid CSRF token');
        exit();
    }

    $dbConnection = require_once __DIR__ . '/../config/global.db.php';
    $authenticateController = new AuthenticateController($dbConnection);

    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    // Call the login method
    $authenticateController->loginUser($email, $password);
}

require_once __DIR__ . '/../templates/header.public.php'; // Header Template

// Load the HTML form for login
require_once __DIR__ . '/../src/View/loginForm.php';

require_once __DIR__ . '/../templates/footer.public.php'; // Footer Template