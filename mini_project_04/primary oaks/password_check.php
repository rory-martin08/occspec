<?php
$strength = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['password'])) {
    $pwd = $_POST['password'];
    $score = 0;

    // Scoring criteria
    if (strlen($pwd) >= 6) $score++;
    if (strlen($pwd) >= 10) $score++;
    if (preg_match('/[A-Z]/', $pwd)) $score++;
    if (preg_match('/[0-9]/', $pwd)) $score++;
    if (preg_match('/[\W]/', $pwd)) $score++; // special characters

    // Determine strength
    switch($score) {
        case 0:
        case 1:
            $strength = "Very Weak";
            break;
        case 2:
            $strength = "Weak";
            break;
        case 3:
            $strength = "Good";
            break;
        case 4:
            $strength = "Strong";
            break;
        case 5:
            $strength = "Very Strong";
            break;
    }
}

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Password Strength Checker</title>";
echo "<style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        input[type='password'], input[type='submit'] { padding: 10px; font-size: 1rem; margin: 10px 0; width: 300px; }
        .strength { font-weight: bold; padding: 10px; width: 300px; border-radius: 5px; color: white; }
        .very-weak { background-color: #ff4d4d; }
        .weak { background-color: #ff944d; }
        .good { background-color: #ffd24d; color: black; }
        .strong { background-color: #9acd32; }
        .very-strong { background-color: #2ecc71; }
      </style>";
echo "</head>";
echo "<body>";

echo "<h2>Password Strength Checker</h2>";

echo "<form method='post' action=''>";
echo "<input type='password' name='password' placeholder='Enter password' required>";
echo "<br>";
echo "<input type='submit' value='Check Strength'>";
echo "</form>";

if (!empty($strength)) {
    echo "<div class='strength " . strtolower(str_replace(' ', '-', $strength)) . "'>$strength</div>";
}

echo "</body>";
echo "</html>";
?>
