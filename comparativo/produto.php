<?php
    require 'conexao.php';
    include_once('conexao.php');
    set_time_limit(0);

    $localhost="localhost";
    $user="root";
    $passw="";
    $banco="comparativo";

$conecta = mysqli_connect($localhost, $user, $passw, $banco);
mysqli_set_charset($conecta, "utf8");

    if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])):

    $sql = "SELECT * FROM produto ORDER BY id DESC";
    $result = $conecta->query($sql);

/*print_r($result);*/

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
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .navbar {
            display: flex;
            align-items: center;
            background-color: #0a228f;
            padding: 10px 20px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            margin: 0 auto;
            width: 400px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .logo {
            width: 80px; /* Largura da logo, ajuste conforme necessário */
        }

        .titulo-site {
            font-size: 24px;
            color: white;
            text-align: center;
            flex-grow: 10; /* Permite que o título do site ocupe o espaço restante */
            margin: 0;
            margin-left: 130px; /* Adicione margem à esquerda */
            margin-right: 20px; /* Adicione margem à direita */
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

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        button  {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .table-bg{
            background: rgba(0,0,0, 0,3);
            border-radius: 15px 15px 0 0;
        }

        /* Estilo da tabela */
        .table {
    width: flex;
    border-collapse: collapse;
    margin-top: 20px;
    margin-left: 30px; /* Adicione margem à esquerda */
    margin-right: 20px; /* Adicione margem à direita */
    border-radius: 10px;
    }

        .table th, .table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #000; /* Adicione bordas */
    color: white;
    }

        .table th {
    background-color: #007bff;
    color: white;
    }

        .table tr:nth-child(even) {
    background-color: #4F4F4F;
    color: white;
    }

    .btn-delete {
        padding: 10px 20px;
        background-color: red;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-image: linear-gradient(to bottom, #ff0000, #cc0000); /* Gradiente de vermelho */
        text-decoration: none; /* Remova sublinhado do link */
        display: inline-block; /* Permite que o link tenha um tamanho igual ao conteúdo */
        width: auto; /* Largura automática com base no conteúdo */
        text-align: center; /* Centraliza o texto horizontalmente */
        margin: 0; /* Remove margens do link */
    }

    /* Estilo para o botão de delete no hover */
    .btn-delete:hover {
        background-color: #ff0000; /* Cor mais clara no hover */
    }
    </style>
</head>
<body>
<div class="navbar">
    <a href="index.php">
    <img src="imagens/A7agro.png" alt="Logo da Empresa" class="logo">
    </a>
    <h1 class="titulo-site">Cadastro de Produto</h1>
    <ul class="menu">
        <li>
            <b><a href="produto.php">Adicionar</a></b>
            <ul class="submenu">
                <b><li><a href="produto.php">Produtos</a></li></b>
            </ul>
        </li>
        <b><a href="logout.php" class="logout-button">Sair</a></b>
        </li>
    </ul>
</div>

<!-- Conteúdo da página -->
<div class="container">
    <h1>Envio de Arquivo CSV</h1>
    <p> Ultilizar o seguinte padrão no arquivo csv: #id, nome do produto, seguradora, tipo, cobertura, data de criação, cidade, uf, produtividade Garantida, taxa, safra.</p>
    <form action="importar.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" id="file" accept="text/csv">
        <button type="submit">Enviar</button>
    </form>
</div>
<div class="m-5">
    <table class="table text-white table-bg">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do Produto</th>
                <th scope="col">Seguradora</th>
                <th scope="col">Tipo</th>
                <th scope="col">Cobertura</th>
                <th scope="col">Data de Criação</th>
                <th scope="col">Cidade</th>
                <th scope="col">UF</th>
                <th scope="col">Produtividade Esperada</th>
                <th scope="col">Taxa</th>
                <th scope="col">Safra</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . $user_data['nomedoproduto'] . "</td>";
                    echo "<td>" . $user_data['seguradora'] . "</td>";
                    echo "<td>" . $user_data['tipo'] . "</td>";
                    echo "<td>" . $user_data['cobertura'] . "</td>";
                    echo "<td>" . $user_data['datadecriacao'] . "</td>";
                    echo "<td>" . $user_data['cidade'] . "</td>";
                    echo "<td>" . $user_data['uf'] . "</td>";
                    echo "<td>" . $user_data['prodesperada'] . "</td>";
                    echo "<td>" . $user_data['taxa'] . "</td>";
                    echo "<td>" . $user_data['Safra'] . "</td>";
                    echo "<td>
                    <a class='btn-delete' href='delete.php?id=$user_data[id]'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
  <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
</svg> </a>
                    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
<?php
else: header("Location: login.php"); endif;
?>
