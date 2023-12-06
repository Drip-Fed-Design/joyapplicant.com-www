<?

namespace JoyApplicant\Controller;

use JoyApplicant\Model\JobModel;

class JobController
{
    protected $dbConnection;
    protected $jobModel;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->jobModel = new JobModel($dbConnection);
    }

    public function getRandomJob($quantity)
    {

        // Check if quantity is larger than 0
        if ($quantity > 0) {
            // If quantity is greater than 0
            $jobQuery = $this->jobModel->selectJob($quantity);
            if ($jobQuery) {
                // The job was successfully fetched.
                error_log('Job has been successfully fetched!');
                return $jobQuery;
            } else {
                error_log('An error occurred during job fetch. Please try again.');
                return false;
            }
        } else {
            // If quantity has not been provided
            error_log('A job fetch needs to have a quantity of 1 or more. Please try again.');
            return false;
        }
    }

    public function getKeywordJob($quantity, $keywords)
    {

        // Check if quantity is larger than 0
        if ($quantity > 0) {
            // If quantity is greater than 0
            $jobQuery = $this->jobModel->selectJob($quantity, $keywords);
            if ($jobQuery) {
                // The job was successfully fetched.
                error_log('Job has been successfully fetched!');
                return $jobQuery;
            } else {
                error_log('An error occurred during job fetch. Please try again.');
                return false;
            }
        } else {
            // If quantity has not been provided
            error_log('A job fetch needs to have a quantity of 1 or more. Please try again.');
            return false;
        }
    }
}
