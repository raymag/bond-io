<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
$id_user = $_SESSION["id_user"];
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
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Pesquisar" value="FEED" disabled>
        </div>
      </form>
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

<div class="container" id="main-container">

<div class="row">
<div class="col-xs-12 col-lg-7">
<div class="row panel-gray">
    <div class="col-lg-10 col-lg-offset-1">
        <?php
         $conn = connect();
         $sql = "SELECT * FROM is_part_of WHERE user = $id_user";
         if($query = mysqli_query($conn, $sql)){
           $array = array();
           while($row = mysqli_fetch_assoc($query)){
             $array[] = $row;
            }
          $array2 = array();
          foreach($array as $communities){
            $id_community = $communities["community"];
            $sql = "SELECT *, date_format(posts.r_date, '%d, %b, %Y, %T') as data_f FROM posts 
            JOIN users ON posts.user = users.id_user JOIN communities ON posts.community = communities.id_community
            WHERE community = '$id_community' ORDER BY posts.r_date DESC,  posts.likes DESC";
            if($query2 = mysqli_query($conn, $sql)){
              while($post = mysqli_fetch_assoc($query2)){
                $array2[] = $post;
              }
            }
          }
          function organizer($a, $b){
            $a = $a['data_f'];
            $b = $b['data_f'];

            if ($a == $b) return 0;
            return ($a > $b) ? -1 : 1;
          }
          usort($array2, "organizer");
          foreach($array2 as $post){
            $text = $post["post_text"];
            $likes = $post["likes"];
            $id_post = $post["id_post"];
            $id_community = $post["id_community"];

            $sql = "SELECT count(*) as comments FROM comments WHERE post = $id_post";
            if($q = mysqli_query($conn, $sql)){
                $comments_qnt = mysqli_fetch_assoc($q)["comments"];
            }else{
                $comments_qnt = '';
            }
            if($post["user"] == $id_user){
              $link = "profile.php";
            }else{
              $link = "see_profile.php?p=".$post["user"];
            }
            echo "<div class='panel panel-primary'>
            <div class='panel-heading'><a href='$link' class='gray-text-link'><strong>".$post["first_name"]."</a> | 
            <a href='see_community.php?c=$id_community' class='gray-text-link'>".$post["community_name"]
            ."</a></strong> - <span class='gray-text'>@".$post["username"]." - ";
            echo $post["data_f"]."</span></div>
            <div class='panel-body'>
             $text
            </div>
            <div class='panel-footer'> ";
            $sql = "SELECT * FROM likes WHERE post = $id_post AND user = $id_user";
            if(isset(mysqli_fetch_assoc(mysqli_query($conn, $sql))["post"])){
             echo "<a href='like_post.php?p=$id_post&m=unlike&l=home.php'
             title='Gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star'>
             </span></a>";
            }else{
              echo "<a href='like_post.php?p=$id_post&m=like&l=home.php'
               title='Não gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star-empty'>
               </span></a>";
            }
            echo " <a href='see_post.php?p=$id_post'
             title='Comentar' class='btn btn-default' id='like-btn'>".$comments_qnt." <span class='glyphicon glyphicon-comment'>
             </span></a>";
            if($post["id_user"] == $id_user){
             echo " <a href='del_post.php?p=$id_post&l=home.php'
             title='Apagar' class='btn btn-danger' id='like-btn'><span class='glyphicon glyphicon-trash'>
             </span></a>";
            }
            echo "</div>
          </div>";

          }
          }
          mysqli_close($conn);
        ?>
    </div>
    <!-- <div class="col-lg-3 col-lg-offset-1" style="background:orange"> 
        TRENDING
    </div> -->
</div>
</div>
<div class="col-xs-12 col-lg-4 col-lg-offset-1">
  <div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <strong><a href='profile.php' class='gray-text-link'><?php
      $conn = connect();
      $sql = "SELECT * FROM users WHERE id_user = $id_user";
      if($query = mysqli_query($conn, $sql)){
        $user = mysqli_fetch_assoc($query);
        echo $user["first_name"].' '.$user["last_name"];
      }
      mysqli_close($conn);?>
      </a></strong>
      <?php
      echo ' - <span class="gray-text"> @'.$user["username"].'</span>';
      ?>
    </div>
    <div class="panel-body">
      <center>
        <!-- <label title='Seguidores' class='label label-default' style="padding:14px">
          <?php
          //  echo $user["followers"];
            ?>
        <label class='glyphicon glyphicon-user'></label></label>
        <label title='Seguindo' class='label label-default' style="padding:14px">
          <?php
          //  echo $user["following"];
            ?>
        <label class='glyphicon glyphicon-arrow-down'></label></label> -->
        <label title='Stars' class='label label-default' style="padding:14px">
          <?php echo $user["stars"] ?>
        <label class='glyphicon glyphicon-star'></label></label>
      </center>
    </div>
  </div>
  </div>
  <!-- <div class="row sidenav" style="background:lixghtblue">
  Trending Communities
  </div>
  <div class="row sidenav" style="background:rxed">
  Trending Posts
  </div> -->
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