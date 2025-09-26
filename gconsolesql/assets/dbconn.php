<?php

function dbconnect_insert(){
    $servername = "localhost";  //these 4 lines should not be stored here because it shows the user information
    $dbusername = "root"; //these could be stored outside of the folder structure of the web server
    $dbpassword = "";
    $dbname = "gconsole";
    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        error_log("Database error in super_checker: ".$e->getMessage());
        throw $e;
    }
}



