<?

namespace JoyApplicant\Service;

use SendGrid;
use SendGrid\Mail\Mail;

class EmailService
{
    private $sendGrid;

    public function __construct($apiKey)
    {
        $this->sendGrid = new SendGrid($_ENV['SMTP_KEY']);
    }

    // public function sendEmail($to, $subject, $htmlContent)
    // {
    //     $email = new Mail();
    //     $email->setFrom("your-email@example.com", "Your Name or Your Company Name");
    //     $email->setSubject($subject);
    //     $email->addTo($to);
    //     $email->addContent("text/html", $htmlContent);

    //     try {
    //         $response = $this->sendGrid->send($email);
    //         return $response;
    //     } catch (\Exception $e) {
    //         error_log("Email failed to send. Error: " . $e->getMessage());
    //         return false;
    //     }
    // }

    public function sendRegisterWelcomeEmail($to)
    {
        $subject = "Welcome to JoyApplicant";
        $body = 'We\'re so lucky to have you here at JoyApplicant. Let\'s dive right in nd <a href="' . $_ENV['DOMAIN_URL'] . 'public/login">get started now</a>.';

        $email = new Mail();
        $email->setFrom($_ENV['SMTP_FROM_ADDRESS'], $_ENV['SMTP_FROM_NAME']);
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $body);

        try {
            $response = $this->sendGrid->send($email);
            return $response;
        } catch (\Exception $e) {
            error_log("Email failed to send. Error: " . $e->getMessage());
            return false;
        }
    }

    public function sendEmailVerificationEmail($to, $link)
    {
        $subject = "Verify your JoyApplicant account";
        $body = 'To verify your account, please <a href="' . $link . '">click here</a>.';

        $email = new Mail();
        $email->setFrom($_ENV['SMTP_FROM_ADDRESS'], $_ENV['SMTP_FROM_NAME']);
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $body);

        try {
            $response = $this->sendGrid->send($email);
            return $response;
        } catch (\Exception $e) {
            error_log("Email failed to send. Error: " . $e->getMessage());
            return false;
        }
    }

    public function sendPasswordResetEmail($to, $link)
    {
        $subject = "Let's reset your JoyApplicant password";
        $body = 'To reset your password, please <a href="' . $link . '">click here</a>.';

        $email = new Mail();
        $email->setFrom($_ENV['SMTP_FROM_ADDRESS'], $_ENV['SMTP_FROM_NAME']);
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $body);

        try {
            $response = $this->sendGrid->send($email);
            return $response;
        } catch (\Exception $e) {
            error_log("Email failed to send. Error: " . $e->getMessage());
            return false;
        }
    }

    public function sendPasswordResetConfirmEmail($to)
    {
        $subject = "Confirmation of JoyApplicant password reset";
        $body = 'Your password was successfully reset. If you did not make this change, please contact us immediately.';

        $email = new Mail();
        $email->setFrom($_ENV['SMTP_FROM_ADDRESS'], $_ENV['SMTP_FROM_NAME']);
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $body);

        try {
            $response = $this->sendGrid->send($email);
            return $response;
        } catch (\Exception $e) {
            error_log("Email failed to send. Error: " . $e->getMessage());
            return false;
        }
    }
}
