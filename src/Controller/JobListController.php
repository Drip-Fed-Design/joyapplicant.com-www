<?

namespace JoyApplicant\Controller;

use JoyApplicant\Model\JobListModel;

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
}
