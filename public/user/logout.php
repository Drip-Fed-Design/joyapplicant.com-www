<?
require_once __DIR__ . '/../../config/global.init.php';
require_once __DIR__ . '/../../config/global.user.php';

use JoyApplicant\Controller\AuthenticateController;

$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$authenticateController = new AuthenticateController($dbConnection);

$authenticateController->logoutUser();
