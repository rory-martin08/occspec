<?php
//this opens the php code section

echo "<!DOCTYPE HTML>";

echo "<html>"; //pushes through the html code to initialise the code
echo "<head>"; //

echo "<link rel='stylesheet' href='css\styles.css'>";
echo "</head>";
echo "<body>";
echo "<table>";
echo "<form method='post' action=''>";

echo "<tr>";
echo "<th>";
echo "<label for='name'>name</label>";
echo "<input type='text' name='name' id='name' placeholder='name' required>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th>";
echo "<input type='password' name='name' placeholder='password' required>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th>";
echo "<input type='radio' id='male' name='Gender' value='Male'>";
echo "<label for='male'>Male</label>";
echo "<input type='radio' id='female' name='Gender' value='Female'>";
echo "<label for='female'>Female</label>";
echo "<input type='radio' id='other' name='Gender' value='Other'>";
echo "<label for='other'>Other</label>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th>";
echo "<input type='date' name='date of birth' value='2025-09-08' min='1900-01-01' max='2025-09-08'>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th>";
echo "<input type='submit' name='submit' value='Login' required>";
echo "</th>";
echo "</tr>";


echo "</form>";
echo "</table>";
echo "</body>";
echo "</html>";

?>