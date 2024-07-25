<?php
include "../utils/Exception.php";
include_once "../utils/customerror.php";
class Login
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function userLogin($userdata)
    {
        try {
            // Check Username Query 
            $logincheck = "SELECT * FROM users WHERE username=:username";

            $stmt = $this->conn->prepare($logincheck);
            $stmt->bindValue(":username", $userdata["username"]);
            $stmt->execute();
            $result = $stmt->fetch();

            if (!empty($result)) {
                // Verify Password 
                if (password_verify($userdata["password"], $result["password"])) {

                    // Update last login 
                    $updatelastlogin = "UPDATE users SET last_login =:lastlogin,token=:token where username = :username";

                    $currenttime = date('Y-m-d H:i:s');
                    $stmt = $this->conn->prepare($updatelastlogin);
                    $stmt->bindValue(":username", $userdata["username"]);
                    $stmt->bindValue(":lastlogin", $currenttime);
                    $stmt->bindValue(":token", $userdata["token"]);
                    $stmt->execute();

                    $logincheck = "SELECT * FROM users as user 
                    INNER JOIN user_translate as ut 
                    ON user.id = ut.user_id 
                    WHERE ut.lang = 'en_US'";

                    $stmt = $this->conn->prepare($logincheck);
                    $stmt->execute();
                    $result = $stmt->fetch();


                    session_start();


                    print_r($result);
                    $_SESSION["user"] = $result;
                    echo "aysuhs";

                    if (isset($userdata["remember"])) {
                        setcookie('rememberme', $userdata["token"], time() + (86400 * 7), "/", "", false, true);
                    }

                    header("Location:../view/admin.php");
                } else {

                    logMessage("error", "Invalid Username or Password", "../logs/error_log.txt");
                    header("Location:../view/login.php?error=Invalid Username or Password");
                }
            } else {
                logMessage("error", "Invalid Username", "../logs/error_log.txt");
                header("Location:../view/login.php?error=Invalid Username!");
            }

        } catch (\Throwable $th) {
            logMessage("error", $th->getMessage(), "../logs/error_log.txt");
        }

    }
    public function logout()
    {
        try {
            session_start();
            session_unset();
            session_destroy();
            if (isset($_COOKIE['rememberme'])) {
                unset($_COOKIE['rememberme']);
                setcookie('rememberme', '', -1, '/');
            }
            header("Location:../view/login.php");
            logMessage("info", "logout successfull", "../logs/error_log.txt");
        } catch (\Throwable $th) {
            logMessage("error", $th->getMessage(), "../logs/error_log.txt");
        }
    }
}