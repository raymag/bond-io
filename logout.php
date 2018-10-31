<?php
session_start();
unset($_SESSION["id_user"]);
unset($_SESSION["username"]);
unset($_SESSION["first_name"]);
unset($_SESSION["gender"]);
header("location:index.php");
?>