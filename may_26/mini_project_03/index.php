

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

}
echo "<!DOCTYPE HTML>";

echo "<html>";
echo "<head>";

echo "<link rel='stylesheet' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";
echo "<body>";
echo "<h2> password check </h2>";
echo "<div class='container'>";
require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='content'>";

echo "<form method='post' action=''>";
echo "<input type='Text' name='Name' placeholder='Name' />";
echo "<input type='password' name='password' placeholder='password' />";
echo "<input type='Submit' value='Submit' />";
echo "</div>";
echo "</div>";

$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

if (preg_match($pattern, $password)) {
    echo "Valid Password";
} else {
    echo "Invalid Password";
}


echo "</div>";
echo "</div>";


?>
