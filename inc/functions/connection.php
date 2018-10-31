<?php
function connect(){
    $host = "localhost";
    $user = "root";
    $passwd = "root";
    $db = "bond";
    $conn = mysqli_connect($host, $user, $passwd, $db);
    mysqli_set_charset($conn, "UTF-8");
    return $conn;
}
?>