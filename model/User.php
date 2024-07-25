<?php
include_once "../utils/customerror.php";
class User
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAlluser($lang)
    {
        try {
            $alluserquery = "SELECT * FROM users as user 
                    INNER JOIN user_translate as ut 
                    ON user.id = ut.user_id 
                    WHERE ut.lang = '$lang'";
            $stmt = $this->conn->prepare($alluserquery);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (\Throwable $th) {
            logMessage("error", $th->getMessage(), "../logs/error_log.txt");
        }
    }

    public function getAllactiveuser($lang)
    {
        try {
            $alluserquery = "SELECT * FROM users as user 
                    INNER JOIN user_translate as ut 
                    ON user.id = ut.user_id 
                    WHERE ut.lang = '$lang' and status='active'";
            $stmt = $this->conn->prepare($alluserquery);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (\Throwable $th) {
            logMessage("error", $th->getMessage(), "../logs/error_log.txt");
        }
    }

    public function filterByfields($userfields)
    {
        try {
            $fields = [];
            $params = [];
            foreach ($userfields as $key => $value) {
                $fields[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            $stringfield = implode(",", $fields);

            $filterquery = "SELECT * FROM users where $stringfield";

            $stmt = $this->conn->prepare($filterquery);
            $stmt->execute($params);
            $result = $stmt->fetchAll();

            return $result;
        } catch (\Throwable $th) {
            logMessage("error", $th->getMessage(), "../logs/error_log.txt");
        }
    }

    public function getalltranslations()
    {
        try {
            $query = "select * from translations";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            print_r($result);
            $translations = [];
            foreach ($result as $row) {
                $language = $row['language'];
                if (!isset($translations[$language])) {
                    $translations[$language] = [];
                }
                $translations[$language][$row['msgid']] = $row['msgstr'];
            }

            return $translations;
        } catch (\Throwable $th) {
            logMessage("error", $th->getMessage(), "../logs/error_log.txt");
        }
    }
    public function tokenbasedlogin()
    {
        try {
            $token = $_COOKIE["rememberme"];
            $tokenquery = "SELECT * FROM users where token = :token";
            $stmt = $this->conn->prepare($tokenquery);
            $stmt->execute([":token" => $token]);
            $result = $stmt->fetch();
            return $result;

        } catch (\Throwable $th) {
            logMessage("error", $th->getMessage(), "../logs/error_log.txt");
        }
    }

    public function forgotPassword()
    {

    }
}
