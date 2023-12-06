<?

namespace JoyApplicant\Model;

use DateTime;

class UserModel
{
    protected $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function insertUser($email, $type, $password, $token)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO joyUsers (email, type, password, verify_email_token) VALUES (:email, :type, :password, :token)";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':token', $token);

        try {
            $stmt->execute();
            error_log('SQL MAIN INSERT'); // TEMPORARY
            return true;
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                // Handle the unique constraint violation, which means the email already exists
                error_log('Email already exists: ' . $e->getMessage());
                throw new \Exception("Email already exists.");
            } else {
                // Handle other SQL related errors here
                error_log('Failed to insert user: ' . $e->getMessage());
                throw new \Exception("An error occurred when registering the user.");
            }
        }
    }

    public function selectUser($email, $password)
    {
        try {
            // Prepare SQL statement to select user by email
            $stmt = $this->dbConnection->prepare("SELECT * FROM joyUsers WHERE email = :email");
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR); // Notice the backslash before PDO
            $stmt->execute();

            // Fetch user data
            $user = $stmt->fetch(\PDO::FETCH_ASSOC); // Notice the backslash before PDO

            // Check if user was found
            if ($user) {
                // Verify the password with the hashed password in the database
                if (password_verify($password, $user['password'])) {
                    // Password is correct, return user data
                    return $user;
                } else {
                    // Password is incorrect, return false
                    return false;
                }
            } else {
                // No user found with that email address
                return false;
            }
        } catch (\PDOException $e) { // Notice the backslash before PDOException
            // Handle the exception as needed
            error_log('Failed to select user: ' . $e->getMessage());
            throw $e; // Rethrow it if you want to handle it further up the call stack
        }
    }

    public function validateEmailVerifyToken($email, $token)
    {
        try {
            // Prepare a SQL statement to select the user based on the email
            $stmt = $this->dbConnection->prepare("SELECT verify_email_token FROM joyUsers WHERE email = :email");
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $dbToken = $row['verify_email_token'];

                // Verify if the token matches
                if ($token === $dbToken) {

                    // Prepare a SQL statement to update the user's verification
                    $stmt = $this->dbConnection->prepare("UPDATE joyUsers SET verified_email = 1, verify_email_token = NULL WHERE email = :email");
                    $stmt->bindParam(':email', $email, \PDO::PARAM_STR);

                    $stmt->execute();

                    // Check if the verification was successful
                    if ($stmt->rowCount() > 0) {
                        error_log('Token is valid');
                        return true; // Token is valid
                    } else {
                        error_log('Token is invalid');
                        return false; // Verify failed
                    }
                } else {
                    error_log('Token is invalid');
                }
            }

            error_log('No user found with email ' . $email . ', or tokens ' . $dbToken . ' and ' . $token . '  do not match');
            return false; // No user found with that email, or token does not match
        } catch (\PDOException $e) {
            // Handle the error properly - this could be logging the error, showing a user-friendly message, etc.
            error_log('Email verify token failed: ' . $e->getMessage());
            return false;
        }
    }

    public function storePasswordReset($email, $hashedPassword)
    {
        try {
            // Prepare a SQL statement to update the user's password
            $stmt = $this->dbConnection->prepare("UPDATE joyUsers SET password = :password, password_reset_token = NULL, token_expiration = NULL WHERE email = :email");

            $stmt->bindParam(':password', $hashedPassword, \PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);

            $stmt->execute();

            // Check if the password was successfully updated
            if ($stmt->rowCount() > 0) {
                return true; // Password reset was successful
            } else {
                return false; // Password reset failed
            }
        } catch (\PDOException $e) {
            // Handle the error properly - this could be logging the error, showing a user-friendly message, etc.
            error_log('Failed to reset password: ' . $e->getMessage());
            return false;
        }
    }

    public function storePasswordResetToken($email, $token)
    {
        $expires = new \DateTime('NOW');
        $expires->add(new \DateInterval('PT15M')); // Token valid for 15 minutes - (PT01H) = 1 hour

        $sql = "UPDATE joyUsers SET password_reset_token = :token, token_expiration = :expires WHERE email = :email";
        $stmt = $this->dbConnection->prepare($sql);

        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expires', $expires->format('Y-m-d H:i:s'));
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function validatePasswordResetToken($email, $token)
    {
        try {
            // Prepare a SQL statement to select the user based on the email
            $stmt = $this->dbConnection->prepare("SELECT password_reset_token, token_expiration FROM joyUsers WHERE email = :email");
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $dbToken = $row['password_reset_token'];
                $tokenExpiration = $row['token_expiration'];

                // Convert date to 'Y-m-d H:i:s' format.
                $tokenExpiration = new DateTime($tokenExpiration);
                $nowDateTime = new DateTime();

                // Check if the token has expired
                if ($nowDateTime->getTimestamp() > $tokenExpiration->getTimestamp()) {
                    error_log('Token failed on ' . $nowDateTime->getTimestamp() . ' > ' . $tokenExpiration->getTimestamp());
                    return false; // Token has expired
                }

                // Verify if the token matches
                if (password_verify($token, $dbToken)) {
                    error_log('Token is valid');
                    return true; // Token is valid
                } else {
                    error_log('Token is invalid');
                }
            }

            error_log('No user found with email ' . $email . ', or tokens ' . $dbToken . ' and ' . $token . '  do not match');
            return false; // No user found with that email, or token does not match
        } catch (\PDOException $e) {
            // Handle the error properly - this could be logging the error, showing a user-friendly message, etc.
            error_log('Password reset token validation failed: ' . $e->getMessage());
            return false;
        }
    }

    public function emailExists($email)
    {
        error_log('SQLEMAILCHECK'); // TEMPORARY
        $stmt = $this->dbConnection->prepare("SELECT COUNT(*) FROM joyUsers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // ... other database related methods ...
}
