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
    <div class="col-lg-8 col-lg-offset-2" id="create-community-form">
<?php
$conn = connect();
if(isset($_POST["title"])){
  $title = $_POST["title"];
  $desc = $_POST["description"];
  $sql = "SELECT community_name FROM communities WHERE community_name LIKE '$title'";
  if($query = mysqli_query($conn, $sql)){
    $data = mysqli_fetch_assoc($query);
    if(isset($data["community_name"])){
      echo "<div class='alert alert-warning'>
        <strong>Falha!</strong> Este título já está em uso.
        </div>";
    }else{
      if(isset($_FILES["inputFile"]["name"]) && $_FILES["inputFile"]["error"]==0){
        $file_tmp = $_FILES["inputFile"]["tmp_name"];
        $name = $_FILES["inputFile"]["name"];

        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        if(strstr('.jpg;.jpeg;.gif;.png', $extension)){
          $newName = uniqid(time()).'.'.$extension;
          $destiny = 'assets/upload/img/'.$newName;
          @move_uploaded_file($file_tmp, $destiny);
        }

        $sql = "INSERT INTO communities (community_name, profile_pic, community_description)
         VALUES ('$title', '$destiny', '$desc')";
      }else{
        $sql = "INSERT INTO communities (community_name, community_description) VALUES ('$title', '$desc')";
      }
      if(mysqli_query($conn, $sql)){
        $sql = "SELECT id_community FROM communities WHERE community_name = '$title'";
        if($query = mysqli_query($conn, $sql)){
          $id_community = mysqli_fetch_assoc($query)["id_community"];
          $sql = "INSERT INTO is_part_of (community, user) VALUES ($id_community, $id_user)";
          mysqli_query($conn, $sql);
          $sql = "UPDATE communities SET members = members + 1 WHERE id_community = $id_community";
          mysqli_query($conn, $sql);
          $sql = "INSERT INTO manages (user, community, role) VALUES ($id_user, $id_community, 'owner')";
          mysqli_query($conn, $sql);
        }
        echo "<div class='alert alert-success'>
        <strong>Sucesso!</strong> Comunidade criada com êxito. <a href='see_community.php?c=$id_community'>Ver Comunidade</a>
        </div>";
      }else{
        echo "<div class='alert alert-danger'>
        <strong>Erro!</strong> A comunidade não foi criada.
        </div>";
      }
    }
  }
}
mysqli_close($conn);
?>
    <h3>Criar nova comunidade</h3>
    <form method="post" enctype="multipart/form-data">
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
        <input type="file" id="inputIconCommunity" name="inputFile"> 
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



    <script src="js/pattern.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>