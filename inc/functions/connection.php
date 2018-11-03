<?php
function connect(){
    $host = "localhost";
    $user = "xxxxxx";
    $passwd = "xxxxxx";
    $db = "xxxxxx";
    $conn = mysqli_connect($host, $user, $passwd, $db);
    mysqli_set_charset($conn, "UTF-8");
    return $conn;
}
?>
