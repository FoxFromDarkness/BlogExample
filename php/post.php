<?php
    session_start();
    include_once("db.php");

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        return;
    }

    if(isset($_POST['post'])) {
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);

        $title = mysqli_real_escape_string($db, $title);
        $content = mysqli_real_escape_string($db, $content);

        $date = date('l jS \of F Y h:i:s A');
 
        $sql = "INSERT into posts (title, content, date, id_user) VALUES ('$title', '$content', '$date', '1')";

        if($title == "" || $content == "") {
            echo "Please cpomplete your post!";
            return;
        }
        mysqli_query($db, $sql);
        header("Location: blog.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blog - Post</title>
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
    <a href="logout.php"><div class="MenuButtons">Wyloguj się</div></a>
</nav>

<body>
    <div class="NewPost">
        <form action="post.php" method="post" enctype="multipart/from-data">
        <input placeholder='Title' name='title' type="text" autofocus size= "48"><br/><br/>
        <textarea placeholder="Content" name='content' rows='20' cols="50"></textarea><br/>
        <input name= "post" type="submit" value="Post"> 
    </div>
</body>

<footer>
© 2020 Blog example - Paweł Minda
</footer>
</html>