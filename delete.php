<?php
session_start();
$link = mysqli_connect("localhost","root","","todolist");
    if(!$link)
    {
        echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
        exit();
    }
    mysqli_set_charset($link,"utf8");
if(!mysqli_query($link, "DELETE FROM list WHERE id ='".$_GET["smaz"]."'"))
{
    echo "<p style=\"color:red\"><b>Nějaká chyba v databázi.</b></p>";
    exit();
}
header("location:todo.php");
?>
