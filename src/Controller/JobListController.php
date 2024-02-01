<?

namespace JoyApplicant\Controller;

use JoyApplicant\Model\JobListModel;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class JobListController
{
    protected $dbConnection;
    protected $jobListModel;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->jobListModel = new jobListModel($dbConnection);
    }

    public function listJobStart($jobSession, $userId, $companyId, $jobTitle, $employmentType, $jobCategory, $jobRole, $workingConditions, $workingShift, $jobCountry, $jobPostcodeZip)
    {
        // Input validation
        // $telephoneValidator = v::phone();

        try {
            // Validate the telephone
            // $telephoneValidator->assert($telephone);

            // Check if the telephone already exists in the database
            // if ($this->onboardModel->userTelephoneExists($telephone)) {
            //     error_log('Telephone already in use');
            //     $_SESSION['error_message'] = "It looks like the telephone number has already been used. Please contact our support team if this is your telephone number.";
            //     header("Location: you.php"); // Redirect
            //     exit();
            // }

            $jobListInsert = $this->jobListModel->insertJobStart($jobSession, $userId, $companyId, $jobTitle, $employmentType, $jobCategory, $jobRole, $workingConditions, $workingShift, $jobCountry, $jobPostcodeZip);
            if ($jobListInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful LIST job start');
                header("Location: details.php"); // Redirect to details
                exit();
            } else {
                error_log('An error occurred during LIST job start');
                $_SESSION['error_message'] = "An error occurred during the listing of your job. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for LIST job start');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function listJobDetails($jobSession, $companyId, $jobVolunteer, $salaryCurrency, $salaryMin, $salaryMax, $salaryTerm, $jobWhy, $jobDuties, $jobResponsibilities)
    {
        // Input validation
        $currencyValidator = v::currencyCode();
        $salaryValidator = v::decimal(2);

        try {
            // Validate the telephone
            $currencyValidator->assert($salaryCurrency);
            $salaryValidator->assert($salaryMin);
            $salaryValidator->assert($salaryMax);


            $jobListInsert = $this->jobListModel->insertJobDetails($jobSession, $companyId, $jobVolunteer, $salaryCurrency, $salaryMin, $salaryMax, $salaryTerm, $jobWhy, $jobDuties, $jobResponsibilities);
            if ($jobListInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful LIST job details');
                header("Location: requirements.php"); // Redirect to requirements
                exit();
            } else {
                error_log('An error occurred during LIST job details');
                $_SESSION['error_message'] = "An error occurred during the listing of your job. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for LIST job details');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function listJobRequirements($jobSession, $companyId, $jobRequirements)
    {

        try {

            $jobListInsert = $this->jobListModel->insertJobRequirements($jobSession, $companyId, $jobRequirements);
            if ($jobListInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful LIST job requirements');
                header("Location: dates.php"); // Redirect to dates
                exit();
            } else {
                error_log('An error occurred during LIST job requirements');
                $_SESSION['error_message'] = "An error occurred during the listing of your job. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for LIST job requirements');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function listJobDates($jobSession, $companyId, $jobStatus, $dateOpening, $dateClosing, $dateInterview, $dateTarget)
    {
        // Input validation
        $dateValidator = v::date('Y-m-d');

        try {
            // Validate the telephone
            $dateValidator->assert($dateOpening);
            $dateValidator->assert($dateClosing);
            $dateValidator->assert($dateInterview);
            $dateValidator->assert($dateTarget);


            $jobListInsert = $this->jobListModel->insertJobDates($jobSession, $companyId, $jobStatus, $dateOpening, $dateClosing, $dateInterview, $dateTarget);
            if ($jobListInsert) {
                // The YOU step for the user has been successful.
                error_log('Successful LIST job dates');
                header("Location: success.php"); // Redirect to requirements
                exit();
            } else {
                error_log('An error occurred during LIST job dates');
                $_SESSION['error_message'] = "An error occurred during the listing of your job. Please try again.";
                header("Location: /../user/dashboard.php"); // Redirect
                exit();
            }
        } catch (NestedValidationException $e) {
            error_log($e->getFullMessage());
            throw new \Exception('Invalid data provided for LIST job dates');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}
