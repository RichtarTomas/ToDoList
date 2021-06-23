<?php
    $link = mysqli_connect("localhost","root","","todolist");
    if(!$link)
    {
        echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
        exit();
    }
    mysqli_set_charset($link,"utf8");
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<title>ToDoList</title>
	<meta name="author" content="Your Name">
	<meta name="description" content="Example description">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="test.css">
	<link rel="icon" type="image/x-icon" href=""/>
</head>
<body>
    <div class="prihlaseni">
        <h1>Přihlášení</h1>
        <form class="prihlaseniForm" method="post">
            <p><b>Zadej login: </b><input type="text" name="login"></p>
            <p><b>Zadej heslo: </b><input type="password" name="heslo"></p>
            <p><input style="margin-right: 20px" type="submit" name="ok" value="Přihlásit">
            <input type="submit" name="reg" value="Registrace"></p>
        </form>
    <?php
    if(isset($_POST["ok"]))
    {
        if(!empty($_POST["heslo"]) && !empty($_POST["login"]))
        {
            $login = $_POST["login"];
            if(!$dotaz = mysqli_query($link, "SELECT login,heslo FROM uzivatele WHERE login='$login'"))
            {
                echo "<p style=\"color:red\"><b>Něco se pokazilo s databázi.</b></p>";
                exit();
            }
            $x = mysqli_fetch_row($dotaz);
            if(!empty($x[0]))
            {
                if($x[1] == md5($_POST["heslo"]))
                {
                    session_start();
                    $_SESSION["login"]=$login;
                    header("location:todo.php");
                }
                else
                {
                    echo "<p style=\"color:red\"><b>Špatné přihlašovací údaje.</b></p>";
                }
            }
            else
            {
                echo "<p style=\"color:red\"><b>Špatné přihlašovací údaje.</b></p>";
            }
        }
        else
        {
            echo "<p style=\"color:red\"><b>Login a heslo nesmí být prázdne.</b></p>";
        }
    }
    if(isset($_POST["reg"]))
    {
        if(!empty($_POST["heslo"]) && !empty($_POST["login"]))
        {
                
            $login = $_POST["login"];
            $heslo = md5($_POST["heslo"]);
            
            if(!$vloz=mysqli_query($link,"INSERT INTO uzivatele (login, heslo) VALUES ('$login','$heslo')"))
            {
                echo "<p style=\"color:red\"><b>Něco se nepovedlo.</b></p>";
            }
        }
        else
        {
            echo "<p style=\"color:red\"><b>Login a heslo nesmí být prázdne.</b></p>";
        }
    }
    ?>
    </div>   
</body>
</html>