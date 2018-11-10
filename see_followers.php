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
          echo '<a href="notifications.php" class="btn btn-default notification-btn" id="dark-text-nav" style="margin:auto 5px">
          <span class="glyphicon glyphicon-globe"></span></a>';
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
</nav><!-- Fim do Menu -->



<div class="container" id="main-container">
<div class="row">
  <div class="col-lg-10 col-lg-offset-1 border-div">
    <h4 class="text-center"><strong>Seus Seguidores</strong></h4><hr>
    <?php
      $conn = connect();
      $id_user = $_SESSION["id_user"];

      $sql = "SELECT * FROM follows
       JOIN users ON follower = users.id_user
       WHERE follows.following = '$id_user'
       ORDER BY users.first_name ASC";
      $followers = array();
      if($query = mysqli_query($conn, $sql)){
        while($row = mysqli_fetch_assoc($query)){
          $followers[] = $row;
        }
        foreach($followers as $follower){
            if(!isset($follower["username"])){
                echo "<h4>Nenhum seguidor foi encontrado..</h4>";
              }else{
                $id_user2 = $follower["id_user"];
                  echo "<div class='panel panel-default panel-gray'>
                    <div class='panel-body'>";
                    echo "<strong>".$follower["first_name"].' '.$follower["last_name"]."</strong> - ";
                    echo " <label title='Stars' class='label label-default'>";
                    echo $follower["stars"]." <label class='glyphicon glyphicon-star'> </label></label>";
                    echo " <label title='Seguidores' class='label label-default'>"
                      .$follower["followers"]
                      ." <label class='glyphicon glyphicon-user'></label></label>";
                    echo " <label title='Seguindo' class='label label-default'>";
                    echo $follower["following"]." <label class='glyphicon glyphicon-arrow-right'> </label></label>";
      
                    echo "<br>@".$follower["username"]."<br><br> ";
                    echo '<a class="btn btn-primary" href="see_profile.php?p='.$follower["id_user"].'" role="button">Visitar</a> ';
      
                    $sql = "SELECT * FROM follows WHERE follower = $id_user AND following = $id_user2";
                     if($query2 = mysqli_query($conn, $sql)){
                         $dt = mysqli_fetch_assoc($query2);
                         if(isset($dt["follower"])){
                           echo "<a title='Deixar de seguir' href='follow.php?u=".$id_user2."&m=unfollow&l=see_followers.php' 
                           class='btn btn-warning'>
                             Deixar de Seguir</a>";
                         }else{
                          echo "<a title='Seguir' href='follow.php?u=".$id_user2."&m=follow&l=see_followers.php' 
                          class='btn btn-success'>
                            Seguir</a>";
                         }
                    }          
                    echo "</div></div>";
                  while($data = mysqli_fetch_assoc($query)){
                    $id_user2 = $data["id_user"];
                    if($data["id_user"] != $id_user){
                      echo "<div class='panel panel-default panel-gray'>
                      <div class='panel-body'>";
                      echo "<strong>".$data["first_name"].' '.$data["last_name"]."</strong> - "; 
                      echo " <label title='Stars' class='label label-default'>";
                      echo $data["stars"]." <label class='glyphicon glyphicon-star'> </label></label>";
                      echo " <label title='Seguidores' class='label label-default'>"
                      .$data["followers"]
                      ." <label class='glyphicon glyphicon-user'></label></label>";
                      echo " <label title='Seguindo' class='label label-default'>";
                      echo $data["following"]." <label class='glyphicon glyphicon-arrow-right'> </label></label>";
                      echo "<br>@".$data["username"]."<br><br> ";
                      echo '<a class="btn btn-primary" href="see_profile.php?p='.$data["id_user"].'" role="button">Visitar</a> ';
      
                      $sql = "SELECT * FROM follows WHERE follower = $id_user AND following = $id_user2";
                      if($query2 = mysqli_query($conn, $sql)){
                         $dt = mysqli_fetch_assoc($query2);
                         if(isset($dt["follower"])){
                           echo "<a title='Deixar de seguir' href='follow.php?u=".$id_user2."&m=unfollow&l=see_followers.php' 
                           class='btn btn-warning'>
                             Deixar de Seguir</a>";
                         }else{
                          echo "<a title='Seguir' href='follow.php?u=".$id_user2."&m=follow&l=see_followers.php' 
                          class='btn btn-success'>
                            Seguir</a>";
                         }
                      } 
      
                      echo "</div></div>";
                    }
                  }
              }
        }
        if(count($followers)==0){
          echo "<h4 class='text-center'>Você não possui nenhum seguidor...</h4>";
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