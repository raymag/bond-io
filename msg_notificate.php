<?php
session_start();
if(isset($_SESSION["id_user"])){
    include "inc/functions/connection.php";
    $id_user = $_SESSION["id_user"];
    $conn = connect();
    $sql = "SELECT sender FROM `messages` WHERE receiver = $id_user AND seen = 'n' group by sender";
    if($q = mysqli_query($conn, $sql)){
        $msgs = 0;
        while($data = mysqli_fetch_assoc($q)){
            if(isset($data["sender"])){
                $msgs++;
            }
        }
    }else{
      $msgs = 0;
    }
    mysqli_close($conn);
    echo $msgs;
}
?>