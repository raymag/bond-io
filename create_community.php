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
    <form class="navbar-form navbar-right" method="post" action="search.php">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Pesquisar">
      </div>
      <button type="submit" class="btn btn-default"><label class="glyphicon glyphicon-search"></label></button>
    </form>
      </li>
        <li><a href="home.php">Início</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
          role="button" aria-haspopup="true" aria-expanded="false">Mais <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Ver Comunidades</a></li>
            <li><a href="#">Nova Comunidade</a></li>
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
    <div class="col-lg-8 col-lg-offset-2" id="create-community-form">
<?php
$conn = connect();
if(isset($_POST["title"])){
  $title = $_POST["title"];
  $desc = $_POST["description"];

  $sql = "INSERT INTO communities (community_name, community_description) VALUES ('$title', '$desc')";
  if(mysqli_query($conn, $sql)){
    echo "<div class='alert alert-success'>
    <strong>Sucesso!</strong> Comunidade criada com êxito.
    </div>";
  }else{
    echo "<div class='alert alert-danger'>
    <strong>Erro!</strong> A comunidade não foi criada.
    </div>";
  }
}
mysqli_close($conn);
?>
    <h3>Criar nova comunidade</h3>
    <form method="post">
      <div class="form-group">
        <label for="inputTitleCommunity">Título</label>
        <input type="text" class="form-control" name="title" id="inputTitleCommunity" placeholder="Ex: Torcedores do Cruzeiro">
      </div>
      <div class="form-group">
        <label for="inputDescCommunity">Descrição</label>
        <input type="text" class="form-control" name="description" id="inputDescCommunity" placeholder="Ex: Comunidade para torcedores do cruzeiro...">
      </div>
      <div class="form-group">
        <label for="inputIconCommunity">Ícone</label>
        <input type="file" id="inputIconCommunity">
        <!-- <p class="help-block"></p> -->
      </div>
      <!-- <div class="checkbox">
        <label>
          <input type="checkbox"> Check me out
        </label>
      </div> -->
      <button type="submit" class="btn btn-default">Criar</button>
</form>

    </div>
  </div>
</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>