<?

namespace JoyApplicant\Model;

class OnboardModel
{
    protected $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function onboardExists($userId)
    {
        error_log('Checking user onboard');
        $stmt = $this->dbConnection->prepare("SELECT COUNT(*) FROM joyUsersDetails WHERE user = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function onboardExperienceExists($userId)
    {
        error_log('Checking user onboard');
        $stmt = $this->dbConnection->prepare("SELECT COUNT(*) FROM joyUsersExperience WHERE user = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function onboardDiscoveryExists($userId)
    {
        error_log('Checking user onboard alias');
        $stmt = $this->dbConnection->prepare("SELECT COUNT(*) FROM joyUsersAlias WHERE user = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function onboardDiscoveryCompanyExists($userId)
    {
        error_log('Checking COMPANY onboard alias');
        $stmt = $this->dbConnection->prepare("SELECT COUNT(*) FROM joyCompaniesAlias WHERE created_by = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function onboardCompanyExists($userId)
    {
        error_log('Checking user onboard alias');
        $stmt = $this->dbConnection->prepare("SELECT COUNT(*) FROM joyCompanies WHERE created_by = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function userTelephoneExists($telephone)
    {
        error_log('Checking user telephone onboard');
        $stmt = $this->dbConnection->prepare("SELECT COUNT(*) FROM joyUsersDetails WHERE telephone = :telephone");
        $stmt->bindParam(':telephone', $telephone);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function insertOnboardYou($userId, $firstName, $lastName, $telephone, $country, $postcodezip, $findUs)
    {
        $sql = "INSERT INTO joyUsersDetails (user, first_name, last_name, telephone, country, postcodezip, find_us) VALUES (:userId, :firstName, :lastName, :telephone, :country, :postcodezip, :findUs)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':postcodezip', $postcodezip);
        $stmt->bindParam(':findUs', $findUs);

        try {
            $stmt->execute();
            error_log('SQL insert YOU onboard details for USER');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert user: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting onboard details for USER");
        }
    }

    public function insertOnboardExperience($userId, $entry, $role, $company, $current, $startDate, $endDate, $desc)
    {
        $sql = "INSERT INTO joyUsersExperience (user, experience, role, company, working_role, start_date, end_date, description) VALUES (:userId, :entry, :role, :company, :workingRole, :startDate, :endDate, :desc)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':entry', $entry);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':workingRole', $current);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':desc', $desc);

        try {
            $stmt->execute();
            error_log('SQL insert EXPERIENCE onboard details for USER');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert onboard EXPERIENCE: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting onboard EXPERIENCE details for USER");
        }
    }

    public function insertOnboardExperienceEntry($userId, $entry)
    {
        $sql = "INSERT INTO joyUsersExperience (user, experience) VALUES (:userId, :entry)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':entry', $entry);

        try {
            $stmt->execute();
            error_log('SQL insert EXPERIENCE ENTRY onboard details for USER');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert onboard EXPERIENCE ENTRY: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting onboard EXPERIENCE ENTRY details for USER");
        }
    }

    public function insertOnboardDiscovery($userId, $visibility, $alias)
    {
        $sql = "INSERT INTO joyUsersAlias (user, visibility, alias) VALUES (:userId, :visibility, :alias)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':visibility', $visibility);
        $stmt->bindParam('alias', $alias);

        try {
            $stmt->execute();
            error_log('SQL insert DISCOVERY ENTRY onboard details for USER');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert onboard DISCOVERY ENTRY: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting onboard DISCOVERY ENTRY details for USER");
        }
    }

    public function insertOnboardCompany($userId, $name, $desc, $telephone, $email, $country, $postcodezip)
    {
        // $sql = "INSERT INTO joyCompanies (email, telephone, name, logo, country, postcodezip, category, established, employees, description, about, culture, admins, created_by) VALUES (:email, :telephone, :name, null, :country, :postcodezip, null, null, null, :desc, null, null, null, :userId)";
        $sql = "INSERT INTO joyCompanies (email, telephone, name, country, postcodezip, description, created_by) VALUES (:email, :telephone, :name, :country, :postcodezip, :desc, :userId)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':postcodezip', $postcodezip);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':userId', $userId);

        try {
            $stmt->execute();
            error_log('SQL insert COMPANY onboard details for USER');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert onboard COMPANY: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting onboard COMPANY details for USER");
        }
    }

    public function insertOnboardDiscoveryCompany($companyId, $userId, $visibility, $alias)
    {
        $sql = "INSERT INTO joyCompaniesAlias (company, visibility, alias, created_by) VALUES (:companyId, :visibility, :alias, :userId)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':companyId', $companyId);
        $stmt->bindParam(':visibility', $visibility);
        $stmt->bindParam('alias', $alias);
        $stmt->bindParam(':userId', $userId);

        try {
            $stmt->execute();
            error_log('SQL insert COMPANY DISCOVERY onboard details for USER');
            return true;
        } catch (\PDOException $e) {
            // Handle other SQL related errors here
            error_log('Failed to insert onboard COMPANY DISCOVERY ENTRY: ' . $e->getMessage());
            throw new \Exception("An error occurred when inserting onboard DISCOVERY details for COMPANY");
        }
    }

    // public function selectOnboard($quantity, $keywords = null)
    // {
    //     // Get current timestamp
    //     $currentDate = new \DateTime();
    //     $currentDateString = $currentDate->format('Y-m-d H:i:s');

    //     try {
    //         // Prepare SQL statement to select random job posts
    //         // Ensure that the current date is between date_opening and date_closing
    //         // Limit the number of results by the specified quantity
    //         if (isset($keywords)) {
    //             $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts INNER JOIN joyCompanies ON joyJobPosts.company=joyCompanies.id WHERE keywords LIKE CONCAT('%', :keywords , '%') AND (:currentDate BETWEEN date_opening AND date_closing) ORDER BY RAND() LIMIT :quantity");
    //             $stmt->bindParam(':keywords', $keywords, \PDO::PARAM_STR);
    //         } else {
    //             $stmt = $this->dbConnection->prepare("SELECT * FROM joyJobPosts INNER JOIN joyCompanies ON joyJobPosts.company=joyCompanies.id WHERE (:currentDate BETWEEN date_opening AND date_closing) ORDER BY RAND() LIMIT :quantity");
    //         }

    //         $stmt->bindParam(':currentDate', $currentDateString, \PDO::PARAM_STR);
    //         $stmt->bindValue(':quantity', (int) $quantity, \PDO::PARAM_INT);

    //         $stmt->execute();

    //         // Fetch the job data
    //         $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Notice the backslash before PDO
    //         return $jobs;
    //     } catch (\PDOException $e) { // Notice the backslash before PDOException
    //         // Handle the exception as needed
    //         error_log('Failed to select job: ' . $e->getMessage());
    //         throw $e; // Rethrow it if you want to handle it further up the call stack
    //     }
    // }
}
