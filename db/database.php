<?php
class Database
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_password = ''; // root for mac, empty for windows
    private $db_db = 'final_project';

    public static $conn = null;

    public function __construct()
    {
        try {
            mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);  // Changement necessaire pour PHP 8.0.26 (WAMP)
            self::$conn = new mysqli(
                $this->db_host,
                $this->db_user,
                $this->db_password,
                $this->db_db
            );
        } catch (mysqli_sql_exception  $e) {  // Changement necessaire pour PHP 8.0.26 (WAMP) (Exception -> mysqli_sql_exception)
            if ($e->getCode() == 1049) {
                $conn = new mysqli(
                    $this->db_host,
                    $this->db_user,
                    $this->db_password
                );
                $sql = "CREATE DATABASE IF NOT EXISTS " . $this->db_db;
                $conn->query($sql);
                $conn->close();
                self::$conn = new mysqli(
                    $this->db_host,
                    $this->db_user,
                    $this->db_password,
                    $this->db_db
                );
                if (self::$conn->connect_error) {
                    echo "Failed to connect to MySQL: " . self::$conn->connect_error;
                    exit();
                }
                $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(30) NOT NULL,
                    lname VARCHAR(30) NOT NULL,
                    email VARCHAR(50) NOT NULL UNIQUE,
                    pwd VARCHAR(255) NOT NULL,
                    registrationTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
                self::$conn->query($sql);
                $sql = "CREATE TABLE IF NOT EXISTS games (
                    id INT NOT NULL AUTO_INCREMENT,
                    user_id INT NOT NULL,
                    tries INT NOT NULL,
                    won BOOLEAN NOT NULL,
                    levelCompleted INT NOT NULL,
                    date DATETIME NOT NULL,
                    PRIMARY KEY (id),
                    FOREIGN KEY (user_id) REFERENCES users(id)
                )";
                self::$conn->query($sql);
            } else {
                echo 'Something went wrong. ' . $e->getMessage();
            }
        }
    }

    // Creation du Nouveau Utilisateur
    public static function createUser($name, $lname, $email, $password)
    {
        $status = null;
        $message = null;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $sql = "INSERT INTO users (name, lname, email, pwd, registrationTime) VALUES ('{$name}', '{$lname}', '{$email}', '{$hashedPassword}', NOW())";
            if (self::$conn->query($sql)) {
                $status = 201;
                $message = 'User created successfully';
            }
        } catch (Exception $e) {
            if ($e->getCode() == 1062) {
                $status = 409;
                $message = 'User already exists';
            } else {
                $status = 500;
                $message = 'Something went wrong. ' . $e->getMessage();
            }
        } finally {
            $sql = "SELECT * FROM users WHERE email = '{$email}'";
            $result = self::$conn->query($sql);
            return json_encode([
                'status' => $status,
                'message' => $message,
                'result' => $result->fetch_assoc()
            ]);
        }
    }

    public static function loginUser($email, $password)
    {
        $status = null;
        $message = null;
        try {
            $sql = "SELECT * FROM users WHERE email = '{$email}'";
            $result = self::$conn->query($sql);
            $resultRow = $result->fetch_assoc();
            if ($result->num_rows > 0 && password_verify($password, $resultRow['pwd'])) {
                $status = 200;
                $message = 'User logged in successfully';
            } else {
                $status = 401;
                $message = 'User not found';
            }
        } catch (Exception $e) {
            $status = 500;
            $message = 'Something went wrong. ' . $e->getMessage();
        } finally {
            return json_encode([
                'status' => $status,
                'message' => $message,
                'result' => $resultRow
            ]);
        }
    }

    public static function changePassword($email, $currentPassword, $newPassword)
    {
        $status = null;
        $message = null;
        try {
            $sql = "SELECT * FROM users WHERE email = '{$email}'";
            $result = self::$conn->query($sql);
            if ($result->num_rows > 0 && password_verify($currentPassword, $result->fetch_assoc()['pwd'])) {
                $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET pwd = '{$newPasswordHashed}' WHERE email = '{$email}'";
                if (self::$conn->query($sql)) {
                    $status = 200;
                    $message = 'Password changed successfully';
                }
            } else {
                $status = 401;
                $message = 'Invalid Password';
            }
        } catch (Exception $e) {
            $status = 500;
            $message = 'Something went wrong. ' . $e->getMessage();
        } finally {
            return json_encode([
                'status' => $status,
                'message' => $message,
                'result' => $result->fetch_assoc()
            ]);
        }
    }

    public static function updateGames($email, $tries, $won, $levelCompleted)
    {
        $status = null;
        $message = null;
        try {
            // Get user id with email
            $sql = "SELECT id FROM users WHERE email = '{$email}'";
            $result = self::$conn->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception('User not found', 1366);
            } else {
                $userId = $result->fetch_assoc()['id'];
            }
            $sql = "INSERT INTO games (user_id, tries, won, levelCompleted ,date) VALUES ('{$userId}', '{$tries}', '{$won}', '{$levelCompleted}', NOW())";
            if (self::$conn->query($sql)) {
                $status = 201;
                $message = 'Game updated successfully';
            }
        } catch (Exception $e) {
            $status = 500;
            if ($e->getCode() == 1366) {
                $message = 'User not found';
            } else {
                $message = $e->getMessage();
            }
        } finally {
            return json_encode([
                'status' => $status,
                'message' => $message
            ]);
        }
    }

    public static function getResults($email)
    {
        $status = null;
        $message = null;
        $userId = null;
        try {
            // Select user id,name and lname with email and join with games table
            $sql = "SELECT users.id, users.name, users.lname, games.tries, games.won, games.levelCompleted, games.date FROM users INNER JOIN games ON users.id = games.user_id WHERE users.email = '{$email}'";
            $result = self::$conn->query($sql);
            if ($result->num_rows == 0) {
                throw new Exception('User not found', 1366);
            }
            $status = 200;
            $message = 'Results fetched successfully';
        } catch (Exception $e) {
            $status = 500;
            $message = 'Something went wrong. ' . $e->getMessage();
        } finally {
            return json_encode([
                'status' => $status,
                'message' => $message,
                'result' => $result->fetch_all(MYSQLI_ASSOC)
            ]);
        }
    }
}

new Database(); // Instantiantion de la classe Database
