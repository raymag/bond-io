<?php
if(isset($_GET["u"]) && isset($_GET["m"]) && isset($_GET["l"]) ){
    session_start();
    include "inc/functions/connection.php";
    $conn = connect();
    $id_user = $_SESSION["id_user"];
    $u = $_GET["u"];
    $m = $_GET["m"];
    $l = $_GET["l"];
    $sql = "SELECT * FROM users WHERE id_user = $u";
    if($query = mysqli_query($conn, $sql)){
        $data = mysqli_fetch_assoc($query);
        if(isset($data["id_user"])){
            if($m=="unfollow"){
                $sql = "SELECT * FROM follows WHERE follower = $id_user AND following = $u";
                if($query = mysqli_query($conn, $sql)){
                    $data = mysqli_fetch_assoc($query);
                    if(isset($data["follower"])){
                        $sql = "DELETE FROM follows WHERE follower = $id_user AND following = $u";
                        mysqli_query($conn, $sql);
                        $sql = "UPDATE users SET followers = followers - 1 WHERE id_user = $u";
                        mysqli_query($conn, $sql);
                        $sql = "UPDATE users SET following = following - 1 WHERE id_user = $id_user";
                        mysqli_query($conn, $sql);
                    }
                }
            }else{
                $sql = "SELECT * FROM follows WHERE follower = $id_user AND following = $u";
                if($query = mysqli_query($conn, $sql)){
                    $data = mysqli_fetch_assoc($query);
                    if(!isset($data["follower"])){
                        $sql = "INSERT INTO follows (follower, following) VALUES ($id_user, $u)";
                        mysqli_query($conn, $sql);
                        $sql = "UPDATE users SET followers = followers + 1 WHERE id_user = $u";
                        mysqli_query($conn, $sql);
                        echo $sql = "UPDATE users SET following = following + 1 WHERE id_user = $id_user";
                        mysqli_query($conn, $sql);
                    }
                }
            }
        }
    }
    mysqli_close($conn);
    header("location:$l");
}else{
    header("location:home.php");
}
?>