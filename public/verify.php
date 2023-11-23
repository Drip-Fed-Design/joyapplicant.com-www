<?
require_once __DIR__ . '/../config/global.init.php';
require_once __DIR__ . '/../config/global.public.php';

use JoyApplicant\Controller\AuthenticateController;

$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';

$dbConnection = require_once __DIR__ . '/../config/global.db.php';
$authenticateController = new AuthenticateController($dbConnection);

// Validate the email and token
if (!$authenticateController->emailVerifyToken($email, $token)) {
    echo 'Invalid or expired password reset token.';
}

// Header Template
require_once __DIR__ . '/../templates/header.public.php';

// Footer Template 
require_once __DIR__ . '/../templates/footer.public.php';
