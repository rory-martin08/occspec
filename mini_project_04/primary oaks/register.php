<?php
require_once "assets/dbconn.php";
require_once "assets/common.php";

$strength = ""; // Password strength message

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = dbconnect_insert();

    // Check password strength
    if (isset($_POST['password'])) {
        $pwd = $_POST['password'];
        $score = 0;
        if (strlen($pwd) >= 6) $score++;
        if (strlen($pwd) >= 10) $score++;
        if (preg_match('/[A-Z]/', $pwd)) $score++;
        if (preg_match('/[0-9]/', $pwd)) $score++;
        if (preg_match('/[\W]/', $pwd)) $score++; // special characters

        switch($score) {
            case 0:
            case 1: $strength = "Very Weak"; break;
            case 2: $strength = "Weak"; break;
            case 3: $strength = "Good"; break;
            case 4: $strength = "Strong"; break;
            case 5: $strength = "Very Strong"; break;
        }
    }

    // Continue registration process
    if(!only_user($conn, $_POST["username"])){
        if(reg_user($conn,$_POST)) {
            $userid = getnewuserid($conn, $_POST['username']);
            auditor($conn, $userid, "reg", "New user registered");
            $_SESSION["usermessage"] = "USER CREATED SUCCESSFULLY";
            header("Location: login.php");
            exit;
        } else {
            $_SESSION["usermessage"] = "ERROR: USER REGISTRATION FAILED";
        }
    } else {
        $_SESSION["usermessage"] = "ERROR: USERNAME ALREADY EXISTS";
    }
}

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Register - Primary Oaks Surgery</title>";
echo "<link rel='stylesheet' href='css/styles.css' />";
echo "<style>
        .strength { font-weight: bold; padding: 8px; margin-bottom: 10px; border-radius: 5px; color: white; text-align: center; width: 300px; }
        .very-weak { background-color: #ff4d4d; }
        .weak { background-color: #ff944d; }
        .good { background-color: #ffd24d; color: black; }
        .strong { background-color: #9acd32; }
        .very-strong { background-color: #2ecc71; }
        form input { display: block; margin-bottom: 15px; padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ccc; }
        form input[type='submit'] { background-color: #3498db; color: white; font-weight: bold; border: none; cursor: pointer; transition: background 0.3s ease; }
        form input[type='submit']:hover { background-color: #2980b9; }
      </style>";
echo "</head>";
echo "<body>";

require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='container'>";
echo "<h2>Register</h2>";

// Show password strength if password was entered
if(!empty($strength)) {
    echo "<div class='strength " . strtolower(str_replace(' ', '-', $strength)) . "'>$strength</div>";
}

echo "<form method='post' action=''>";
echo "<input type='text' name='username' placeholder='Username' required>";
echo "<input type='password' name='password' placeholder='Password' required>";
echo "<input type='date' name='dob' placeholder='Date of Birth' required>";
echo "<input type='submit' name='submit' value='Register'>";
echo "</form>";

// User messages
echo user_message();

echo "</div>"; // container

echo "<footer>© " . date('Y') . " Primary Oaks Surgery. All rights reserved.</footer>";

echo "</body>";
echo "</html>";
?>
