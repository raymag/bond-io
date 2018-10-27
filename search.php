<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
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
            <li><a href="#">Ver Comunidades</a></li>
            <li><a href="create_community.php">Nova Comunidade</a></li>
            <li><a href="#">Meu Perfil</a></li>
            <li><a href="#">Seguidores</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Configurações</a></li>
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
          echo "<h4>Nenhuma comunidade foi encontrada..</h4>";
        }else{
          echo "<div class='panel panel-default panel-gray'>
            <div class='panel-body'>";
            echo "<strong>".$data["community_name"]."</strong> - <label title='Membros' class='label label-default'>"
            .$data["members"]
            ." <label class='glyphicon glyphicon-user'></label></label> <br><br> ";
            echo '<a class="btn btn-primary" href="#" role="button">Visitar</a> ';
            echo '<a class="btn btn-success" href="join_community.php?q='.$data["id_community"].'" role="button">Entrar</a>';
            echo "</div></div>";
          while($data = mysqli_fetch_assoc($query)){
            echo "<div class='panel panel-default panel-gray'>
            <div class='panel-body'>";
            echo "<strong>".$data["community_name"]."</strong> - <label title='Membros' class='label label-default'>"
            .$data["members"]
            ." <label class='glyphicon glyphicon-user'></label></label> <br><br> ";
            echo '<a class="btn btn-primary" href="#" role="button">Visitar</a> ';
            echo '<a class="btn btn-success" href="join_community.php?q='.$data["id_community"].'" role="button">Entrar</a>';
            echo "</div></div>";
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
          echo "<div class='panel panel-default panel-gray'>
            <div class='panel-body'>";
            echo "<strong>".$data["first_name"].' '.$data["last_name"]."</strong> - <label title='Seguidores' class='label label-default'>"
            .$data["followers"]
            ." <label class='glyphicon glyphicon-user'></label></label>";
            echo " <label title='Seguindo' class='label label-default'>";
            echo $data["following"]." <label class='glyphicon glyphicon-share'> </label></label>";
            echo " <label title='Stars' class='label label-default'>";
            echo $data["stars"]." <label class='glyphicon glyphicon-star'> </label></label>";
            echo "<br>@".$data["username"]."<br><br> ";
            echo '<a class="btn btn-primary" href="#" role="button">Visitar</a> ';
            echo '<a class="btn btn-success" href="#" role="button">Seguir</a>';
            echo "</div></div>";
          while($data = mysqli_fetch_assoc($query)){
            echo "<div class='panel panel-default panel-gray'>
            <div class='panel-body'>";
            echo "<strong>".$data["first_name"].' '.$data["last_name"]."</strong> - <label title='Seguidores' class='label label-default'>"
            .$data["followers"]
            ." <label class='glyphicon glyphicon-user'></label></label>";
            echo " <label title='Seguindo' class='label label-default'>";
            echo $data["following"]." <label class='glyphicon glyphicon-share'> </label></label>";
            echo " <label title='Stars' class='label label-default'>";
            echo $data["stars"]." <label class='glyphicon glyphicon-star'> </label></label>";
            echo "<br>@".$data["username"]."<br><br> ";
            echo '<a class="btn btn-primary" href="#" role="button">Visitar</a> ';
            echo '<a class="btn btn-success" href="#" role="button">Seguir</a>';
            echo "</div></div>";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>