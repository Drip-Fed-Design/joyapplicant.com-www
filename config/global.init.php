<?
//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- SESSIONS ----------
// ----------
// ----------
//
session_start([
    'use_strict_mode' => 1,
    'use_cookies' => 1,
    'cookie_httponly' => 1,
    'cookie_samesite' => 'Lax', // None, Lax, or Strict
    'cookie_secure' => 0, // Set to 1 if you are using HTTPS
    'use_only_cookies' => 1,
    'cookie_lifetime' => 0, // Session cookie will expire with the session
    'gc_maxlifetime' => 60 * 60, // Change the session GC max lifetime
]);

// Regenerate session ID to prevent session fixation
if (empty($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- ENVIRONMENT ----------
// ----------
// ----------
//
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$cssPrefix = $_ENV['CSS_PREFIX'];

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- HTTPS ----------
// ----------
// ----------
//
// if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
//     $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     header('HTTP/1.1 301 Moved Permanently');
//     header('Location: ' . $location);
//     exit;
// }
// if ($_SERVER['HTTPS'] !== 'on') {
//     header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//     exit;
// }

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- HEADERS ----------
// ----------
// ----------
//
header('X-Frame-Options: DENY'); // Or SAMEORIGIN
// header("Content-Security-Policy: default-src 'self'; script-src 'self' https://trusted.cdn.com");

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- ERRORS ----------
// ----------
// ----------
//
if ($_ENV['APP_DEBUG'] === 'false') {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    // set_error_handler('yourErrorHandlerFunction');
} elseif ($_ENV['APP_DEBUG'] === 'true') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);
    // set_error_handler('yourErrorHandlerFunction');
}
