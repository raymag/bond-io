<?php
session_start();
if(isset($_SESSION["id_user"])){
    $id_user = $_SESSION["id_user"];
    include "inc/functions/connection.php";
    $conn = connect();
    $sql = "DELETE FROM notifications WHERE user =  $id_user";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("location:notifications.php");
}else{
    header("location:index.php");
}
?>