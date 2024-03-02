<?

namespace JoyApplicant\Model;

use DateTime;

class JobModel
{
    protected $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function selectJob($jobQuantity, $jobKeywords = null)
    {
        // Get current timestamp
        $currentDate = new \DateTime();
        $currentDateString = $currentDate->format('Y-m-d H:i:s');

        try {
            // Prepare SQL statement to select random job posts
            // Ensure that the current date is between date_opening and date_closing
            // Limit the number of results by the specified quantity
            if (isset($jobKeywords)) {
                $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts INNER JOIN joyCompanies ON joyJobPosts.company=joyCompanies.id WHERE status = 1 AND requirements LIKE CONCAT('%', :jobKeywords , '%') AND (:currentDate BETWEEN date_opening AND date_closing) ORDER BY RAND() LIMIT :jobQuantity");
                $stmt->bindParam(':jobKeywords', $jobKeywords, \PDO::PARAM_STR);
            } else {
                $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts INNER JOIN joyCompanies ON joyJobPosts.company=joyCompanies.id WHERE status = 1 AND (:currentDate BETWEEN date_opening AND date_closing) ORDER BY RAND() LIMIT :jobQuantity");
            }

            $stmt->bindParam(':currentDate', $currentDateString, \PDO::PARAM_STR);
            $stmt->bindValue(':jobQuantity', (int) $jobQuantity, \PDO::PARAM_INT);

            $stmt->execute();

            // Fetch the job data
            $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Notice the backslash before PDO
            return $jobs;
        } catch (\PDOException $e) { // Notice the backslash before PDOException
            // Handle the exception as needed
            error_log('Failed to select job: ' . $e->getMessage());
            throw $e; // Rethrow it if you want to handle it further up the call stack
        }
    }

    public function selectCompanyJobs($companyId, $jobQuantity, $jobStatus = 'live')
    {
        try {
            // Differentiate live/draft jobs
            if ($jobStatus === 'live') {
                $jobStatus = 1;
            } else {
                $jobStatus = 0;
            }

            // Prepare SQL statement to select random job posts
            $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts WHERE status = :jobStatus AND company = :companyId LIMIT :jobQuantity");

            $stmt->bindValue(':jobQuantity', (int) $jobQuantity, \PDO::PARAM_INT);
            $stmt->bindValue(':companyId', $companyId);
            $stmt->bindValue(':jobStatus', $jobStatus);

            $stmt->execute();

            // Fetch the job data
            $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Notice the backslash before PDO
            return $jobs;
        } catch (\PDOException $e) { // Notice the backslash before PDOException
            // Handle the exception as needed
            error_log('Failed to select job: ' . $e->getMessage());
            throw $e; // Rethrow it if you want to handle it further up the call stack
        }
    }

    public function selectCompanyJobById($companyId, $jobId)
    {
        try {

            // Prepare SQL statement to select random job posts
            $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts WHERE id = :jobId AND company = :companyId");

            $stmt->bindValue(':companyId', $companyId);
            $stmt->bindValue(':jobId', (int) $jobId, \PDO::PARAM_INT);

            $stmt->execute();

            // Fetch the job data
            $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Notice the backslash before PDO
            return $jobs;
        } catch (\PDOException $e) { // Notice the backslash before PDOException
            // Handle the exception as needed
            error_log('Failed to select job: ' . $e->getMessage());
            throw $e; // Rethrow it if you want to handle it further up the call stack
        }
    }
}
