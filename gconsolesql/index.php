<?php
session_start();
require_once "assets/dbconn.php";

echo "<!DOCTYPE HTML>";
echo "<html>";
echo "<head>";

echo "<link rel='stylesheet' href='css/styles.css' />";  # links to the external style sheet
echo "</head>";
echo "<body>";

// Topbar comes first
require_once "assets/topbar.php";

// Nav bar comes next
require_once "assets/nav.php";

echo "<br>";

// Heading below the nav
echo "<h2>Gconsole</h2>";

// Main container
echo "<div class='container'>";
require_once "assets/topbar.php";

// Nav bar comes next
require_once "assets/nav.php";
echo "<div class='content'>";

echo user_message();

try {
    $conn = dbconnect_insert();
    echo"success";
} catch (PDOException $e) {
    echo $e->getMessage();
}
echo "</div>";  // close content
echo "</div>";  // close container

echo "</body>";
echo "</html>";
?>
