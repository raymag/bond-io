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
          echo '<a href="notifications.php" class="btn btn-warning notification-btn" id="dark-text-nav">'.$notifications
          .' <span class="glyphicon glyphicon-globe"></span></a>';
        }else{
          echo '<a href="notifications.php" class="btn btn-default notification-btn"><span class="glyphicon glyphicon-globe"></span></a>';
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
      <a id="nav-search-submit" class="btn btn-default"><label class="glyphicon glyphicon-search"></label></a>
    </form>
      </li>
        <li><a href="home.php">Início</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
          role="button" aria-haspopup="true" aria-expanded="false">Mais <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="see_all_communities.php">Ver Comunidades</a></li>
            <li><a href="create_community.php">Nova Comunidade</a></li>
            <li><a href="profile.php">Meu Perfil</a></li>
            <!-- <li><a href="#">Seguidores</a></li> -->
            <li role="separator" class="divider"></li>
            <!-- <li><a href="#">Configurações</a></li> -->
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container" id="main-container">
<div class="row">
  <div class="col-lg-5 col-lg-offset-1 border-div">
    <h4 class="text-center"><strong>Comunidades</strong></h4><hr>
    <?php
    if(isset($_GET["q"][0])){
      $q = $_GET["q"];
      $q = str_replace("'", '\'', $q);
      $q = str_replace('"', '"', $q);

      $conn = connect();
      $sql = "SELECT * FROM communities WHERE community_name LIKE '%$q%' ORDER BY community_name";
      if($query = mysqli_query($conn, $sql)){
        $data = mysqli_fetch_assoc($query);
        if(!isset($data["community_name"])){
          echo "<h4>Nenhuma comunidade foi encontrada... <br>
           <a href='create_community.php'>Deseja criar uma nova?</a></h4>";
        }else{
          echo "<div class='panel panel-default panel-gray'>
            <div class='panel-body'>";
          echo "<strong>".$data["community_name"]."</strong> - <label title='Membros' class='label label-default'>"
            .$data["members"]
            ." <label class='glyphicon glyphicon-user'></label></label> <br><br> ";
          echo '<a class="btn btn-primary" href="see_community.php?c='.$data["id_community"].'" role="button">Visitar</a> ';
          $id_community = $data["id_community"];
          $id_user = $_SESSION["id_user"];
          $sql = "SELECT * FROM is_part_of WHERE user = '$id_user' AND community = '$id_community'";
          if($query2 = mysqli_query($conn, $sql)){
            $ispartof = mysqli_fetch_assoc($query2);
            if(isset($ispartof["user"])){
              echo '<a class="btn btn-danger" href="exit_community.php?c='.$data["id_community"].'" role="button">Sair</a>';
              echo "</div></div>";
            }else{
              echo '<a class="btn btn-success" href="join_community.php?c='.$data["id_community"].'" role="button">Entrar</a>';
              echo "</div></div>";
            }
          }
          while($data = mysqli_fetch_assoc($query)){
            echo "<div class='panel panel-default panel-gray'>
            <div class='panel-body'>";
            echo "<strong>".$data["community_name"]."</strong> - <label title='Membros' class='label label-default'>"
            .$data["members"]
            ." <label class='glyphicon glyphicon-user'></label></label> <br><br> ";
            echo '<a class="btn btn-primary" href="see_community.php?c='.$data["id_community"].'" role="button">Visitar</a> ';
            $id_community = $data["id_community"];
            $id_user = $_SESSION["id_user"];
            $sql = "SELECT * FROM is_part_of WHERE user = '$id_user' AND community = '$id_community'";
            if($query2 = mysqli_query($conn, $sql)){
              $ispartof = mysqli_fetch_assoc($query2);
              if(isset($ispartof["user"])){
                echo '<a class="btn btn-danger" href="exit_community.php?c='.$data["id_community"].'" role="button">Sair</a>';
                echo "</div></div>";
              }else{
                echo '<a class="btn btn-success" href="join_community.php?c='.$data["id_community"].'" role="button">Entrar</a>';
                echo "</div></div>";
              }
            }
          }
        }
      }
    }else{
      echo "<h4>Você ainda não pesquisou nada...</h4>";
    }
    ?>
  </div>
  <div class="col-lg-5 col-lg-offset-1 border-div">
  <h4 class="text-center"><strong>Usuários</strong></h4><hr>
    <?php
    if(isset($_GET["q"][0])){
      $q = $_GET["q"];
      $q = str_replace("'", '\'', $q);
      $q = str_replace('"', '"', $q);

      $conn = connect();
      $sql = "SELECT * FROM users WHERE first_name LIKE '%$q%' OR last_name LIKE '%$q%' OR username LIKE '%$q%' ORDER BY username, first_name, last_name";
      if($query = mysqli_query($conn, $sql)){
        $data = mysqli_fetch_assoc($query);
        if(!isset($data["username"])){
          echo "<h4>Nenhum usuário foi encontrado..</h4>";
        }else{
          if($data["id_user"] != $id_user){
            echo "<div class='panel panel-default panel-gray'>
              <div class='panel-body'>";
              // <label title='Seguidores' class='label label-default'>"
              // .$data["followers"]
              // ." <label class='glyphicon glyphicon-user'></label></label>";
              // echo " <label title='Seguindo' class='label label-default'>";
              // echo $data["following"]." <label class='glyphicon glyphicon-share'> </label></label>";
              echo "<strong>".$data["first_name"].' '.$data["last_name"]."</strong> - ";
              echo " <label title='Stars' class='label label-default'>";
              echo $data["stars"]." <label class='glyphicon glyphicon-star'> </label></label>";
              echo "<br>@".$data["username"]."<br><br> ";
              echo '<a class="btn btn-primary" href="see_profile.php?p='.$data["id_user"].'" role="button">Visitar</a> ';
              // echo '<a class="btn btn-success" href="#" role="button">Seguir</a>';
              echo "</div></div>";
            }
            while($data = mysqli_fetch_assoc($query)){
              if($data["id_user"] != $id_user){
                echo "<div class='panel panel-default panel-gray'>
                <div class='panel-body'>";
                // <label title='Seguidores' class='label label-default'>"
                // .$data["followers"]
                // ." <label class='glyphicon glyphicon-user'></label></label>";s
                // echo " <label title='Seguindo' class='label label-default'>";
                // echo $data["following"]." <label class='glyphicon glyphicon-share'> </label></label>";
                echo "<strong>".$data["first_name"].' '.$data["last_name"]."</strong> - "; 
                echo " <label title='Stars' class='label label-default'>";
                echo $data["stars"]." <label class='glyphicon glyphicon-star'> </label></label>";
                echo "<br>@".$data["username"]."<br><br> ";
                echo '<a class="btn btn-primary" href="see_profile.php?p='.$data["id_user"].'" role="button">Visitar</a> ';
                // echo '<a class="btn btn-success" href="#" role="button">Seguir</a>';
                echo "</div></div>";
              }
            }
        }
      }
    }else{
      echo "<h4>Você ainda não pesquisou nada...</h4>";
    }
    ?>
  </div>
</div>
</div>



    <script src="js/pattern.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>