<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
if(!isset($_GET["c"])){
    header("location:home.php");
}else{
    $id_community = $_GET["c"];
    $conn = connect();
    $sql = "SELECT * FROM communities WHERE id_community = '$id_community'";
    if($query = mysqli_query($conn, $sql)){
        $data = mysqli_fetch_assoc($query);
        if(isset($data["id_community"])){
            $commnityName = $data["community_name"];
            $communityDesc = $data["community_description"];
            $members = $data["members"];
            $profilePic = $data["profile_pic"];
        }else{
            header("location:home.php");
        }
    }
    mysqli_close($conn);
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

<div class="container-fluid">
<div class="row" style="padding-top:50px;background:rgba(0, 0, 0, 0.8)">
    <div class="col-lg-2" style="">
    <img src="<?php echo $profilePic ?>" class="img-responsive img-thumbnail" id="profilePic" alt="Responsive image">
    </div>
    <div class="col-lg-10 jumbogotron" id="backcontainer">
          <h1><?php echo $commnityName ?></h1>
          <!-- <p> -->
              <?php
            //    echo $communityDesc 
               ?>
            <!-- </p> -->
          <h3>
              <?php
                $conn = connect();
                $id_user = $_SESSION["id_user"];
                $sql = "SELECT * FROM is_part_of WHERE user = '$id_user' AND community = '$id_community'";
                if($query2 = mysqli_query($conn, $sql)){
                  $ispartof = mysqli_fetch_assoc($query2);
                  if(isset($ispartof["user"])){
                    echo '<a class="btn btn-danger btn-lg" href="exit_community.php?c='.$data["id_community"].'" role="button">Sair</a>';
                  }else{
                    echo '<a class="btn btn-success btn-lg" href="join_community.php?c='.$data["id_community"].'" role="button">Entrar</a>';
                  }
                mysqli_close($conn);
                }
              ?>
              <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Sair</a> -->
              <label title='Membros' class='label label-default' style="padding:14px">
              <?php echo $members ?>
              <label class='glyphicon glyphicon-user'></label></label>
          </h3>
    </div>
</div>
</div>

<div class="container" id="main-container">
<div class="row">
</div>
</div>



    <script src="js/pattern.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>