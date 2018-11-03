<?php
if(isset($_GET["c"])){
    session_start();
    $c = $_GET["c"];
    $id_user = $_SESSION["id_user"];
    include "inc/functions/connection.php";
    $conn = connect();
    $sql = "DELETE FROM messages
     WHERE (sender = $c AND receiver = $id_user)
     OR (sender = $id_user AND receiver = $c)";
     mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("location:chat.php?c=$c");
}

?>