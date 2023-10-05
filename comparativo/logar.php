<?php

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

    require 'conexao.php';
    require 'Usuario.Class.php';

    $u = new Usuario();

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if($u->login($email, $senha) == true){
        if(isset($_SESSION['idUser'])){
            header("Location: index.php");
        }else{
            header("Location: login.php");
        }
    }else{
        $erro = "Usuário ou senha incorretos. Tente novamente."; // Mensagem de erro
        echo '<script>';
        echo 'alert("' . $erro . '");';
        echo 'window.location.href = "login.php";'; // Redirecione para a página de login
        echo '</script>';
    }

}else{

    header("Location: login.php");
}





?>