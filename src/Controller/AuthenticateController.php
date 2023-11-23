<?

namespace JoyApplicant\Controller;

use JoyApplicant\Model\UserModel;
use JoyApplicant\Service\EmailService;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class AuthenticateController
{
    protected $dbConnection;
    protected $userModel;
    protected $emailService;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->userModel = new UserModel($dbConnection);
        $this->emailService = new EmailService($_ENV['SMTP_KEY']);
    }

    public function loginUser($email, $password)
    {
        // Input validation
        $emailValidator = v::email();
        $passwordValidator = v::alnum('%', '!', '#', '$', '&', '_')->noWhitespace()->length(8, 16);

        try {
            // Validate the email and password
            $emailValidator->assert($email);
            $passwordValidator->assert($password);

            // Check if the email exists in the database
            if (!$this->userModel->emailExists($email)) {
                error_log('Email already in use.'); // TEMPORARY
                $_SESSION['error_message'] = "It looks like you're not registered.";
                header("Location: register.php"); // Redirect
                exit();
            }

            $userQuery = $this->userModel->selectUser($email, $password);
            if ($userQuery) {
                // The user was successfully registered.
                error_log('You have logged in successfully!'); // TEMPORARY
                $_SESSION['success_message'] = "You have logged in successfully!";
                $_SESSION['user_authenticated'] = true;
                $_SESSION['user_type'] = $userQuery['type']; // Extract user type
                header("Location: /user/dashboard.php"); // Redirect
                exit();
            } else {
                error_log('An error occurred during log in. Please try again.'); // TEMPORARY
                $_SESSION['error_message'] = "An error occurred during log in. Please try again.";
                header("Location: login.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for log in.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function logoutUser()
    {
        // Start the session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();

        // Redirect to the login page or home page
        $_SESSION['error_message'] = "You've logged out successfully.";
        header("Location: /public/");
        exit();
    }

    public function forgotPassword($email)
    {
        // Input validation
        $emailValidator = v::email();
        // Validate the email
        $emailValidator->assert($email);

        // Check if the email exists
        if (!$this->userModel->emailExists($email)) {
            // throw new \Exception("Email does not exist.");
            $_SESSION['success_message'] = "If you have an account with us, you will receive an email from us";
            header("Location: /public/login.php");
            exit();
        }

        // Create a unique token
        $token = bin2hex(random_bytes(16));
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        // Store the token in the database with an expiration date
        if (!$this->userModel->storePasswordResetToken($email, $hashedToken)) {
            // throw new \Exception("Unable to store password reset token.");
            $_SESSION['error_message'] = "Something went wrong, please try again.";
            header("Location: /public/login.php");
            exit();
        }

        // Create a password reset link
        $encodeemail = urlencode($email);
        $link = $_ENV['DOMAIN_URL'] . "public/reset.php?email={$encodeemail}&pwtoken={$token}";

        // Send the email
        if (!$this->emailService->sendPasswordResetEmail($email, $link)) {
            // throw new \Exception("Failed to send password reset email.");
            $_SESSION['error_message'] = "Failed to send password reset email, please try again.";
            header("Location: /public/login.php");
            exit();
        }

        $_SESSION['success_message'] = "Request success, please checked your inbox for next steps.";
        return true;
    }

    public function emailVerifyToken($email, $token)
    {
        // First, sanitize the inputs
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        // $token = filter_var($token, FILTER_SANITIZE_STRING);
        $token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

        // Input validation
        $emailValidator = v::email();
        // Validate the email
        $emailValidator->assert($email);

        if ($this->userModel->validateEmailVerifyToken($email, $token)) {
            // throw new \Exception("Email does not exist.");
            error_log('Email token for ' . $email . ' is valid.');
            $_SESSION['success_message'] = "Great, thanks for verifying your account.";
            header("Location: /public/login.php");
            return true;
        } else {
            $_SESSION['error_message'] = "Email verification error, please contact support.";
            error_log('Email verification for ' . $email . ' error.');
            header("Location: /public/login.php");
            exit();
        }
    }

    public function passwordResetToken($email, $token)
    {
        // First, sanitize the inputs
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        // $token = filter_var($token, FILTER_SANITIZE_STRING);
        $token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

        // Input validation
        $emailValidator = v::email();
        // Validate the email
        $emailValidator->assert($email);

        if ($this->userModel->validatePasswordResetToken($email, $token)) {
            // throw new \Exception("Email does not exist.");
            error_log('Password token for ' . $email . ' is valid.');
            $_SESSION['token_valid'] = true;
            return true;
        } else {
            $_SESSION['error_message'] = "Password reset expired, please try again.";
            error_log('Password token for ' . $email . ' is invalid.');
            header("Location: /public/login.php");
            exit();
        }
    }

    public function resetPassword($email, $newPassword)
    {
        // First, sanitize the inputs
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Input validation
        $emailValidator = v::email();
        // Validate the email
        $emailValidator->assert($email);

        // Hash the new password before storing it
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if ($this->userModel->storePasswordReset($email, $hashedPassword)) {
            // throw new \Exception("Email does not exist.");

            // Send the email
            if (!$this->emailService->sendPasswordResetConfirmEmail($email)) {
                // throw new \Exception("Failed to send password reset email.");
                $_SESSION['error_message'] = "Failed to send password reset confirm email, please try again.";
                header("Location: /public/login.php");
                exit();
            }

            $_SESSION['success_message'] = "Your password has been reset, please continue to log in.";
            header("Location: /public/login.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Password reset failed, please try again.";
            header("Location: /public/login.php");
            exit();
        }
    }
}
