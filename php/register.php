<?php
    if(isset($_SESSION['id'])) {
        header("Location: blog.php");
    }
    if(isset($_POST['register'])) {
        include_once("db.php");

        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        $password_confirm = strip_tags($_POST['password_confirm']);
        $email = strip_tags($_POST['email']);

        $username = stripslashes($username);
        $password = stripslashes($password);
        $password_confirm = stripslashes($password_confirm);
        $email = stripslashes($email);

        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
        $password_confirm = mysqli_real_escape_string($db, $password_confirm);
        $email = mysqli_real_escape_string($db, $email);

        $password = md5($password);
        $password_confirm = md5($password_confirm);

        $sql_store = "INSERT into users (username, password, email) VALUES ('$username', '$password', '$email')";
        $sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
        $sql_fetch_email = "SELECT email FROM users WHERE email = '$email'";

        $query_username = mysqli_query($db, $sql_fetch_username);
        $query_email = mysqli_query($db, $sql_fetch_email);

        if(mysqli_num_rows($query_username)) {
            echo "There is already a user with that name!";
            return;
        }

        if($username == "") {
            echo "Please insert a username";
            return;
        }
        if($password == "" || $password_confirm == "") {
            echo "Please insert a password";
        }

        if( $password != $password_confirm) {
            echo "The passwords do not match!";
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == "") {
            echo "This email is not valid!";
            return;
        }

        if(mysqli_num_rows($query_email)) {
            echo "That email is already in use!";
            return;
        }

        mysqli_query($db, $sql_store);
        header("Location: login.php");
    }  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
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
  <a href="login.php"><div class="MenuButtons">Zaloguj się</div></a>
</nav>

<body>
    <h1 style="font-family: Tahoma;">Register</h1>
    <form action="register.php" method="post" enctype="multipart/form-data">
        <input placeholder="Username" name="username" type="text" autofocus>
        <input placeholder="Password" name="password" type="password">
        <input placeholder="Confirm Password" name="password_confirm" type="password">
        <input placeholder="E-Mail Address" name= "email" type="text">
        <input name="register" type="submit" value="Register">
    </form>
</body>

<footer>
© 2020 Blog example - Paweł Minda
</footer>
</html>