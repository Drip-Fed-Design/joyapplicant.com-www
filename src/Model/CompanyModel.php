<?

namespace JoyApplicant\Model;

class CompanyModel
{
    protected $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function lookupUsersCompany($userId)
    {
        error_log('Checking user company details');
        $stmt = $this->dbConnection->prepare("SELECT * FROM joyCompanies WHERE created_by = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $details = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Notice the backslash before PDO
        return $details;
    }
}
