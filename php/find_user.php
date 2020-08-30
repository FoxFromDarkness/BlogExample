<?php
        $host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "blog";
    try{
        $connection = @new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }
        
        else{         
					$sql = "SELECT `username`, `email`, `date`, `title` ,`content` FROM posts INNER JOIN users ON `id` = `id_user`";
					$result = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo
        
                        "<b><TR>Nick:&nbsp&nbsp".$row["username"]."</b><br/>".
                        "<b><TR>Email:&nbsp&nbsp". $row["email"]."</b><br/>".
                        "<TR>". $row["date"]."<br/>".
                        "</TR><TR><br />" . $row["title"] .						
                        "</TR><TR><br />" . $row["content"] .
                        "<br/>"."====================================="."<br/>".
                        "</TR><TR></TR>\n";	
                        }
            
        }
        $connection->close();
    }
    catch(Excepiotn $e){
        echo '<span style="color: red">Błąd serwera, spróbuj ponownie później.</span>';
    }
?>