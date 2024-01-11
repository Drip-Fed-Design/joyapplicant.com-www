<?
// Catch any session messages and output them accordingly
// Success message
if (isset($_SESSION['success_message'])) {
    echo '<div class="' . $cssPrefix . '-alert-container -success" role="alert"><p>' . htmlspecialchars($_SESSION['success_message']) . '</p></div>';
    // Unset the success message after displaying it
    unset($_SESSION['success_message']);
}
// Error message
if (isset($_SESSION['error_message'])) {
    echo '<div class="' . $cssPrefix . '-alert-container -error" role="alert"><p>' . htmlspecialchars($_SESSION['error_message']) . '</p></div>';
    // Unset the error message after displaying it
    unset($_SESSION['error_message']);
}
