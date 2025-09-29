<?php
session_start();
require_once "assets/common.php";
require_once "assets/dbconn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!only_user(dbconnect_insert(), $_POST["username"])){
        $_SESSION["usermessage"] = "USER CREATED SUCCESSFULLY";
    } else {
        $_SESSION["usermessage"] = "USER REGISTRATION FAILED";
    }
}
require_once "assets/topbar.php";
require_once "assets/nav.php";

function reg_user($conn, $post){
    try {
        $sql = "INSERT INTO user (username, password, signupdate, dob) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $post["username"]);
        $hpswd = password_hash($post["password"], PASSWORD_DEFAULT);
        $stmt->bindParam(2, $hpswd);
        $stmt->bindParam(3, $post["signupdate"]);
        $stmt->bindParam(4, $post["dob"]);
        $stmt->execute();
        $conn = null;
        return true;

    } catch (PDOException $e){
        error_log("User reg Database error: " . $e->getMessage());
        throw new Exception("User reg Database error: " . $e);
    } catch (Exception $e){
        error_log("User Registration error: " . $e->getMessage());
        throw new Exception("User Registration error: " . $e);
    }
}
echo "<!DOCTYPE HTML>";
echo"<html>";
echo"<head>";
echo"<title>Register</title>";
echo"</head>";
echo"<body>";

 echo "<form method='post' action=''>";

echo "<input type='text' name='username' placeholder='Username'>";
echo "<br>";
echo "<input type='password' name='password' placeholder='Password'>";
echo "<br>";
echo "<input type='text' name='signupdate' placeholder='Sign up date'>";
echo "<br>";
echo "<input type='text' name='dob' placeholder='Date of Birth'>";
echo "<br>";
echo "<input type='submit' name='submit' value='Register'>";
    
echo user_message();

echo "</body>";
echo"</html>";


