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
$id_post = $_GET["p"];
$conn = connect();
$sql = "SELECT * FROM posts
JOIN users ON posts.user = users.id_user
JOIN communities ON posts.community = communities.id_community
WHERE id_post = '$id_post'";
if($query = mysqli_query($conn, $sql)){
    $post = mysqli_fetch_assoc($query);
    if(!isset($post["id_user"])){
        header("location:home.php");
    }
}else{
    header("location:home.php");
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
            <li><a href="#">Ver Comunidades</a></li>
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
                         - <span class="gray-text">@'.$post["username"].'</span></a>';   
                        }else{
                            echo "<a href='see_profile.php?p='".$post["id_user"].' class="gray-text-link">
                         <strong>'.$post["first_name"].'</strong>
                         - <span class="gray-text">@'.$post["username"].'</span></a>'; 
                        }
                        ?>
                    </div>
                    <div class="col-lg-3 col-lg-offset-1">
                        ads
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row border-bottom">
                    <div class="col-lg-10 col-lg-offset-1">
                        <p>Lorem ipsum dolor sit amet consectetur 
                        adipisicing elit. Officiis deleniti voluptatum
                         nisi magni adipisci quis repudiandae 
                         veniam sunt quae commodi molestiae 
                         id a culpa sed minima minus,
                          vitae impedit ipsam.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </div>
                            <div class="panel-body">
                                Nobis amet temporibus eos labore voluptatem facilis! Magni vitae reiciendis repudiandae, nesciunt ipsa perspiciatis provident eligendi nobis soluta nihil sequi aperiam neque?
                                Sapiente impedit minus officiis exercitationem unde molestiae. Vitae architecto natus nesciunt dignissimos consectetur praesentium quibusdam illo culpa! Ipsam eum accusamus perferendis eos explicabo, odio dolorum placeat reprehenderit facere quasi voluptates.
                                Expedita sint ipsa nulla sapiente dolore veniam, consequuntur vitae laborum itaque voluptas modi excepturi doloribus saepe perferendis adipisci odit ipsam perspiciatis, architecto consectetur quae voluptates quam corporis distinctio quis! Inventore!
                                Hic commodi libero ducimus quos beatae expedita, laboriosam, ipsam mollitia, nostrum est veniam. Repudiandae sunt molestiae itaque cum esse, mollitia quibusdam ullam, temporibus veniam consectetur doloribus reprehenderit. Beatae, repudiandae animi!
                                Unde pariatur provident labore officiis amet. Reiciendis, ratione. Reprehenderit dolores mollitia quis, cumque delectus nulla perspiciatis assumenda nihil necessitatibus molestias repellendus pariatur libero vero magnam quibusdam? Ducimus vero quidem soluta.
                                Ipsum, molestiae deserunt? Ducimus hic dolorum similique, deleniti illum sapiente itaque eos architecto voluptatum obcaecati nulla, aperiam, saepe natus qui tempora! Blanditiis suscipit minus adipisci ex ea unde! Vel, modi.
                            </div>
                            <div class="panel-footer">
                                Quibusdam dolore quia architecto suscipit laborum earum commodi sed exercitationem, libero, eaque, maiores esse cumque est fugiat asperiores? Excepturi, consectetur fuga dignissimos voluptatem accusantium unde est rem id enim quas!
                                Eligendi libero officia pariatur incidunt animi suscipit quaerat, porro praesentium vero consequatur impedit ratione eos unde ullam nam cum exercitationem sit earum nemo repellat harum nulla aliquid optio asperiores! Earum.
                            </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <form method="post">
                  <div class="form-group">
                    <textarea class="form-control" name="input_txt" rows='3' placeholder="Comentário..."></textarea>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>