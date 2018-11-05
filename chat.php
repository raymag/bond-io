<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
$id_user = $_SESSION["id_user"];
$conn = connect();
$sql = "SELECT sender FROM `messages` WHERE receiver = $id_user AND seen = 'n' group by sender";
if($q = mysqli_query($conn, $sql)){
    $messages_qnt = 0;
    while($data = mysqli_fetch_assoc($q)){
        if(isset($data["sender"])){
            $messages_qnt++;
        }
    }
  }else{
    $messages_qnt = 0;
}
mysqli_close($conn);
$conn = connect();
$sql = "SELECT COUNT(*) as qnt FROM notifications WHERE user = $id_user AND seen = 'n'";
if($q = mysqli_query($conn, $sql)){
  $notifications = mysqli_fetch_assoc($q)["qnt"];
}else{
  $notifications = 0;
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Carlos Magno Nascimento">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BOND</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/pattern.css">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  </head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar-menu">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">BOND</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <li>
      <?php
        if($notifications>0){
          echo '<a href="notifications.php" class="btn btn-warning notification-btn" id="dark-text-nav" style="margin:auto 5px">'.$notifications
          .' <span class="glyphicon glyphicon-globe"></span></a>';
        }else{
          echo '<a href="notifications.php" class="btn btn-default notification-btn" id="dark-text-nav"
           style="margin:auto 5px"><span class="glyphicon glyphicon-globe"></span></a>';
        }
        ?></li>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
        function notificate(){
          $.post("notificate.php", {
            
        }, function(notifications){
            link = document.getElementsByClassName("notification-btn")[0];
            if(notifications=="0"){
              link.className = "btn btn-default notification-btn";
              link.innerHTML = "<span class='glyphicon glyphicon-globe'></span>";
            }else{
              link.className = "btn btn-warning notification-btn";
              link.innerHTML = notifications+" <span class='glyphicon glyphicon-globe'></span>";
            }
          });
        }
        setInterval(notificate, 3000);
        </script>
        <li>
        <?php
        if($messages_qnt>0){
          echo '<a href="chat.php" class="btn btn-warning chat-btn" id="dark-text-nav" style="margin:auto 5px">'.$messages_qnt
          .' <span class="glyphicon glyphicon-comment"></span></a>';
        }else{
          echo '<a href="chat.php" class="btn btn-default chat-btn" id="dark-text-nav"
           style="margin:auto 5px"><span class="glyphicon glyphicon-comment"></span></a>';
        }
        ?>
        <script>
        function msgNotificate(){
          $.post("msg_notificate.php", {
            
        }, function(msgs){
            link = document.getElementsByClassName("chat-btn")[0];
            if(msgs=="0"){
              link.className = "btn btn-default chat-btn";
              link.innerHTML = "<span class='glyphicon glyphicon-comment'></span>";
            }else{
              link.className = "btn btn-warning chat-btn";
              link.innerHTML = msgs+" <span class='glyphicon glyphicon-comment'></span>";
            }
          });
        }
        setInterval(msgNotificate, 3000);
        </script>
        </li>
    <li>
    <form class="navbar-form navbar-right" onsubmit="return false">
      <div class="form-group">
        <input type="text" id="nav-search-input" class="form-control" placeholder="Pesquisar" value="<?php if(isset($_GET["q"])){echo $_GET["q"];} ?>">
      </div>
      <a id="nav-search-submit" class="btn btn-default hidden-xs"><label class="glyphicon glyphicon-search"></label></a>
      <a id="nav-search-submit-mobile" class="btn btn-default btn-block visible-xs"><label class="glyphicon glyphicon-search"></label></a>
    </form>
      </li>
        <li><a href="home.php">Início</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
          role="button" aria-haspopup="true" aria-expanded="false">Mais <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="see_all_communities.php"><span class="glyphicon glyphicon-eye-open"></span> Ver Comunidades</a></li>
            <li><a href="create_community.php"><span class="glyphicon glyphicon-link"></span> Nova Comunidade</a></li>
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Meu Perfil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="config.php"><span class="glyphicon glyphicon-cog"></span> Configurações</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Sair</a></li>
          </ul>
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<hr><hr><hr>

<div class="container">
<div class="row">
    <div class="col-lg-4" id="contacts-field">
        <div class="panel panel-primary">
            <div class="panel-heading">
            Últimas Mensagens
            </div>
            <div class="panel-body">
            <?php
            $conn = connect();
            $sql = "SELECT *, UNIX_TIMESTAMP(messages.r_date) as utimestamp FROM `messages` 
            JOIN users ON users.id_user = messages.sender
            WHERE receiver = $id_user
             GROUP BY sender ORDER BY seen ASC, utimestamp DESC";
            if($query = mysqli_query($conn, $sql)){
                while($contact = mysqli_fetch_assoc($query)){
                    echo "<a href='chat.php?c=".$contact["id_user"]."' class='btn btn-success btn-block'>";
                    echo $contact["first_name"]." ".$contact["last_name"];
                    echo " - @".$contact["username"];
                    echo "</a>";
                    // --$messages_qnt;
                    // if($messages_qnt==0){
                    //     echo "<hr>";
                    // }
                }
            }
            mysqli_close($conn);
            ?>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
            Contatos <span class='gray-text'>(Seguindo)</span>
            </div>
            <div class="panel-body">
            <?php
            $conn = connect();
            $sql = "SELECT * FROM follows 
            JOIN users ON users.id_user = follows.following
            WHERE follower = $id_user ORDER BY users.first_name ASC";
            if($query = mysqli_query($conn, $sql)){
                while($contact = mysqli_fetch_assoc($query)){
                    echo "<a href='chat.php?c=".$contact["id_user"]."' class='btn btn-success btn-block'>";
                    echo $contact["first_name"]." ".$contact["last_name"];
                    echo " - @".$contact["username"];
                    echo "</a>";
                }
            }
            mysqli_close($conn);
            ?>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-lg-offset-1" id="messages-field">
    <?php
    $conn = connect();
    if(isset($_GET["c"])){
        $c = $_GET["c"];
        $sql = "SELECT * FROM users WHERE id_user = $c";
        if($query = mysqli_query($conn, $sql)){
            $data = mysqli_fetch_assoc($query);
            if(isset($data["id_user"])){
                $id_contact = $c;
                $contact_fname = $data["first_name"];
                $contact_lname = $data["last_name"];
                $contact_uname = $data["username"];

                $sql = "UPDATE messages SET seen = 'y' WHERE 
                sender = $id_contact AND receiver = $id_user";
                mysqli_query($conn, $sql);
            }
        }
    }
    mysqli_close($conn);
    ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
            <div class="row">
                <div class="col-xs-10 col-lg-11">
            <?php
            if(isset($id_contact)){
                echo "<a href='see_profile.php?p=$id_contact' class='gray-text-link'>
                <strong>$contact_fname $contact_lname</strong> - @$contact_uname</a>";
            }else{
                echo "Você ainda não selecionou nenhum de seus contatos..";
            }
            
            ?>
                </div>
                <div class="col-xs-2 col-lg-1">
                <?php
            if(isset($id_contact)){
                echo '<a title="Apagar Mensagens" href="del_msg.php?c='.$id_contact.'"
                 style="color:red"><span class="glyphicon glyphicon-remove"></span></a>';
            }            
            ?>
                </div>
            </div>
            </div>
            <div class="panel-body" style="max-height:350px;overflow-y:scroll">
            <?php
                if(isset($id_contact) && isset($_POST["msg_text"][0])){
                    $txt = $_POST["msg_text"];
                    $conn = connect();
                    $sql = "INSERT INTO messages (msg_text, sender, receiver) 
                    VALUES ('$txt', $id_user, $id_contact)";
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);
                }
            ?>
            <?php
            if(isset($id_contact)){
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
                echo "<script>";
                echo "function updateMsgs(){";
                echo "$.post('messages.php', {c:$id_contact}, function(msgs){
                    msgsField = document.getElementById('messages-field');
                    msgsField.children[0].children[1].innerHTML = msgs;
                    //msgsField.children[0].children[1].scrollTop = msgsField.children[0].children[1].scrollHeight;
                });";
                echo "}";
                echo "setInterval(updateMsgs, 3000);";
                echo "</script>";
            }
            ?>
            </div>
            <script>
            msgsField = document.getElementById("messages-field");
            msgsField.children[0].children[1].scrollTop = msgsField.children[0].children[1].scrollHeight;
            </script>
            <div class="panel-footer">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                    <div class="col-xs-9 col-lg-10">
                        <input type="text" autofocus autocomplete="off" class="form-control" name="msg_text" id="msg_text" placeholder="O que você quer dizer?">
                    </div>
                        <div class="col-xs-3 col-lg-2">
                        <button type="submit" title="Enviar Mensagem" class="btn btn-primary">
                            <span class="glyphicon glyphicon-send"></span>
                        </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


</div>
</div>
    <script src="js/pattern.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>