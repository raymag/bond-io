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
$sql = "SELECT * FROM users WHERE id_user = $id_user";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($query);
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
</nav>

<div class="container-fluid">
<div class="row" style="margin-top:50px;background:rgba(0, 0, 0, 0.8)">
    <div id="picture-container" class="col-sm-4 col-md-3 col-lg-2" style="background-image:url('<?php
     echo $user["profile_pic"]  
      ?>')">
    </div>
    <div class="col-sm-8 col-md-9 col-lg-10 jumbogotron" id="backcontainer">
          <h1 class="text-left"><?php echo $user["first_name"].' '.$user["last_name"].' - @'.$user["username"]?></h1><hr>
          <h3>
              <label title='Stars' class='label label-default' style="padding:14px">
              <?php echo $user["stars"] ?>
              <label class='glyphicon glyphicon-star'></label></label>
              <!-- <label title='Seguidores' class='label label-default' style="padding:14px"> -->
              <a href="see_followers.php" title="Seguidores" class="btn btn-primary" style="padding:14px">
              <?php
               echo $user["followers"];
                ?>
              <span class='glyphicon glyphicon-user'></span>
                </a>
              <!-- </label>  -->
              <!-- <label title='Seguindo' class='label label-default' style="padding:14px"> -->
              <a href="see_following.php" title="Pessoas seguidas" class="btn btn-primary" style="padding:14px">
              <?php
               echo $user["following"];
               ?>
              <span class='glyphicon glyphicon-arrow-right'></span>
              </a>
              <!-- </label>  -->
              <a href="update_profile_pic.php" title="Alterar foto de perfil" class="btn btn-primary" style="padding:14px">
                <span class="glyphicon glyphicon-picture"></span>
              </a>
          </h3>
    </div>
</div>
</div>
<br>
<div class="container">
<div class="row panel-gray">
    <div class="col-lg-10 col-lg-offset-1">
        <?php
        $conn = connect();
        $sql = "SELECT *, date_format(posts.r_date, '%d, %b, %Y, %T') as data_f, UNIX_TIMESTAMP(posts.r_date) as utimestamp FROM posts
        JOIN communities ON posts.community = communities.id_community WHERE user = '$id_user'";
        if($query = mysqli_query($conn, $sql)){
            $posts = array();
            while($row = mysqli_fetch_assoc($query)){
                $posts[] = $row;
            }
            function organizer($a, $b){
                $a = $a['utimestamp'];
                $b = $b['utimestamp'];

                if ($a == $b) return 0;
                return ($a > $b) ? 0 : 1;
            }
            usort($posts, "organizer");
            foreach($posts as $post){
                $text = $post["post_text"];
                $likes = $post["likes"];
                $id_post = $post["id_post"];
                $id_community = $post["community"];

                $sql = "SELECT count(*) as comments FROM comments WHERE post = $id_post";
                if($q = mysqli_query($conn, $sql)){
                  $comments_qnt = mysqli_fetch_assoc($q)["comments"];
                }else{
                  $comments_qnt = '';
                }

                echo "<div class='panel panel-primary'>
                <div class='panel-heading'><strong>".$_SESSION["first_name"]." | 
                <a href='see_community.php?c=$id_community' class='gray-text-link'>".$post["community_name"]
                ."</a></strong> - <span class='gray-text'>@".$_SESSION["username"]." - ";
                echo $post["data_f"]."</span></div>
                <div class='panel-body'>
                 $text
                </div>
                <div class='panel-footer'> ";
                $sql = "SELECT * FROM likes WHERE post = $id_post AND user = $id_user";
                if(isset(mysqli_fetch_assoc(mysqli_query($conn, $sql))["post"])){
                 echo "<a href='like_post.php?p=$id_post&m=unlike&l=profile.php'
                 title='Gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star'>
                 </span></a>";
                }else{
                  echo "<a href='like_post.php?p=$id_post&m=like&l=profile.php'
                   title='Não gostei' class='btn btn-default' id='like-btn'>$likes <span class='glyphicon glyphicon-star-empty'>
                   </span></a>";
                }
                echo " <a href='see_post.php?p=$id_post'
                title='Comentar' class='btn btn-default' id='like-btn'>".$comments_qnt." <span class='glyphicon glyphicon-comment'>
                </span></a>";
                echo " <a href='del_post.php?p=$id_post&l=profile.php'
                title='Apagar' class='btn btn-danger' id='like-btn'><span class='glyphicon glyphicon-trash'>
                </span></a>";
                echo "</div>
              </div>";
            }
            if(count($posts)==0){
                echo "<h4 class='text-center'>Você ainda não possui nenhuma publicação... <br>
                Para publicar algo, encontre uma comunidade ou <a href='create_community.php'>crie uma nova</a></h4>";
            }
        }
        mysqli_close($conn);
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