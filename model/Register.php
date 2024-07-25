<?php
include "../utils/Translateuser.php";
include_once "../utils/customerror.php";
class Register
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function userExists($pdo, $username) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetchColumn() > 0;
    }

    public function emailExists($pdo, $email) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function addUser($data)
    {
        try {
            if($this->userExists($this->conn, $data['username'])) {
                $username = $data['username'];
                logMessage("error","Username $username Already exist","../logs/error_log.txt");
                session_start();
                $_SESSION["reg_error_message"]="Username $username Already exist";
                header("Location:../view/signup.php");
            }
            if($this->emailExists($this->conn, $data['email'])) {
                $email = $data['email'];
                logMessage("error","email $email Already exist","../logs/error_log.txt");
                session_start();
                $_SESSION["reg_error_message"]="email $email Already exist";
                header("Location:../view/signup.php");
            }
            $insertquery = "INSERT INTO users(username,email,password,profile_photo) VALUES (:username, :email, :password, :profile_photo)";

            $stmt = $this->conn->prepare($insertquery);
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
            $stmt->execute([
                ':username' => $data['username'],
                ':email' => $data['email'],
                ':password' => $data['password'],
                ':profile_photo' => $data['profile_photo']
            ]);
            logMessage("info","User data inserted into user table");
            session_start();
            $logincheck = "SELECT * FROM users WHERE username=:username";

            $stmt = $this->conn->prepare($logincheck);
            $stmt->bindValue(":username", $data["username"]);
            $stmt->execute();
            $result = $stmt->fetch();
            $name = $data["first_name"] . " " . $data["last_name"];
            $result["name"]=$name;
            $_SESSION["user"] = $result;
            $insertquery = "INSERT INTO user_translate(user_id,name,lang) VALUES (:user_id, :name, :lang)";

            $stmt = $this->conn->prepare($insertquery);
            $stmt->execute([
                ':user_id' => $result["id"],
                ':name' => $name,
                ':lang' => "en_US",
            ]);


            $translatedTextChinese = translateText($name, "english", 'chinese');
            logMessage("info","Name converted to chinese");
            $stmt = $this->conn->prepare($insertquery);
            $stmt->execute([
                ':user_id' => $result["id"],
                ':name' => $translatedTextChinese,
                ':lang' => "zh_CN",
            ]);

            $translatedTextFrench = translateText($name, "english", 'fr');
            logMessage("info","Name converted to french");
            $stmt = $this->conn->prepare($insertquery);
            $stmt->execute([
                ':user_id' => $result["id"],
                ':name' => $translatedTextFrench,
                ':lang' => "fr_FR",
            ]);
            logMessage("info","User successfully registered");
            header("Location:../view/admin.php");
        } catch (\Throwable $th) {
            customException($th->getMessage());
        }
    }

    public function updateUser($id, $userdata)
    {
        try {
            $fields = [];
            $params = [':id' => $id];

            foreach ($userdata as $field => $value) {
                $fields[] = "$field = :$field";
                $params[":$field"] = $value;
            }

            $fields_sql = implode(', ', $fields);
            $updateuserquery = "UPDATE users SET $fields_sql where id = :id";

            $stmt = $this->conn->prepare($updateuserquery);

            foreach ($params as $key => &$val) {
                $stmt->bindParam($key, $val);
            }

            $stmt->execute();

            echo "Update Successfull";
        } catch (\Throwable $th) {
            customException($th->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try {
            $deletequery = "DELETE FROM users where id = :id";

            $stmt = $this->conn->prepare($deletequery);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            echo "Delete Successfully!!";
        } catch (\Throwable $th) {
            customException($th->getMessage());
        }
    }

}