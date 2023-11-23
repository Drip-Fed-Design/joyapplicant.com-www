<?
// Catch any session messages and output them accordingly
// Success message
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    // Unset the success message after displaying it
    unset($_SESSION['success_message']);
}
// Error message
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    // Unset the error message after displaying it
    unset($_SESSION['error_message']);
}
