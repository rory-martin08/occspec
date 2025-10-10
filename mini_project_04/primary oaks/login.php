<?php
require_once "assets/dbconn.php";
require_once "assets/common.php";

if (isset($_SESSION['user'])){
    $_SESSION["usermessage"] = "ERROR! You are already logged in.";
    header("Location: index.php");
    exit;
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = dbconnect_insert();
    $usr = login($conn, $_POST);
    if ($usr && password_verify($_POST["password"], $usr["password"])) {
        $_SESSION["user"] = true;
        $_SESSION["userid"] = $usr["user_id"];
        $_SESSION["usermessage"] = "SUCCESS: User logged in successfully";
        auditor($conn, $_SESSION["userid"], "log", "User logged in");
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['usermessage'] = "ERROR: Invalid username or password";
        header("Location: login.php");
        exit;
    }
}

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Login - Primary Oaks Surgery</title>";
echo "<link rel='stylesheet' href='css/styles.css' />";
echo "</head>";
echo "<body>";

// Topbar and Navigation
require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='container'>";
echo "<h2>Login</h2>";
echo "<form method='post' action=''>";
echo "<input type='text' name='username' placeholder='Username' required>";
echo "<input type='password' name='password' placeholder='Password' required>";
echo "<input type='submit' name='submit' value='Login'>";
echo "</form>";

// User messages
echo user_message();

echo "</div>"; // container

// Footer
echo "<footer>© " . date('Y') . " Primary Oaks Surgery. All rights reserved.</footer>";

echo "</body>";
echo "</html>";
?>
