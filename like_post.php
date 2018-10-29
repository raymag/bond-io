<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
$id_user = $_SESSION["id_user"];
if(!isset($_GET["p"]) || !isset($_GET["m"]) || !isset($_GET["l"])){
    header("location:home.php");
}else{
    if(isset($_GET["u"])){
        $id_user = $_GET["u"];
    }
    $conn = connect();
    $id_post = $_GET["p"];
    $mode = $_GET["m"];
    $local = $_GET["l"];
    $sql = "SELECT * FROM posts
    JOIN communities ON community = communities.id_community
    WHERE id_post = $id_post";
    if($query = mysqli_query($conn, $sql)){
        $data = mysqli_fetch_assoc($query);
        if(isset($data["user"])){
            $community = $data["id_community"];
            $id_user2 = $data["user"];
            switch($mode){
                case "like":
                    $sql = "INSERT INTO likes (user, post) VALUES ($id_user, $id_post)";
                    mysqli_query($conn, $sql);
                    $sql = "UPDATE posts SET likes = likes + 1 WHERE id_post = $id_post";
                    mysqli_query($conn, $sql);
                    $sql = "UPDATE users SET stars = stars + 1 WHERE id_user = $id_user2";
                    mysqli_query($conn, $sql);
                    if($id_user!=$id_user2){
                        $sql = "INSERT INTO notifications (user, post, type, acting_user,community)
                                VALUES ($id_user2,$id_post,'like',$id_user,$community)";
                        mysqli_query($conn, $sql);
                    }
                    break;
                default:
                    $sql = "DELETE FROM likes WHERE user = $id_user AND post = $id_post";
                    mysqli_query($conn, $sql);
                    $sql = "UPDATE posts SET likes = likes - 1 WHERE id_post = $id_post";
                    mysqli_query($conn, $sql);
                    $sql = "UPDATE users SET stars = stars - 1 WHERE id_user = $id_user2";
                    mysqli_query($conn, $sql);
                    break;
            }
            header("location:".$local);
        }
    }
    mysqli_close($conn);
}
?>