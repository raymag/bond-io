<?php
session_start();
if(isset($_SESSION["id_user"]) || isset($_GET["n"])){
    $id_user = $_SESSION["id_user"];
    $notification = $_GET["n"];
    include "inc/functions/connection.php";
    $conn = connect();
    $sql = "DELETE FROM notifications WHERE user =  $id_user AND id_notification = $notification";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("location:notifications.php");
}else{
    header("location:index.php");
}
?>