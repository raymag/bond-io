<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
if(!isset($_GET["p"]) || !isset($_GET["l"])){
    header("location:home.php");
}else{
    $conn = connect();
    $id_user = $_SESSION["id_user"];
    $id_post = $_GET["p"];
    $local = $_GET["l"];
    $sql = "SELECT * FROM posts WHERE id_post = $id_post AND user = $id_user";
    if($query = mysqli_query($conn, $sql)){
        $data = mysqli_fetch_assoc($query);
        if(isset($data["user"])){
            $sql = "DELETE FROM likes WHERE post = $id_post";
            mysqli_query($conn, $sql);
            $sql = "DELETE FROM posts WHERE user = $id_user AND id_post = $id_post";
            mysqli_query($conn, $sql);
            $sql = "UPDATE users SET stars = stars - 1 WHERE id_user = $id_user";
            mysqli_query($conn, $sql);
            $sql = "DELETE FROM comments WHERE post = $id_post";
            mysqli_query($conn, $sql);
        }
    }
}
header("location:".$local);
mysqli_close($conn);
?>