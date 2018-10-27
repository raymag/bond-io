<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
if(!isset($_GET["c"])){
    header("location:home.php");
}else{
    $id_user = $_SESSION["id_user"];
    $id_community = $_GET["c"];
    $conn = connect();
    $sql = "SELECT * FROM is_part_of WHERE community = '$id_community' AND user = '$id_user'";
    if($query = mysqli_query($conn, $sql)){
        $data = mysqli_fetch_assoc($query);
        if(isset($data["community"])){
            $sql = "DELETE FROM is_part_of WHERE community = '$id_community' AND user='$id_user'";
            if(mysqli_query($conn, $sql)){
                $sql = "UPDATE communities SET members = members - 1 WHERE id_community = '$id_community'";
                mysqli_query($conn, $sql);
            }
            $sql = "SELECT community_name FROM communities WHERE id_community = '$id_community'";
            if($query = mysqli_query($conn, $sql)){
                $data = mysqli_fetch_assoc($query);
                if(isset($data["community_name"])){
                    mysqli_close($conn);
                    header("location:see_community.php?c=".$id_community);
                }else{
                    mysqli_close($conn);
                    header("location:search.php");
                }
            }else{
                mysqli_close($conn);
                header("location:search.php");
            }
        }else{
            mysqli_close($conn);
            header("location:see_community.php?c=".$id_community);
        }
    }else{
        mysqli_close($conn);
        header("location:search.php");
    }
}
?>