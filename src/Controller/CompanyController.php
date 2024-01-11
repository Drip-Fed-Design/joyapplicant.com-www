<?

namespace JoyApplicant\Controller;

use JoyApplicant\Model\CompanyModel;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class CompanyController
{
    protected $dbConnection;
    protected $companyModel;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->companyModel = new CompanyModel($dbConnection);
    }

    public function companyDetails($userId)
    {
        $companyQuery = $this->companyModel->lookupUsersCompany($userId);
        if ($companyQuery) {
            // The job was successfully fetched.
            error_log('Company has been successfully fetched!');
            return $companyQuery;
        } else {
            error_log('An error occurred during Company fetch. Please try again.');
            return false;
        }
    }
}
