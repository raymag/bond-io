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
          echo '<a href="notifications.php" class="btn btn-warning" id="dark-text-nav">'.$notifications
          .' <span class="glyphicon glyphicon-globe"></span></a>';
        }else{
          echo '<a href="notifications.php" class="btn btn-default"><span class="glyphicon glyphicon-globe"></span></a>';
        }
        ?></li><li>
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
<div class="container">
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <?php
    if(isset($ispartof["user"])){
      echo '
      <br>
          <form method="post" class="border-bottom">
            <div class="form-group">
              <textarea class="form-control" id="no-resizable-textarea" maxLength="1200" name="post_text" rows="3" placeholder="No que está pensando?"></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">Postar</button>
          </form>
          <br>
          ';
        }?>
    <?php
        if(isset($_POST["post_text"][0])){
          $text= $_POST["post_text"];
          $text = str_replace('"', '\"', $text);
          $text = str_replace("'", "\'", $text);
          $text = strip_tags($text);
          
          $conn = connect();
          $sql = "INSERT INTO posts (post_text, user, community) VALUES ('$text', '$id_user', '$id_community')";
          if(mysqli_query($conn, $sql)){
            echo "<div class='alert alert-success'>
            <strong>Sucesso!</strong> A postagem foi realizada com sucesso.
            </div>";
          }
          mysqli_close($conn);
        }
        ?>
</div>
</div>
<hr>
<div class="row panel-gray">
    <div class="col-lg-10 col-lg-offset-1">
        <?php
         $conn = connect();
         $sql = "SELECT *, date_format(posts.r_date, '%d, %b, %Y, %T') as data_f FROM posts JOIN users ON posts.user = users.id_user  WHERE community = '$id_community' ORDER BY posts.r_date DESC,  posts.likes DESC";
         if($query = mysqli_query($conn, $sql)){
           while($post = mysqli_fetch_assoc($query)){
             $text = $post["post_text"];
             $likes = $post["likes"];
             $id_post = $post["id_post"];

             $sql = "SELECT count(*) as comments FROM comments WHERE post = $id_post";
             if($q = mysqli_query($conn, $sql)){
               $comments_qnt = mysqli_fetch_assoc($q)["comments"];
             }else{
               $comments_qnt = '';
             }

             echo "<div class='panel panel-primary'>";
             if($post["user"]==$id_user){
               $link = "profile.php";
             }else{
               $link = "see_profile.php?p=".$post["user"];
             }
             echo "
             <div class='panel-heading'><a href='$link' class='gray-text-link'><strong>".$post["first_name"]."</strong> - <span class='gray-text'>@".$post["username"]."</a> - ";
             echo $post["data_f"]."</span></div>
             <div class='panel-body'>
              $text
             </div>
             <div class='panel-footer'> ";
             $sql = "SELECT * FROM likes WHERE post = $id_post AND user = $id_user";
             if(isset(mysqli_fetch_assoc(mysqli_query($conn, $sql))["post"])){
              echo "<a href='like_post.php?p=$id_post&m=unlike&l=see_community.php?c=$id_community'
              title='Gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star'>
              </span></a>";
             }else{
               echo "<a href='like_post.php?p=$id_post&m=like&l=see_community.php?c=$id_community'
                title='Não gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star-empty'>
                </span></a>";
             }
             echo " <a href='see_post.php?p=$id_post'
                title='Comentar' class='btn btn-default' id='like-btn'>".$comments_qnt." <span class='glyphicon glyphicon-comment'>
                </span></a>";
             if($post["id_user"] == $id_user){
              echo " <a href='del_post.php?p=$id_post&l=see_community.php?c=$id_community'
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



    <script src="js/pattern.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>