<?php
    session_start();
    include_once("db.php");

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        return;
    }

    if(!isset($_GET['pid'])) {
        header("Location: blog.php");
    }

    $pid = $_GET['pid'];

    if(isset($_POST['update'])) {
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);

        $title = mysqli_real_escape_string($db, $title);
        $content = mysqli_real_escape_string($db, $content);

        $date = date('l jS \of F Y h:i:s A');

        $sql = "UPDATE post SET title='$title', content='$content', date='$date' WHERE id=$pid";

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
        <?php
            $sql_get = "SELECT * FROM posts WHERE id=$pid LIMIT 1";
            $res = mysqli_query($db, $sql_get);
            if(mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $title = $row['title'];
                    $content = $row['content'];
                
                    echo "<form action='edit_post.php' method='post' enctype='multipart/from-data'>";
                    echo "<input placeholder='Title' name='title' type='text' value='$title' autofocus size= '48'><br/><br/>";
                    echo "<textarea placeholder='Content' name='content' rows='20' cols='50'>$content</textarea><br/>";
                }
            }
        ?>
        
    <div class="NewPost">
        <input name= "update" type="submit" value="Update"> 
    </div>
</body>

<footer>
© 2020 Blog example - Paweł Minda
</footer>
</html>