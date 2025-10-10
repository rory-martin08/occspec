<?php
session_start();
require_once "assets/dbconn.php";
require_once "assets/common.php";

if (!isset($_SESSION['user'])) {
    $_SESSION["usermessage"] = "ERROR! You need to be logged in.";
    header("Location: index.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $conn = dbconnect_insert();

        // Check for existing appointment at the same date and time
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM appointments WHERE appointment_date = ? AND appointment_time = ?");
        $checkStmt->execute([$_POST['date'], $_POST['time']]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            $message = "❌ Sorry, an appointment already exists for this date and time. Please choose another slot.";
        } else {
            // Insert new appointment
            $stmt = $conn->prepare("INSERT INTO appointments (user_id, email, appointment_date, appointment_time, reason) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['name'],
                $_POST['email'],
                $_POST['date'],
                $_POST['time'],
                $_POST['reason']
            ]);

            $message = "✅ Appointment successfully booked!";
        }

    } catch (PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}

require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Appointment Booking</title>";
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";
echo "</head>";
echo "<body>";
echo "<div class='container'>";

require_once "assets/topbar.php";
require_once "assets/nav.php";

echo "<div class='content'>";
echo "<h1>Book an Appointment</h1>";
echo "<p id='intro'>Please fill out the form below to schedule your appointment.</p>";

// Display confirmation or error message
if (!empty($message)) {
    echo "<div class='message'>$message</div>";
}

echo "<form method='post' action=''>";
echo "<input type='text' name='name' placeholder='Your Full Name' required>";
echo "<input type='email' name='email' placeholder='Your Email' required>";
echo "<input type='date' name='date' required>";
echo "<input type='time' name='time' required>";
echo "<textarea name='reason' placeholder='Reason for Appointment' rows='4' required></textarea>";
echo "<input type='submit' name='submit' value='Book Appointment'>";
echo "</form>";

echo "</div>"; // content
echo "</div>"; // container
echo "</body>";
echo "</html>";
?>
