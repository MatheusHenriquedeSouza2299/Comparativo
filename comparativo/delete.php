<?php

require 'conexao.php';
include_once('conexao.php');

if(!empty($_GET['id']))
{

    $localhost="localhost";
    $user="root";
    $passw="";
    $banco="comparativo";

$conecta = mysqli_connect($localhost, $user, $passw, $banco);
mysqli_set_charset($conecta, "utf8");

$id=$_GET['id'];

$sqlSelect = "SELECT * FROM produto WHERE id=$id";

$result=$conecta->query($sqlSelect);

if($result->num_rows >0)
{
    while($user_data = mysqli_fetch_assoc($result))
    {
        $sqlDelete= "DELETE FROM produto WHERE id=$id";
        $resultDelete=$conecta->query($sqlDelete);
    }
}
}
header('Location: produto.php');
?>
