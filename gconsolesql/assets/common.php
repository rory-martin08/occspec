<?php

function new_console($conn, $post){
    try {
        $sql = "INSERT INTO console (Console_name, controller_number, ReleaseDate, bit) VALUES (?,?,?,?) ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $post["console_name"]);
        $stmt->bindParam(2, $post["controller_number"]);
        $stmt->bindParam(3, $post["ReleaseDate"]);
        $stmt->bindParam(4, $post["bit"]);
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

// This block must be OUTSIDE the function

