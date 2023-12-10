<?

namespace JoyApplicant\Controller;

use JoyApplicant\Model\OnboardModel;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class OnboardController
{
    protected $dbConnection;
    protected $onboardModel;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->onboardModel = new OnboardModel($dbConnection);
    }

    public function checkOnboarding($userId)
    {
        // Check if the email exists
        if (!$this->onboardModel->onboardExists($userId)) {
            // throw new \Exception("Email does not exist.");
            $_SESSION['error_message'] = "Oh, that's not joyful! It looks like you've not finished setting up your account.";
        }
    }

    public function checkOnboardingYou($userId)
    {
        // Check if the email exists
        if ($this->onboardModel->onboardExists($userId)) {
            error_log('onboard YOU already present');
            header("Location: experience.php"); // Redirect
            exit();
        }
    }

    public function checkOnboardingExperience($userId)
    {
        // Check if the email exists
        if ($this->onboardModel->onboardExperienceExists($userId)) {
            error_log('onboard EXPERIENCE already present');
            header("Location: discovery.php"); // Redirect
            exit();
        }
    }

    public function checkOnboardingCompany($userId)
    {
        // Check if the email exists
        if ($this->onboardModel->onboardCompanyExists($userId)) {
            error_log('onboard COMPANY already present');
            header("Location: discovery.php"); // Redirect
            exit();
        }
    }

    public function checkOnboardingDiscovery($userId)
    {
        // Check if the email exists
        if ($this->onboardModel->onboardDiscoveryExists($userId)) {
            error_log('onboard DISCOVERY already present');
            header("Location: /../user/dashboard.php"); // Redirect
            exit();
        }
    }

    public function checkOnboardingDiscoveryCompany($userId)
    {
        // Check if the email exists
        if ($this->onboardModel->onboardDiscoveryCompanyExists($userId)) {
            error_log('onboard DISCOVERY COMPANY already present');
            header("Location: /../user/dashboard.php"); // Redirect
            exit();
        }
    }

    public function userOnboardYou($userId, $firstName, $lastName, $telephone, $country, $city, $findUs)
    {
        // Input validation
        $telephoneValidator = v::phone();

        try {
            // Validate the telephone
            $telephoneValidator->assert($telephone);

            // Check if the telephone already exists in the database
            if ($this->onboardModel->userTelephoneExists($telephone)) {
                error_log('Telephone already in use');
                $_SESSION['error_message'] = "It looks like the telephone number has already been used. Please contact our support team if this is your telephone number.";
                header("Location: you.php"); // Redirect
                exit();
            }

            $onboardInsert = $this->onboardModel->insertOnboardYou($userId, $firstName, $lastName, $telephone, $country, $city, $findUs);
            if ($onboardInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful YOU onboard details for USER');
                header("Location: experience.php"); // Redirect to experience
                exit();
            } else {
                error_log('An error occurred during YOU onboard details for USER');
                $_SESSION['error_message'] = "An error occurred during the setup of your account. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for YOU onboard details for USER.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function userOnboardExperience($userId, $entry, $role, $company, $current, $startDate, $endDate, $desc)
    {
        // Input validation
        $dateValidator = v::date('Y-m-d');

        try {
            // Validate the telephone
            $dateValidator->assert($startDate);
            if ($endDate) {
                $dateValidator->assert($endDate);
            }

            $onboardInsert = $this->onboardModel->insertOnboardExperience($userId, $entry, $role, $company, $current, $startDate, $endDate, $desc);
            if ($onboardInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful EXPERIENCE onboard details for USER');
                header("Location: discovery.php"); // Redirect to experience
                exit();
            } else {
                error_log('An error occurred during EXPERIENCE onboard details for USER');
                $_SESSION['error_message'] = "An error occurred during the setup of your account. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for EXPERIENCE onboard details for USER.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function userOnboardExperienceEntry($userId, $entry)
    {
        try {
            $onboardInsert = $this->onboardModel->insertOnboardExperienceEntry($userId, $entry);
            if ($onboardInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful EXPERIENCE ENTRY onboard details for USER');
                header("Location: discovery.php"); // Redirect to experience
                exit();
            } else {
                error_log('An error occurred during EXPERIENCE ENTRY onboard details for USER');
                $_SESSION['error_message'] = "An error occurred during the setup of your account. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for EXPERIENCE ENTRY onboard details for USER.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function userOnboardDiscovery($userId, $visibility, $alias)
    {
        try {
            $onboardInsert = $this->onboardModel->insertOnboardDiscovery($userId, $visibility, $alias);
            if ($onboardInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful DISCOVERY ENTRY onboard details for USER');
                $_SESSION['success_message'] = "Great work, you've successfully completed your onboarding.";
                header("Location: /../user/dashboard.php"); // Redirect to experience
                exit();
            } else {
                error_log('An error occurred during DISCOVERY ENTRY onboard details for USER');
                $_SESSION['error_message'] = "An error occurred during the setup of your account. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for EXPERIENCE ENTRY onboard details for USER.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function userOnboardCompany($userId, $name, $desc, $telephone, $email, $country, $city)
    {
        // Input validation
        $telephoneValidator = v::phone();
        $emailValidator = v::email();

        try {
            // Validate the telephone
            $telephoneValidator->assert($telephone);
            $emailValidator->assert($email);

            $onboardInsert = $this->onboardModel->insertOnboardCompany($userId, $name, $desc, $telephone, $email, $country, $city);
            if ($onboardInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful EXPERIENCE onboard details for USER');
                header("Location: discovery.php"); // Redirect to experience
                exit();
            } else {
                error_log('An error occurred during EXPERIENCE onboard details for USER');
                $_SESSION['error_message'] = "An error occurred during the setup of your account. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for EXPERIENCE onboard details for USER.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function userOnboardDiscoveryCompany($companyId, $userId, $visibility, $alias)
    {
        try {
            $onboardInsert = $this->onboardModel->insertOnboardDiscoveryCompany($companyId, $userId, $visibility, $alias);
            if ($onboardInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful DISCOVERY onboard details for COMPANY');
                $_SESSION['success_message'] = "Great work, you've successfully completed your onboarding.";
                header("Location: /../user/dashboard.php"); // Redirect to experience
                exit();
            } else {
                error_log('An error occurred during DISCOVERY onboard details for COMPANY');
                $_SESSION['error_message'] = "An error occurred during the setup of your account. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for DISCOVERY onboard details for COMPANY.');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}
