<?

namespace JoyApplicant\Controller;

use JoyApplicant\Model\UserModel;
use JoyApplicant\Service\EmailService;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class RegistrationController
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

    public function registerUser($email, $type, $password, $passwordConfirm)
    {
        // Input validation
        $emailValidator = v::email();
        $passwordValidator = v::alnum('%', '!', '#', '$', '&', '_')->noWhitespace()->length(8, 16);

        // Create a unique token
        $token = bin2hex(random_bytes(16));

        // Create a password reset link
        $encodeemail = urlencode($email);
        $link = $_ENV['DOMAIN_URL'] . "public/verify.php?email={$encodeemail}&token={$token}";

        try {
            // Validate the email and password
            $emailValidator->assert($email);
            $passwordValidator->assert($password);

            // Check if passwords match
            if ($password !== $passwordConfirm) {
                // throw new \Exception('Password and confirmation password do not match.');
                $_SESSION['error_message'] = "It looks like your passwords do not match.";
                header("Location: register.php"); // Redirect
                exit();
            }

            // Check if the email already exists in the database
            if ($this->userModel->emailExists($email)) {
                error_log('Email already in use.');
                $_SESSION['error_message'] = "It looks like you have already registered.";
                header("Location: login.php"); // Redirect
                exit();
            }

            $userInsert = $this->userModel->insertUser($email, $type, $password, $token);
            if ($userInsert) {
                // The user was successfully registered.

                // Send the email
                if (!$this->emailService->sendRegisterWelcomeEmail($email)) {
                    // throw new \Exception("Failed to send password reset email.");
                    $_SESSION['error_message'] = "Failed to send password reset confirm email, please try again.";
                    header("Location: /public/login.php");
                    exit();
                }

                if (!$this->emailService->sendEmailVerificationEmail($email, $link)) {
                    // throw new \Exception("Failed to send password reset email.");
                    $_SESSION['error_message'] = "Failed to send verify account email, please try again.";
                    header("Location: /public/login.php");
                    exit();
                }

                error_log('You have been registered successfully, please check your emails');
                $_SESSION['success_message'] = "You have been registered successfully!";
                header("Location: login.php"); // Redirect to login or dashboard
                exit();
            } else {
                error_log('An error occurred during registration. Please try again.');
                $_SESSION['error_message'] = "An error occurred during registration. Please try again.";
                header("Location: register.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for registration.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    // ... other private helper methods for validation ...
}
