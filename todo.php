<?php
session_start();
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
	<title>MyToDoList</title>
	<meta name="author" content="Your Name">
	<meta name="description" content="Example description">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="test.css">
	<link rel="icon" type="image/x-icon" href=""/>
</head>

<body>
	<h1>To do list</h1>
    <form class="hlavniForm" method="get">
        <p><input type="text" name="cinnost" placeholder="Zadej co chceš udělat"></p>
        <p>Do kdy? <input type="date" name="datum"></p>
        <p>Bližší informace
        <textarea name="info" rows="10" cols="50" maxlength="500"></textarea></p>
        <input type="submit" name="ok" value="Přidat">
    </form>
    <?php
        $splneno = "NE";
        if(isset($_GET["ok"]))
        {
            if(!empty($_GET["cinnost"]) && !empty($_GET["datum"]) && !empty($_GET["info"]))
            {
                $cinnost = $_GET["cinnost"];
                $dnes = date("Y-m-d");
                $datum = $_GET["datum"];
                $info = $_GET["info"];
                $login = $_SESSION["login"];

                if(!$vloz=mysqli_query($link,"INSERT INTO list (datumZadani, cinnost, datumUkonceni, info, login, splneno) VALUES (
                '$dnes','$cinnost','$datum','$info','$login','$splneno')"))
                {
                    echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
                }
            }
            else
            {
                echo "<p style=\"color:red\"><b>Vyplň všechno.</b></p>";
            }
            
        }
        //databáze
        if(!$dotaz = mysqli_query($link, "SELECT id,datumZadani, cinnost, datumUkonceni, info, login, splneno FROM list"))
        {
            echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
            exit();
        }
        echo "<table class=tabulka>";
            echo "<th>Datum zadání</th><th>Druh činnosti</th><th>Informace</th><th>Termín dokončení</th><th>Splněno</th><th>Upravit</th><th>Vymazat</th>";
            while($x = mysqli_fetch_row($dotaz))
            {
                if($x[5] == $_SESSION["login"]) //Ověření kdo se připojil
                {
                    //datumy
                    $datumDokonceni = explode("-",$x[3]);
                    $realdatumDokonceni = $datumDokonceni[2].".".$datumDokonceni[1].".".$datumDokonceni[0];
                    $datumZadani = explode("-",$x[1]);
                    $realdatumZadani = $datumZadani[2].".".$datumZadani[1].".".$datumZadani[0];
                    //tabulka
                    if($datumZadani>$datumDokonceni)
                    {
                        echo "<tr>"; 
                            echo "<td>".$realdatumZadani."</td><td>".$x[2]."</td>".
                                "<td style=\"color:blue\"><a href=\"info.php?edit=".$x[0]."\">Detail</a></td>".
                                "<td style=\"color:red\">".$realdatumDokonceni."</td>"."<td>".$x[6]."</td>".
                                "<td style=\"color:blue\"><a href=\"editace.php?edit=".$x[0]."\">Edit</a></td>".
                                "<td style=\"color:red\"><a href=\"delete.php?smaz=".$x[0]."\">X</a></td>";
                        echo "</tr>";
                    }
                    else
                    {
                        echo "<tr>"; 
                            echo "<td>".$realdatumZadani."</td><td>".$x[2]."</td>".
                                "<td style=\"color:blue\"><a href=\"info.php?edit=".$x[0]."\">Detail</a></td>".
                                "<td>".$realdatumDokonceni."</td>"."<td>".$x[6]."</td>".
                                "<td style=\"color:blue\"><a href=\"editace.php?edit=".$x[0]."\">Edit</a></td>".
                                "<td style=\"color:red\"><a href=\"delete.php?smaz=".$x[0]."\">X</a></td>";
                        echo "</tr>";
                    }

                }
            }
        echo "</table>";
       
    ?>
    <form method="get">
        <input type="submit" value="Odhlásit se" name="logout">
    </form>
    <?php
        if(isset($_GET["logout"]))
        {
            header("location:index.php");
        }
    ?>
    
</body>

</html>