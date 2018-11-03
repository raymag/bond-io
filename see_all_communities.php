<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
$id_user = $_SESSION["id_user"];
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
  <div class="col-lg-10 col-lg-offset-1 border-div">
    <h4 class="text-center"><strong>Comunidades que você participa</strong></h4><hr>
    <?php
      $conn = connect();
      $id_user = $_SESSION["id_user"];

      $sql = "SELECT * FROM is_part_of WHERE user = '$id_user'";
      $followed_communities = array();
      if($query = mysqli_query($conn, $sql)){
        while($row = mysqli_fetch_assoc($query)){
          $followed_communities[] = $row;
        }
        foreach($followed_communities as $followed_community){
          $sql = "SELECT * FROM communities WHERE id_community = ".$followed_community["community"];
          if($query = mysqli_query($conn, $sql)){
            while($community = mysqli_fetch_assoc($query)){
              echo "<div class='panel panel-default panel-gray'>
                <div class='panel-body'>";
              echo "<strong>".$community["community_name"]."</strong> - <label title='Membros' class='label label-default'>"
                .$community["members"]
                ." <label class='glyphicon glyphicon-user'></label></label> <br><br> ";
              echo '<a class="btn btn-primary" href="see_community.php?c='.$community["id_community"].'" role="button">Visitar</a> ';
              $id_community = $community["id_community"];
              $id_user = $_SESSION["id_user"];
              $sql = "SELECT * FROM is_part_of WHERE user = '$id_user' AND community = '$id_community'";
              if($query2 = mysqli_query($conn, $sql)){
                $ispartof = mysqli_fetch_assoc($query2);
                if(isset($ispartof["user"])){
                  echo '<a class="btn btn-danger" href="exit_community.php?c='.$community["id_community"].'" role="button">Sair</a>';
                  echo "</div></div>";
                }else{
                  echo '<a class="btn btn-success" href="join_community.php?c='.$community["id_community"].'" role="button">Entrar</a>';
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
        }
        if(count($followed_communities)==0){
          echo "<h4 class='text-center'>Você ainda não participa de nenhuma comunidade...</h4>";
        }
        else{
        }
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