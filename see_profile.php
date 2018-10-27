<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"]) || !isset($_GET["p"])){
  header("location:index.php");
}
$id_user = $_GET["p"];
$id_user2 = $_SESSION["id_user"];
$conn = connect();
$sql = "SELECT * FROM users WHERE id_user = $id_user";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($query);
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
            <li><a href="see_all_communities.php">Ver Comunidades</a></li>
            <li><a href="create_community.php">Nova Comunidade</a></li>
            <li><a href="profile.php">Meu Perfil</a></li>
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
    <img src="<?php echo $user["profile_pic"] ?>" class="img-responsive img-thumbnail" id="profilePic" alt="Responsive image">
    </div>
    <div class="col-lg-10 jumbogotron" id="backcontainer">
          <h1><?php echo $user["first_name"].' '.$user["last_name"].' - @'.$user["username"]?></h1>
          <h3>
              <label title='Seguidores' class='label label-default' style="padding:14px">
              <?php echo $user["followers"] ?>
              <label class='glyphicon glyphicon-user'></label></label> 
              <label title='Seguindo' class='label label-default' style="padding:14px">
              <?php echo $user["following"] ?>
              <label class='glyphicon glyphicon-arrow-down'></label></label>
              <label title='Stars' class='label label-default' style="padding:14px">
              <?php echo $user["stars"] ?>
              <label class='glyphicon glyphicon-star'></label></label>
              <a title='Stars' class='label label-success' style="padding:14px">
                Seguir</a>
              
          </h3>
    </div>
</div>
</div>
<div class="container">
<div class="row panel-gray">
    <div class="col-lg-10 col-lg-offset-1">
        <?php
        $conn = connect();
        $sql = "SELECT *, date_format(posts.r_date, '%d, %b, %Y, %T') as data_f FROM posts
        JOIN communities ON posts.community = communities.id_community WHERE user = '$id_user'";
        if($query = mysqli_query($conn, $sql)){
            $posts = array();
            while($row = mysqli_fetch_assoc($query)){
                $posts[] = $row;
            }
            function organizer($a, $b){
                $a = $a['data_f'];
                $b = $b['data_f'];

                if ($a == $b) return 0;
                return ($a > $b) ? -1 : 1;
            }
            usort($posts, "organizer");
            foreach($posts as $post){
                $text = $post["post_text"];
                $likes = $post["likes"];
                $id_post = $post["id_post"];
                $id_community = $post["community"];
                echo "<div class='panel panel-primary'>
                <div class='panel-heading'><strong>".$user["first_name"]." | 
                <a href='see_community.php?c=$id_community' class='gray-text-link'>".$post["community_name"]
                ."</a></strong> - <span class='gray-text'>@".$user["username"]." - ";
                echo $post["data_f"]."</span></div>
                <div class='panel-body'>
                 $text
                </div>
                <div class='panel-footer'> ";
                $sql = "SELECT * FROM likes WHERE post = $id_post AND user = $id_user2";
                if(isset(mysqli_fetch_assoc(mysqli_query($conn, $sql))["post"])){
                 echo "<a href='like_post.php?p=$id_post&m=unlike&u=$id_user2&l=see_profile.php?p=$id_user'
                 title='Gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star'>
                 </span></a>";
                }else{
                  echo "<a href='like_post.php?p=$id_post&m=like&u=$id_user2&l=see_profile.php?p=$id_user'
                   title='Não gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star-empty'>
                   </span></a>";
                }
                echo " <a href='del_post.php?p=$id_post&u=$id_user&l=see_profile.php?p=$id_user'
                title='Apagar' class='btn btn-danger' id='like-btn'><span class='glyphicon glyphicon-trash'>
                </span></a>";
                echo "</div>
              </div>";
            }
            if(count($posts)==0){
                echo "<h4 class='text-center'>Você ainda não participa de nenhuma comunidade...</h4>";
            }
        }
        mysqli_close($conn);
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