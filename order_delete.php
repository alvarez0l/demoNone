<?php
if(isset($_POST["id"]))
{
    $conn = new mysqli("MySQL-8.2", "root", "", "printer_tickets");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $userid = $conn->real_escape_string($_POST["id"]);
    $sql = "DELETE FROM orders WHERE id = '$userid'";
    if($conn->query($sql)){
         
        header("Location: orders.php");
    }
    else{
        echo "Ошибка: " . $conn->error;
    }
    echo "Done!";
    $conn->close();  
}