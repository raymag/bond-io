<?php
if(isset($_POST["c"])){
    include "inc/functions/connection.php";
    session_start();
    $id_contact = $_POST["c"];
    $id_user = $_SESSION["id_user"];
    $conn = connect();
    $sql = "SELECT *, UNIX_TIMESTAMP(r_date) as utimestamp FROM messages 
    WHERE (sender = $id_user AND receiver = $id_contact)
    OR (sender = $id_contact AND receiver = $id_user)
    ORDER BY r_date DESC LIMIT 20";
    if($query = mysqli_query($conn, $sql)){
        $messages = array();
        while($data = mysqli_fetch_assoc($query)){
            $messages[] = $data;
        }
        if(count($messages)>=15){
            $sql = "DELETE FROM `messages`
             WHERE (sender = $id_user AND receiver = $id_contact)
    OR (sender = $id_contact AND receiver = $id_user)
             ORDER BY UNIX_TIMESTAMP(r_date) ASC LIMIT 5";
             mysqli_query($conn, $sql);
        }
        function organizer($a, $b){
            $a = $a["utimestamp"];
            $b = $b["utimestamp"];
            if ($a == $b) return 0;
            return ($a > $b) ? 1 : 0;
        }
        usort($messages, "organizer");
        foreach($messages as $msg){
            if($msg["sender"]==$id_user){
                echo "<div class='row'>";
                echo "<span class='alert alert-success
                col-xs-8 col-xs-offset-4 col-lg-8 col-lg-offset-4'>";
                echo $msg["msg_text"];
                echo "</span>";
                echo "</div>";
            }else{
                echo "<div class='row'>";
                echo "<span class='alert alert-info col-lg-8 col-xs-8'>";
                echo $msg["msg_text"];
                echo "</span>";
                echo "</div>";
            }
            
        }
    }
    mysqli_close($conn);
}
?>