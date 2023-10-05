<?php
    require 'conexao.php';

    if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])):
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página Inicial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1c3399;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #081b74;
            padding: 10px 20px;
        }

        .logo {
            width: 80px; /* Largura da logo, ajuste conforme necessário */
        }

        .titulo-site {
            font-size: 24px;
            color: white;
            text-align: center;
            flex-grow: 1; /* Permite que o título do site ocupe o espaço restante */
        }

        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .menu li {
            position: relative;
        }

        .menu a {
            font-size: 16px;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        /* Estilo para hover */
        .menu a:hover {
            background-color: #081b74;
        }

        /* Submenu */
        .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #081b74;
            list-style-type: none;
            padding: 0;
            width: 200px;
        }

        .menu li:hover .submenu {
            display: block;
        }

        .submenu li {
            margin: 0;
        }

        .submenu a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }

        .submenu a:hover {
            background-color: #081b74;
        }
    </style>
</head>
<body>

<div class="navbar">
    <img src="imagens/A7agro.png" alt="Logo da Empresa" class="logo">
    <h1 class="titulo-site">Cadastro de Safras</h1>
    <ul class="menu">
        <li>
            <a href="index.php">Adicionar</a>
            <ul class="submenu">
                <li><a href="produto.php">Produtos</a></li>
                <li><a href="safras.php">Safras</a></li>
            </ul>
        </li>
        <a href="logout.php" class="logout-button">Sair</a>
        </li>
    </ul>
</div>

<!-- Conteúdo da página -->
<div style="padding: 20px;">
    <h1>Bem-vindo ao Nosso Site</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla velit in bibendum fermentum.</p>
</div>

</body>
</html>
<?php
else: header("Location: login.php"); endif;
?>