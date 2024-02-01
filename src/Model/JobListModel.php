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
        $stmt->bindParam(':companyId', $companyId);
        $stmt->bindParam(':userId', $userId);

        $stmt->bindParam(':jobTitle', $jobTitle);
        $stmt->bindParam(':employmentType', $employmentType);
        $stmt->bindParam(':jobCategory', $jobCategory);
        $stmt->bindParam(':jobRole', $jobRole);

        $stmt->bindParam(':workingConditions', $workingConditions);
        $stmt->bindParam(':workingShift', $workingShift);
        $stmt->bindParam(':jobCountry', $jobCountry);
        $stmt->bindParam(':jobPostcodeZip', $jobPostcodeZip);

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

    public function insertJobDetails($jobSession, $companyId, $jobVolunteer, $salaryCurrency, $salaryMin, $salaryMax, $salaryTerm, $jobWhy, $jobDuties, $jobResponsibilities)
    {
        $sql = "UPDATE joyJobPosts SET voluntary = :jobVolunteer, currency = :salaryCurrency, salary_min = :salaryMin, salary_max = :salaryMax, salary_term = :salaryTerm, why = :jobWhy, duties = :jobDuties, responsibilities = :jobResponsibilities WHERE session = :jobSession AND company = :companyId";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':jobSession', $jobSession);
        $stmt->bindParam(':companyId', $companyId);

        $stmt->bindParam(':jobVolunteer', $jobVolunteer);
        $stmt->bindParam(':salaryCurrency', $salaryCurrency);
        $stmt->bindParam(':salaryMin', $salaryMin);
        $stmt->bindParam(':salaryMax', $salaryMax);
        $stmt->bindParam(':salaryTerm', $salaryTerm);

        $stmt->bindParam(':jobWhy', $jobWhy);
        $stmt->bindParam(':jobDuties', $jobDuties);
        $stmt->bindParam(':jobResponsibilities', $jobResponsibilities);

        try {
            $stmt->execute();
            error_log('SQL insert ADDING job details');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert user: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting ADDING job details");
        }
    }

    public function insertJobRequirements($jobSession, $companyId, $jobRequirements)
    {
        $sql = "UPDATE joyJobPosts SET requirements = :jobRequirements WHERE session = :jobSession AND company = :companyId";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':jobSession', $jobSession);
        $stmt->bindParam(':companyId', $companyId);

        $stmt->bindParam(':jobRequirements', $jobRequirements);

        try {
            $stmt->execute();
            error_log('SQL insert ADDING job requirements');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert user: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting ADDING job requirements");
        }
    }

    public function insertJobDates($jobSession, $companyId, $jobStatus, $dateOpening, $dateClosing, $dateInterview, $dateTarget)
    {
        $sql = "UPDATE joyJobPosts SET status = :jobStatus, date_opening = :dateOpening, date_closing = :dateClosing, date_interviews = :dateInterview, date_target = :dateTarget WHERE session = :jobSession AND company = :companyId";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':jobSession', $jobSession);
        $stmt->bindParam(':companyId', $companyId);

        $stmt->bindParam(':jobStatus', $jobStatus);

        $stmt->bindParam(':dateOpening', $dateOpening);
        $stmt->bindParam(':dateClosing', $dateClosing);
        $stmt->bindParam(':dateInterview', $dateInterview);
        $stmt->bindParam(':dateTarget', $dateTarget);

        try {
            $stmt->execute();
            error_log('SQL insert ADDING job dates');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert user: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting ADDING job dates");
        }
    }
}
