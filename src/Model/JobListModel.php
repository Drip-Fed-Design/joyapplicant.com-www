<?

namespace JoyApplicant\Model;

class JobListModel
{
    protected $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function insertJobStart($jobSession, $userId, $companyId, $jobTitle, $employmentType, $jobCategory, $jobRole, $workingConditions, $workingShift, $jobCountry, $jobPostcodeZip)
    {
        $sql = "INSERT INTO joyJobPosts (session, title, type, category, role, conditions, shift, country, postcodezip, company, created_by) VALUES (:jobSession, :jobTitle, :employmentType, :jobCategory, :jobRole, :workingConditions, :workingShift, :jobCountry, :jobPostcodeZip, :companyId, :userId)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':jobSession', $jobSession);
        $stmt->bindParam(':jobTitle', $jobTitle);
        $stmt->bindParam(':employmentType', $employmentType);
        $stmt->bindParam(':jobCategory', $jobCategory);
        $stmt->bindParam(':jobRole', $jobRole);
        $stmt->bindParam(':workingConditions', $workingConditions);
        $stmt->bindParam(':workingShift', $workingShift);
        $stmt->bindParam(':jobCountry', $jobCountry);
        $stmt->bindParam(':jobPostcodeZip', $jobPostcodeZip);
        $stmt->bindParam(':companyId', $companyId);
        $stmt->bindParam(':userId', $userId);

        try {
            $stmt->execute();
            error_log('SQL insert ADDING job start');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert user: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting ADDING job start");
        }
    }
}
