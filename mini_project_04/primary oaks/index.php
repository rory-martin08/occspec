<?php
require_once "assets/common.php";

$message = isset($_GET['message']) ? htmlspecialchars(urldecode($_GET['message'])) : "";

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Primary Oaks Surgery</title>";
echo "<link rel='stylesheet' href='css/styles.css' />";
echo "</head>";
echo "<body>";

// Topbar and Navigation
require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='container'>";
echo "<h2>Welcome to Primary Oaks Surgery</h2>";


echo user_message();
if($message) {
    echo "<p>$message</p>";
}


if(isset($_SESSION['user']) && $_SESSION['user'] === true){
    echo "<p>Hello, user #" . $_SESSION['userid'] . "! You are logged in.</p>";
    echo "<p>Use the navigation above to log out or access your account.</p>";
} else {
    echo "<p>Please use the navigation above to register or login.</p>";
}

echo "</div>"; // container

// Footer
echo "<footer>© " . date('Y') . " Primary Oaks Surgery. All rights reserved.</footer>";

echo "</body>";
echo "</html>";
?>
