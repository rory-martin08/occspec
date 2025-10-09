<?php
session_start();

require_once("assets/dbconn.php");
require_once("assets/common.php");
if (isset($_SESSION['user'])){
    $_SESSION["usermessage"] = "ERROR! You are already logged in.";
    header("Location: index.php");
    exit;
}elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usr = login(dbconnect_insert(), $_POST);
    if ($usr && password_verify($_POST["password"], $usr["password"])) {
        $_SESSION["user"] = true;
        $_SESSION["userid"] = $usr["user_id"];
        $_SESSION["username"] = "SUCCESS: User successfully logged in";
        auditor(dbconnect_insert(), $_SESSION["userid"], "log", "User successfully logged in");
        header("location: index.php");
        exit;
    } else {
        $_SESSION['usermessage'] = "ERROR: User login passwords did not match";
        header("location: login.php");
        exit;
    }
}






echo "<link rel='stylesheet' href='css/styles.css' />";

require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<form method='post' action=''>";

echo "<input type='text' name='username' placeholder='Username'>";
echo "<br>";
echo "<input type='password' name='password' placeholder='Password'>";
echo "<br>";
echo "<input type='submit' name='submit' value='Register'>";

echo user_message();