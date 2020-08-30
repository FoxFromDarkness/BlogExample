<?php
    session_start();
    include_once("db.php");

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        return;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style_blog.css" rel="stylesheet"/>
    <script src="main.js"></script>
</head>

<header>
  <img src="../images/logo_blog.png" style="
    height: 250px;
    width: 250px;
    margin-top: 4%;
    margin-bottom: 4%;">
</header>

<nav>
<a href="blog.php"><div class="MenuButtons">Strona główna</div></a>
<a href="post.php"><div class="MenuButtons">Stwórz nowy post</div></a>
<a href="logout.php"><div class="MenuButtons">Wyloguj się</div></a>
</nav>

<body>
    <div class="Post">
        <?php
            require_once("../nbbc/nbbc.php");

            $bbcode = new BBCode;

            $sql = "SELECT * FROM posts WHERE `id_user`= 2";

            $res = mysqli_query($db, $sql) or die(mysqli_error());

            $posts = "";

            if(mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $date = $row['date'];

                    $admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a>&nbsp</div>";

                    $output = $bbcode ->Parse($content);

                    $posts .= "<div><h2><a2 href='view_post.php?pid=$id'>$title<a2/></h2><h3>$date</h3><p>$output</p>$admin<hr /></div>";
                }
                echo $posts;
            }   else {
                echo "There are no posts to dislay!";
            }
        ?>
    </div>
</body>

<footer>
  © 2020 Blog example - Paweł Minda
</footer>
</html>