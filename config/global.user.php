<?
// Check for user_authenticated session is set
if (!isset($_SESSION['user_authenticated'])) {
    // Redirect to login page if the user is not authenticated
    header("Location: /public/login.php");
    exit();
}

// Set the duration of inactivity allowed before a session expires (e.g., 30 minutes)
define('SESSION_TIMEOUT', 30 * 60);

// Check for session timeout
if (isset($_SESSION['logged_in']) && (time() - $_SESSION['logged_in'] > SESSION_TIMEOUT)) {
    // Session has expired; clear the session and redirect to the login page
    $_SESSION = array(); // Clear the $_SESSION array
    session_destroy(); // Destroy the session data on the server
    header("Location: /public/login.php");
    exit;
}

// Update last activity time stamp
$_SESSION['logged_in'] = time();


// Convert session data to variables
$userType = $_SESSION['user_type'];
