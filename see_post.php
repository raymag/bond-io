<?php
session_start();
include "inc/functions/connection.php";
if(!isset($_SESSION["id_user"])){
  header("location:index.php");
}
if(!isset($_GET["p"])){
    header("location:home.php");
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
$id_post = $_GET["p"];
$conn = connect();
$sql = "SELECT *, date_format(posts.r_date, '%d, %b, %Y, %T') as data_f FROM posts
JOIN users ON posts.user = users.id_user
JOIN communities ON posts.community = communities.id_community
WHERE id_post = '$id_post'";
if($query = mysqli_query($conn, $sql)){
    $post = mysqli_fetch_assoc($query);
    if(!isset($post["id_user"])){
        header("location:home.php");
    }
    $id_community = $post["id_community"];
    $community_name = $post["community_name"];
}else{
    header("location:home.php");
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
</nav>
<hr><hr><hr>
<div class="container">
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-8">
                        <?php
                        if($post["id_user"]==$id_user){
                            echo "<a href='profile.php'".' class="gray-text-link">
                            <strong>'.$post["first_name"].'</strong>
                            - <span class="gray-text">@'.$post["username"].' | '.
                            "<a class='gray-text-link' href='see_community.php?c=$id_community'><strong>$community_name</strong></a>".' - '.$post["data_f"].'</span></a>';   
                        }else{
                            echo "<a href='see_profile.php?p=".$post["id_user"]."' class='gray-text-link'>
                            <strong>".$post["first_name"].'</strong>
                            - <span class="gray-text">@'.$post["username"].' | '.
                            "<a class='gray-text-link' href='see_community.php?c=$id_community'><strong>$community_name</strong></a>".' - '.$post["data_f"].'</span></a>'; 
                        }
                        ?>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1">
                        <?php
                        if(isset($_POST["input_txt"][0])){
                            $txt = $_POST["input_txt"];
                            $conn = connect();
                            $sql = "INSERT INTO comments (user, post, comment_text) 
                            VALUES ($id_user, $id_post, '$txt')";
                            if(mysqli_query($conn, $sql)){
                                if($post["id_user"]!=$id_user){
                                    $sql = "INSERT INTO notifications (user, post, community, type, acting_user)
                                    VALUES (".$post["id_user"].",$id_post,".$post["community"].",'comment',$id_user)";
                                    mysqli_query($conn, $sql);
                                    $sql = "SELECT DISTINCT user FROM comments WHERE user != $id_user
                                     AND user != ".$post["id_user"]." AND post = $id_post";
                                     if($query = mysqli_query($conn, $sql)){
                                         while($user = mysqli_fetch_assoc($query)["user"]){
                                             $sql = "INSERT INTO notifications (user, post, community, type, acting_user)
                                             VALUES ($user,$id_post,".$post["community"].",'comment_another',$id_user)";
                                             mysqli_query($conn, $sql);
                                         }
                                     }
                                }else{
                                    $sql = "SELECT DISTINCT user FROM comments WHERE user != $id_user";
                                    if($query = mysqli_query($conn, $sql)){
                                        while($user = mysqli_fetch_assoc($query)["user"]){
                                            $sql = "INSERT INTO notifications (user, post, community, type, acting_user)
                                            VALUES ($user,$id_post,".$post["community"].",'comment_own',$id_user)";
                                            mysqli_query($conn, $sql);
                                        }
                                    }
                                }
                            }
                            mysqli_close($conn);
                        }
                        $conn = connect();
                        $sql = "SELECT count(*) as comments FROM comments WHERE post = $id_post";
                        if($q = mysqli_query($conn, $sql)){
                            $comments_qnt = mysqli_fetch_assoc($q)["comments"];
                        }else{
                            $comments_qnt = '';
                        }
                        mysqli_close($conn);
                        $conn = connect();
                        $sql = "SELECT * FROM likes WHERE post = ".$post["id_post"]." AND user = $id_user";
                        if(isset(mysqli_fetch_assoc(mysqli_query($conn, $sql))["post"])){
                            echo "<a href='like_post.php?p=$id_post&m=unlike&l=see_post.php?p=$id_post'
                            title='Gostei' class='btn btn-default' id='like-btn'>".$post["likes"]." <span class='glyphicon glyphicon-star'>
                            </span></a>";
                           }else{
                             echo "<a href='like_post.php?p=$id_post&m=like&l=see_post.php?p=$id_post'
                              title='Não gostei' class='btn btn-default' id='like-btn'>".$post["likes"]." <span class='glyphicon glyphicon-star-empty'>
                              </span></a>";
                           }
                           echo " <a href='see_post.php?p=$id_post#commentInput'
                            title='Comentar' class='btn btn-default' id='like-btn'>$comments_qnt <span class='glyphicon glyphicon-comment'>
                            </span></a>";
                            if($post["id_user"] == $id_user){
                                echo " <a href='del_post.php?p=$id_post&l=home.php'
                                title='Apagar' class='btn btn-danger' id='like-btn'><span class='glyphicon glyphicon-trash'>
                                </span></a>";
                               }
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row border-bottom">
                    <div class="col-lg-10 col-lg-offset-1">
                        <p><?php echo $post["post_text"] ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <?php
                        $conn = connect();
                        $sql = "SELECT *, date_format(comments.r_date, '%d, %b, %Y, %T') as data_f,
                        UNIX_TIMESTAMP(comments.r_date) as utimestamp FROM comments 
                        JOIN users ON user = users.id_user
                        WHERE post = $id_post ORDER BY data_f ASC";
                        if($query = mysqli_query($conn, $sql)){
                            $comments = array();
                            while($comment = mysqli_fetch_assoc($query)){
                                $comments[] = $comment;
                            }
                            function organizer($a, $b){
                                $a = $a["utimestamp"];
                                $b = $b["utimestamp"];

                                if($a == $b) return 0;
                                return ($a > $b) ? 1 : 0;
                            }
                            usort($comments, "organizer");
                            foreach($comments as $comment){
                                echo "<div class='panel panel-info'>";
                                echo '<div class="panel-heading">';
                                if($comment["user"]==$id_user){
                                    echo "<a href='profile.php'".' class="dark-text-link">
                                    <strong>'.$comment["first_name"].'</strong>
                                    - <span class="dark-text">@'.$comment["username"].' | '.$comment["data_f"].'</span></a>';   
                                   }else{
                                       echo "<a href='see_profile.php?p=".$comment["user"]."' class='dark-text-link'>
                                    <strong>".$comment["first_name"].'</strong>
                                    - <span class="dark-text">@'.$comment["username"].' | '.$comment["data_f"].'</span></a>'; 
                                   }
                                echo '</div>';
                                echo '<div class="panel-body">';
                                echo $comment["comment_text"];
                                echo '</div>';
    
                                echo '</div>';
                            }
                        }
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <?php
                ?>
                <form method="post">
                  <div class="form-group">
                    <textarea class="form-control" id="commentInput" name="input_txt" rows='3' placeholder="Comentário..." 
                    maxLength="550" style="resize:none"></textarea>
                  </div>
                  <button type="submit" class="btn btn-success btn-block">Comentar</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row panel-gray">
    </div>
</div>



    <script src="js/pattern.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>