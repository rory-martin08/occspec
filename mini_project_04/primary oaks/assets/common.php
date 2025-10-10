<?php
session_start();

function only_user($conn, $username){
    $sql = "SELECT username FROM users WHERE username = ?";  // table name 'users'
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;
}

function reg_user($conn, $post){
    $sql = "INSERT INTO user (username,email, password, dob) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $hpswd = password_hash($post["password"], PASSWORD_DEFAULT);
    $stmt->bindParam(1, $post["username"]);
    $stmt->bindParam(2, $post["email"]);
    $stmt->bindParam(3, $hpswd);
    $stmt->bindParam(4, $post["dob"]);
    $stmt->execute();
    return true;
}

function login($conn, $post){
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $post["username"]);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: false;
}

function user_message(){
    if(isset($_SESSION['usermessage'])){
        $message = "<p>" . $_SESSION['usermessage'] . "</p>";
        unset($_SESSION['usermessage']);
        return $message;
    }
    return "";
}

function getnewuserid($conn, $username){
    $sql = "SELECT user_id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["user_id"];
}

function auditor($conn, $userid, $code, $long){
    $sql = "INSERT INTO audit (date, user_id, code, longdesc) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $date = date('Y-m-d');
    $stmt->bindParam(1, $date);
    $stmt->bindParam(2, $userid);
    $stmt->bindParam(3, $code);
    $stmt->bindParam(4, $long);
    $stmt->execute();
    return true;
}
?>
