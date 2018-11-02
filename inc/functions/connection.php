<?php
function connect(){
    $host = "mysql995.umbler.com";
    $user = "raymag";
    $passwd = "xxxxxxxxxx";
    $db = "magno_bond";
    $conn = mysqli_connect($host, $user, $passwd, $db);
    mysqli_set_charset($conn, "UTF-8");
    return $conn;
}
?>
