<?php
session_start();
$link = mysqli_connect("localhost","root","","todolist");
    if(!$link)
    {
        echo "Chyba";
        exit();
    }
mysqli_set_charset($link,"utf8");
?>
<!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8">
	<title>Info</title>
	<meta name="author" content="Your Name">
	<meta name="description" content="Example description">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="test.css">
</head>

<body>
	<h1>Info</h1>
    <?php
    if(!$dotaz=mysqli_query($link,"SELECT * FROM list WHERE id = '".$_GET["edit"]."'"))
    {
        echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
        exit();
    }
    $x=mysqli_fetch_assoc($dotaz);
    ?>
    <form class="hlavniForm" method="get">
        <p>Více informací<textarea name="info" rows="10" cols="50" maxlength="500" readonly ><?php echo $x["info"]; ?></textarea></p>
        <input type="submit" name="ok" value="Zpět">
    </form>
    <?php
        if(isset($_GET["ok"]))
        {
            header("location:todo.php");
        }
    ?>
</body>

</html>