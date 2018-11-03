<?php
session_start();
if(isset($_SESSION["id_user"])){
    include "inc/functions/connection.php";
    $id_user = $_SESSION["id_user"];
    $conn = connect();
    $sql = "SELECT COUNT(*) as qnt FROM notifications WHERE user = $id_user AND seen = 'n'";
    if($q = mysqli_query($conn, $sql)){
      $notifications = mysqli_fetch_assoc($q)["qnt"];
    }else{
      $notifications = 0;
    }
    mysqli_close($conn);
    echo $notifications;
}
?>