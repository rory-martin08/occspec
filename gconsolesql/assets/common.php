<?php

function new_console($conn, $post){
    try {
        $sql = "INSERT INTO console (Manufacturer_name, Console_name,  controller_number, ReleaseDate, bit) VALUES (?,?,?,?, ?) ";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $post["Manufacturer_name"]);
        $stmt->bindParam(2, $post["Console_name"]);
        $stmt->bindParam(3, $post["controller_number"]);
        $stmt->bindParam(4, $post["ReleaseDate"]);
        $stmt->bindParam(5, $post["bit"]);
        $stmt->execute();
        $conn = null;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        throw new Exception($e);
    } catch (Exception $e){
        error_log($e->getMessage());
        throw new Exception($e);
    }
}

function only_user($conn, $username){
    try{
        $sql = "SELECT username FROM user WHERE username = ?";  //set up the sql statement
        $stmt = $conn->prepare($sql);  //prepares
        $stmt->bindParam(1, $username);
        $stmt->execute();  //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        $conn = null; //cuts of the connection with the database
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    catch (PDOException $e){ //catch error
        // Log the error (crucial)
        error_log("Database error in only_user" . $e->getMessage());
        //throw the exception
        throw $e;
    }
}



function user_message(){
    if(isset($_SESSION['usermessage'])){
        $message = "<p>" . $_SESSION['usermessage'] . "</p>";
        unset($_SESSION['usermessage']);
        return $message;
    }
    else{
        $message = "";
        return $message;
    }
}

function login($conn, $post){
    try{
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $post["username"]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if ($result) {
            return $result;
        } else {
            $_SESSION["ERROR"] = "User not Found";
            header("location: login.php");
            exit;
        }
    } catch (PDOException $e){
        $_SESSION["ERROR"] = "User login : " . $e->getMessage();
        header("location: login.php");
        exit;
    }
}

function getnewuserid($conn, $username){  # upon registering, retrieves the userid from the system to audit.
    $sql = "SELECT user_id FROM user WHERE username = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1, $username);
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    return $result["user_id"];
}

function auditor($conn, $userid, $code, $long){  # on doing any action, auditor is called and the action recorded
    $sql = "INSERT INTO audit (date, user_id, code, longdesc) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql
    $date = date('Y-m-d'); # only variables should be passed, not direct calls to functions
    $stmt->bindParam(1, $date);  //bind parameters for security
    $stmt->bindParam(2, $userid);
    $stmt->bindParam(3, $code);
    $stmt->bindParam(4, $long);

    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}
// This block must be OUTSIDE the function

