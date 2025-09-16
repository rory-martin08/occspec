<?php
session_start();

require_once("assets/common.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["msg"] = $_POST["message"];
}
echo "<!DOCTYPE HTML>";

echo "<html>";
echo "<head>";

echo "<link rel='stylesheet' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";
echo "<body>";

echo "<div class='container'>";
require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='content'>";
echo usr_msg();
echo "<form method='post' action=''>";
echo "<input type='Text' name='message' value='Message' />";
echo "<input type='Submit' value='Submit' />";
echo "</div>";
echo "</div>";


// Remove all illegal characters from a url
$url = filter_var($url, FILTER_SANITIZE_URL);

// Validate url
if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
    echo("$url is a valid URL");
} else {
    echo("$url is not a valid URL");
}
?>