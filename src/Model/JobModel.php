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

    public function selectJob($quantity, $keywords = null)
    {
        // Get current timestamp
        $currentDate = new \DateTime();
        $currentDateString = $currentDate->format('Y-m-d H:i:s');

        try {
            // Prepare SQL statement to select random job posts
            // Ensure that the current date is between date_opening and date_closing
            // Limit the number of results by the specified quantity
            if (isset($keywords)) {
                $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts INNER JOIN joyCompanies ON joyJobPosts.company=joyCompanies.id WHERE keywords LIKE CONCAT('%', :keywords , '%') AND (:currentDate BETWEEN date_opening AND date_closing) ORDER BY RAND() LIMIT :quantity");
                $stmt->bindParam(':keywords', $keywords, \PDO::PARAM_STR);
            } else {
                $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts INNER JOIN joyCompanies ON joyJobPosts.company=joyCompanies.id WHERE (:currentDate BETWEEN date_opening AND date_closing) ORDER BY RAND() LIMIT :quantity");
            }

            $stmt->bindParam(':currentDate', $currentDateString, \PDO::PARAM_STR);
            $stmt->bindValue(':quantity', (int) $quantity, \PDO::PARAM_INT);

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
