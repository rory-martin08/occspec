<?php
function dbconnect_insert(){
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "primary_oaks";  // changed to Primary Oaks Surgery database

    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        error_log("Database error: ".$e->getMessage());
        throw $e;
    }
}
?>
