

<?php
// Start of the script
$passwordMessage = "";

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST['password'] ?? '';

    // Password validation pattern:
    // - At least one lowercase letter
    // - At least one uppercase letter
    // - At least one digit
    // - At least one special character
    // - Minimum 8 characters
    $pattern = '/^(?!\d)(?!.*password)(?![\W_])(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])(?!.*[\W_]$).{8,}$/i'; //this is the list of parameters the code must follow



    if (preg_match($pattern, $password)) {
        $passwordMessage = "Valid Password";
    } else {
        $passwordMessage = "Invalid Password. Must be at least 8 characters and include upper/lowercase letters,
         a number,the first character cannot be a special character or a number, the first character cannot be a number, 
        and a special character.";
    }
}

// Start HTML Output
echo "<!DOCTYPE HTML>";
echo "<html>";
echo "<head>";
echo "<link rel='stylesheet' href='css/styles.css' />";
echo "<title>Password Check</title>";
echo "</head>";
echo "<body>";
echo "<h2>Password Check</h2>";

echo "<div class='container'>";
require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='content'>";

echo "<form method='post' action=''>";
echo "<input type='text' name='Name' placeholder='Name' required />";
echo "<input type='password' name='password' placeholder='Password' required />";
echo "<input type='submit' value='Submit' />";
echo "</form>";

// Display result message after submission
if (!empty($passwordMessage)) {
    echo "<p>$passwordMessage</p>";
}

echo "</div>"; // Close .content
echo "</div>"; // Close .container
echo "</body>";
echo "</html>";
?>

