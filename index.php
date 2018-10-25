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
    <input type="text" class="form-control" id="inputUsername-l" placeholder="JaneDoe23">
  </div>
  <div class="form-group">
    <label for="inputPasswd-l">Senha: </label>
    <input type="password" class="form-control" id="inputPasswd-l" name="passwd-l" placeholder="*****">
  </div>
  <button type="submit" class="btn btn-default">Entrar</button>
</form></li>
        <li><a href="#">Início</a></li>
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
  Cadastro

  <form method="post">
  <div class="form-group">
    <label for="inputUsername-s">Nome de Usuário</label>
    <input type="text" required class="form-control" id="inputUsername-s" name="username" placeholder="Ex: Bruna620">
  </div>
  <div class="form-group">
    <label for="inputPasswd-s">Senha</label>
    <input type="password" required class="form-control" id="inputPasswd-s" placeholder="******">
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