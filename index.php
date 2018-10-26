<?php
session_start();
include "inc/functions/connection.php";
if(isset($_POST["id_user"])){
  header("location:home.php");
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

      <!-- <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form> -->
      <li><form class="navbar-form" id="navbar-menu" method="post">
  <div class="form-group">
    <label for="inputUsername-l">Usuário: </label>
    <input type="text" class="form-control" id="inputUsername-l" name="username-l" placeholder="JaneDoe23">
  </div>
  <div class="form-group">
    <label for="inputPasswd-l">Senha: </label>
    <input type="password" class="form-control" id="inputPasswd-l" name="passwd-l" placeholder="*****">
  </div>
  <button type="submit" class="btn btn-default">Entrar</button>
</form></li>
        <!-- <li><a href="#">Início</a></li> -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid" id="main-container">
<!-- <div class="row" style="background-image:url('assets/img/mountain.jpg');background-size:cover;background-position:bottom;background-attachment:scroll;height:250px">
<div class="col-lg-12"> 
</div>
</div> -->
<div class="row">
  <div class="col-lg-4 col-lg-offset-1">
  <div class="row" style="">
  IMAGEM
  <img src="assets/img/mountain.jpg" class="img-responsive" alt="Responsive image">
  </div>
  <hr>
  <div class="row">
  INFO
  </div>
</div>

  <div class="col-lg-5 col-lg-offset-1" style="border-left:#ccc solid 2px;padding-left:40px">
  <div class="row">

<?php
$conn = connect();
if(isset($_POST["username-l"][0])){
  $username = $_POST["username-l"];
  $passwd = md5($_POST["passwd-l"]);
  if(strstr($username, "'") || strstr($username, '"')){
    echo "<div class='alert alert-danger'>
    <strong>Atenção!</strong> O uso de aspas simples ou duplas não é permitido.
    </div>";
  }
  else{
    $sql = "SELECT id_user, username, first_name, gender FROM users 
    WHERE username = '$username' AND passwd = '$passwd'";
    if($query = mysqli_query($conn,$sql)){
      $data = mysqli_fetch_assoc($query);
      if(isset($data["id_user"])){
        $_SESSION["id_user"] = $data["id_user"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["first_name"] = $data["first_name"];
        $_SESSION["gender"] = $data["gender"];
        header("Location:home.php");
      }else{
        echo "<div class='alert alert-danger'>
    <strong>Erro!</strong> Dados incorretos.
    </div>";
      }
    }
  }
}

if(isset($_POST["username-s"][0])){
  $username = $_POST["username-s"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $birthday = $_POST["birthday"];
  $passwd = $_POST["passwd-s"];
  $passwd2 = $_POST["passwd-s2"];
  $gender = $_POST["gender"];
  if(strstr($username, "'") || strstr($username, '"')){
    echo "<div class='alert alert-danger'>
    <strong>Atenção!</strong> O uso de aspas simples ou duplas não é permitido.
    </div>";
  }
  elseif ($passwd!=$passwd2){
    echo "<div class='alert alert-danger'>
    <strong>Atenção!</strong> As senhas devem ser indênticas.
    </div>";
  }
  else{
    $passwd = md5($passwd);
    $sql = "SELECT * FROM users WHERE username = '$username'";
    if($query = mysqli_query($conn, $sql)){
      $data = mysqli_fetch_assoc($query);
      if(isset($data["username"])){
        echo "<div class='alert alert-danger'>
    <strong>Atenção!</strong> Este nome de usuário já está em uso.
    </div>";
      }else{
        $sql = "INSERT INTO users (username, first_name, last_name, birthday, passwd, gender) 
        VALUES ('$username','$first_name','$last_name','$birthday','$passwd', '$gender')";
        if(mysqli_query($conn, $sql)){
          echo "<div class='alert alert-success'>
    <strong>Sucesso!</strong> Usuário cadastrado com êxito.
    </div>";
        }
      }
    }
  }
}
mysqli_close($conn);
?>

    <h3>
    Cadastro
    </h3>

  <form method="post">
  <div class="form-group">
    <label for="inputUsername-s">Nome de Usuário</label>
    <input type="text" required class="form-control" id="inputUsername-s" name="username-s" placeholder="Ex: Bruna620">
  </div>
  <div class="form-group">
    <label for="inputPasswd-s">Senha</label>
    <input type="password" required class="form-control" id="inputPasswd-s" name="passwd-s" placeholder="******">
  </div>
  <div class="form-group">
    <label for="inputPasswd-s2">Confirmar Senha</label>
    <input type="password" required class="form-control" id="inputPasswd-s2" name="passwd-s2" placeholder="******">
  </div>
  <div class="form-group">
    <label for="inputFirstName">Primeiro Nome</label>
    <input type="text" required class="form-control" id="inputFirstName" name="first_name" placeholder="Ex: Felipe">
  </div>
  <div class="form-group">
    <label for="inputLastName">Sobrenome</label>
    <input type="text" required class="form-control" id="inputLastName" name="last_name" placeholder="Ex: Silva">
  </div>
  <div class="form-group">
    <label for="inputBirthday">Data de Nascimento</label>
    <input type="date" required class="form-control" id="inputBirthday" name="birthday">
  </div>
  <!-- <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div> -->
  <label>Gênero:</label>
  <div class="radio">
    <label>
      <input type="radio" name="gender" required value="M"> Masculino
    </label>
    <label>
      <input type="radio" name="gender" required value="F"> Feminino
    </label>
    <label>
      <input type="radio" name="gender" checked  required value="O"> Outro
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
  </div> 
</div>
</div>

</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>