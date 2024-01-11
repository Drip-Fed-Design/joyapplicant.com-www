<?
// Check for user_authenticated session is set
if (isset($_SESSION['user_authenticated'])) {
    // Redirect to user dashboard page if the user is authenticated
    header("Location: /user/dashboard.php");
    exit();
}
