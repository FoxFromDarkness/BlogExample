<?php
    session_start();
 
    if(isset($_POST['login'])) {
        include_once("db.php");
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
 
        $username = stripslashes($username);
        $password = stripslashes($password);
       
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
 
        $password = md5($password);
 
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $query = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($query);
        $id = $row['id'];
        $db_password = $row['password'];
 
        if($password == $db_password) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            header("Location: blog.php");
        } else {
            echo "You didn't enter the correct details!";
        }
    }
?>
 
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
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
  <a href="register.php"><div class="MenuButtons">Zarejestruj się</div></a>
</nav>

<body>
    <h1 style="font-family: Tahoma;">Login</h1>
    <form action="login.php" method="post" enctype="multipart/form-data">
        <input placeholder="Username" name="username" type="text" autofocus>
        <input placeholder="Password" name="password" type="password">
        <input name="login" type="submit" value="Login">
    </form>
</body>

<footer>
© 2020 Blog example - Paweł Minda
</footer>
</html>