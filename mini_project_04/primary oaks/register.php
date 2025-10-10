<?php
require_once "assets/dbconn.php";
require_once "assets/common.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = dbconnect_insert();
    if(!only_user($conn, $_POST["username"])){
        if(reg_user($conn,$_POST)) {
            $userid = getnewuserid($conn, $_POST['username']);
            auditor($conn, $userid, "reg", "New user registered");
            $_SESSION["usermessage"] = "USER CREATED SUCCESSFULLY";
            header("Location: login.php");
            exit;
        } else {
            $_SESSION["usermessage"] = "ERROR: USER REGISTRATION FAILED";
        }
    } else {
        $_SESSION["usermessage"] = "ERROR: USERNAME ALREADY EXISTS";
    }
}

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Register - Primary Oaks Surgery</title>";
echo "<link rel='stylesheet' href='css/styles.css' />";
echo "</head>";
echo "<body>";

// Topbar and Navigation
require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='container'>";
echo "<h2>Register</h2>";
echo "<form method='post' action=''>";
echo "<input type='text' name='username' placeholder='Username' required>";
echo "<input type='password' name='password' placeholder='Password' required>";

echo "<input type='date' name='dob' placeholder='Date of Birth' required>";
echo "<input type='submit' name='submit' value='Register'>";
echo "</form>";

// User messages
echo user_message();

echo "</div>"; // container

// Footer
echo "<footer>© " . date('Y') . " Primary Oaks Surgery. All rights reserved.</footer>";

echo "</body>";
echo "</html>";
?>
