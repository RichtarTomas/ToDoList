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
	<title>Editace</title>
	<meta name="author" content="Your Name">
	<meta name="description" content="Example description">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="test.css">

</head>

<body>
	<h1 class="TextCenter">Editace</h1>
    <?php
    if(!$dotaz=mysqli_query($link,"SELECT * FROM list WHERE id = '".$_GET["edit"]."'"))
    {
        echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
        exit();
    }
    $x=mysqli_fetch_assoc($dotaz);
    ?>
    <form class="hlavniForm" method="post">
        
            <p>Zadej co chceš dělat: <input type="text" name="cinnost" value="<?php echo $x["cinnost"]; ?>"></p>
            <p>Zadej více informací</p> <textarea name="info" rows="10" cols="50" maxlength="500" ><?php echo $x["info"]; ?></textarea>
            <p>Splněno
                <select name="splneno">
                    <option value="NE">NE</option>
                    <option value="ANO">ANO</option>
                </select>
            </p>
            <p>Zadej datum vykonání: <input type="date" name="datum" value="<?php echo $x["datumUkonceni"]; ?>"></p>
        
        <input type="submit" name="ok" value="Upravit">
    </form>
    <?php
        if(isset($_POST["ok"]))
        {
            if(!mysqli_query($link, "UPDATE list set 
            cinnost = '".$_POST["cinnost"]."',
            datumUkonceni = '".$_POST["datum"]."',
            info = '".$_POST["info"]."',
            splneno = '".$_POST["splneno"]."'
            WHERE id = '".$_GET["edit"]."'
            "))
            {
                echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
                exit();
            }
            header("location:todo.php");
        }
    ?>
</body>

</html>