<?php
//this opens the php code section

echo "<!DOCTYPE HTML>";

echo "<html>"; //pushes through the html code to initialise the code
echo "<head>"; //

echo "<link rel='stylesheet' href='css\styles.css'>";
echo "</head>";
echo "<body>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Your name is " . $_POST["name"] . "<br>";
    echo "Your email is " . $_POST["email"] . "<br>";
    echo "Your date of birth is " . $_POST["date"] . "<br>";
    echo "Your gender is " . $_POST["gender"] . "<br>";
    echo "Your password is " . $_POST["password"] . "<br>";
    echo "Confirmed password" . $_POST["password2"] . "<br>";
}



echo "<form method='post' action=''>";

echo "<label for='name'>name</label>";
echo "<input type='text' name='name' id='name' placeholder='name' required>";
echo "<br>";
echo "<input type='password' name='password' placeholder='password' required>";
echo "<br>";
echo "<input type='password' name='password2' placeholder='confirm password' required>";
echo "<br>";
echo "<input type='radio' id='male' name='gender' value='Male'>";
echo "<label for='male'>Male</label>";
echo "<input type='radio' id='female' name='gender' value='Female'>";
echo "<label for='female'>Female</label>";
echo "<input type='radio' id='other' name='gender' value='Other'>";
echo "<label for='other'>Other</label>";
echo "<br>";
echo "<label for='email'>Enter your email</label>";
echo "<input type='email' id='email' name='email'>";
echo "<br>";
echo "<input type='date' name='date of birth' value='2025-09-08' min='1900-01-01' max='2025-09-08'>";
echo "<br>";
echo "<input type='submit' name='submit' value='Login' required>";
echo "</form>";
echo "</body>";
echo "</html>";

?>