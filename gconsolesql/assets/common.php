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