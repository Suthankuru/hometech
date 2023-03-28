<?php
session_start();
<!DOCTYPE html >
<html>
    <body>
        <?php
        $_SESSION["uname"]=$_POST["name"];
        echo "Welcome" ,$_SESSION["uname"].".";
       ?>
    </body>
</html>    
