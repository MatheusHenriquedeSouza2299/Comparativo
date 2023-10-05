<?php
    require 'conexao.php';
    include_once('conexao.php');

    $localhost="localhost";
    $user="root";
    $passw="";
    $banco="comparativo";

    $conecta = mysqli_connect($localhost, $user, $passw, $banco);
    mysqli_set_charset($conecta, "utf8");

    if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])):

        $sql = "SELECT * FROM produto ORDER BY id DESC";
        $result = $conecta->query($sql);

        //busca
        $busca1=filter_input(INPUT_GET, 'cidade', FILTER_SANITIZE_STRING);
        $busca2=filter_input(INPUT_GET, 'uf', FILTER_SANITIZE_STRING);
        $busca3=filter_input(INPUT_GET, 'seguradora', FILTER_SANITIZE_STRING);
        $busca4=filter_input(INPUT_GET, 'safra', FILTER_SANITIZE_STRING);

         // Consulta SQL base
$sql = "SELECT * FROM produto WHERE 1=1";

// Adicionar filtros à consulta SQL
if (!empty($busca1)) {
    $sql .= " AND cidade LIKE '%$busca1%'";
}

if (!empty($busca2)) {
    $sql .= " AND uf LIKE '%$busca2%'";
}

if (!empty($busca3)) {
    $sql .= " AND seguradora LIKE '%$busca3%'";
}

if (!empty($busca4)) {
    $sql .= " AND Safra LIKE '%$busca4%'";
}

// Adicionar ordenação
$sql .= " ORDER BY id DESC";

// Adicione a limitação de linhas
$sql .= " LIMIT 100";

// Executar a consulta
$result = $conecta->query($sql);

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
            background-color: #1c3399;
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
            background-color: #0000FF;
        }

        /* Submenu */
        .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #0000FF;
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
            background-color: #0000FF;
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

        button {
            padding: 10px 20px; /* Defina valores de padding uniformes para ambos os botões */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .table-bg {
    background: rgba(0, 0, 0, 0.3); /* Corrigido o valor da transparência */
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
    border: 2px solid #000; /* Adicione bordas */
    }

        .table th {
    background-color: #007bff;
    color: white;
    }

        .table tr:nth-child(even) {
    background-color: #f2f2f2;
    }

    /* Estilo para o container dos filtros */
    .filter-container {
    background-color: ##007bff;
    padding: 20px;
    border-radius: 5px;
    display: flex; /* Use display flex para organizar os elementos lado a lado */
    flex-wrap: wrap; /* Para lidar com quebra de linha quando a tela é estreita */
    justify-content: space-between; /* Distribui os elementos horizontalmente */
}

.filter-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}


/* Estilo para os campos de filtro */
.form-group {
    flex: 1;
    margin-right: 10px;
    color: white;
}

    .form-group label {
    display: flex;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px; /* Ajuste o tamanho da fonte conforme necessário */
    margin-bottom: 10px;
}

.filter-buttons {
    flex: 1;
    margin-top: 10px;
}

.filter-buttons button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

.center-buttons {
    flex: 1;
    display: flex;
    align-items: flex-end;
    margin-top: 10px;
}


        /* Estilo para os campos de entrada */
        .search-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        /* Estilo para o botão de Pesquisar */
        .search-button,
        .clear-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px; /* Ajuste o tamanho da fonte conforme necessário */
            margin-right: 10px; 
    }

.search-button:hover,
.clear-button:hover {
    background-color: #0056b3;
}

        #grafico-wrapper {
        margin: 0 auto; /* Isso centraliza horizontalmente a div */
    }

    /* Estilo para linhas pares */
.linha-par {
    background-color: #B0E0E6; /* Defina a cor desejada para as linhas pares */
}

/* Estilo para linhas ímpares */
.linha-impar {
    background-color: #B0E0E6; /* Defina a cor desejada para as linhas ímpares */
}

    </style>
</head>
<body>

<div class="navbar">
    <img src="imagens/A7agro.png" alt="Logo da Empresa" class="logo" href="index.php">
    <h1 class="titulo-site">COMPARATIVO</h1>
    <ul class="menu">
        <li>
            <a href="produto.php">Adicionar</a>
            <ul class="submenu">
                <li><a href="produto.php">Produtos</a></li>
            </ul>
        </li>
        <a href="logout.php" class="logout-button">Sair</a>
        </li>
    </ul>
</div>

<!-- Conteúdo da página -->

<div class="filter-container">
    <div class="form-group" method="get">
    <form method="get" id="filtroForm">
        <div class="filter-row"> <!-- Container externo para os campos de filtro -->
            <div class="form-group">
                <center><label for="cidade">Cidade</label></center>
                <input type="text" id="cidade" name="cidade" value="<?=$busca1?>" class="form-control" placeholder="Cidade...">
            </div>
            <div class="form-group">
            <center><label for="uf">Estado</label></center>
                <input type="text" id="uf" name="uf" value="<?=$busca2?>" class="form-control" placeholder="Estado...">
            </div>
            <div class="form-group">
            <center><label for="seguradora">Seguradora</label></center>
                <input type="text" id="seguradora" name="seguradora" value="<?=$busca3?>" class="form-control" placeholder="Seguradora...">
            </div>
            <div class="form-group">
            <center><label for="safra">Safra</label></center>
                <input type="text" id="safra" name="safra" value="<?=$busca4?>" class="form-control" placeholder="Safra...">
            </div>
        </div>
        <div class="center-buttons">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
            <button class="clear-button" onclick="limparFiltros()">Limpar Filtros</button>
        </div>
    </form>
    </div>
</div>

<div id="grafico-wrapper" style="text-align: center; margin-top: 20px;">
    <div id="graficoProdutividade" style="width: 400px; height: 300px; display: inline-block;"></div>
    <div id="graficoTaxa" style="width: 400px; height: 300px; display: inline-block;"></div>
    <div id="graficoComparativo" style="width: 800px; height: 400px; margin: 0 auto;"></div>
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
            </tr>
        </thead>
        <tbody>
            <?php
                $linha = 0;
                while (($user_data = mysqli_fetch_assoc($result)) && $linha < 100) {
                    $linhaClasse = $linha % 2 == 0 ? 'linha-par' : 'linha-impar'; // Adicione classes alternadas
                    echo "<tr class='$linhaClasse'>";
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
                    echo "</tr>";
                    $linha++;
                }
            ?>
        </tbody>
    </table>
</div>
<?php
// Consulta SQL base
$sql = "SELECT * FROM produto WHERE 1=1";

// Adicionar filtros à consulta SQL
if (!empty($busca1)) {
    $sql .= " AND cidade LIKE '%$busca1%'";
}

if (!empty($busca2)) {
    $sql .= " AND uf LIKE '%$busca2%'";
}

if (!empty($busca3)) {
    $sql .= " AND seguradora LIKE '%$busca3%'";
}

if (!empty($busca4)) {
    $sql .= " AND Safra LIKE '%$busca4%'";
}

// Adicionar ordenação
$sql .= " ORDER BY id DESC";

// Adicione a limitação de linhas
$sql .= " LIMIT 100";

// Executar a consulta
$result = $conecta->query($sql);

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    function limparFiltros() {
        document.getElementById('cidade').value = '';
        document.getElementById('uf').value = '';
        document.getElementById('seguradora').value = '';
        document.getElementById('safra').value = '';
        document.getElementById('filtroForm').submit();
    }

    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(desenharGraficos);

//Gráficos de Barras//

    function desenharGraficos() {
    var dataProdutividade = new google.visualization.DataTable();
    dataProdutividade.addColumn('string', 'Produto');
    dataProdutividade.addColumn('number', 'Produtividade Esperada');
    dataProdutividade.addColumn({ type: 'string', role: 'annotation' }); // Adicione esta linha para rótulos
    
    var dataComparativo = new google.visualization.DataTable();
    dataComparativo.addColumn('string', 'Produto');
    dataComparativo.addColumn('number', 'Produtividade Esperada');
    dataComparativo.addColumn('number', 'Taxa');
    

    var dataTaxa = new google.visualization.DataTable();
    dataTaxa.addColumn('string', 'Produto');
    dataTaxa.addColumn('number', 'Taxa');
    dataTaxa.addColumn({ type: 'string', role: 'annotation' }); // Adicione esta linha para rótulos

    <?php
   while ($user_data = mysqli_fetch_assoc($result)) {
    $produto = $user_data['nomedoproduto'];
    $taxa = str_replace(',', '.', str_replace('%', '', $user_data['taxa'])); // Remova a vírgula, substitua o ponto por vírgula e remova o símbolo de porcentagem
    $produtividadeEsperada = (float) $user_data['prodesperada'];
    $taxaLabel = $user_data['taxa']; // Rótulo para a taxa
    $produtividadeEsperadaLabel = $user_data['prodesperada']; // Rótulo para a produtividade esperada

    echo "dataProdutividade.addRow(['$produto', $produtividadeEsperada, '$produtividadeEsperadaLabel']);";
    echo "dataTaxa.addRow(['$produto', $taxa, '$taxaLabel']);";
    echo "dataComparativo.addRow(['$produto', $produtividadeEsperada, $taxa]);";
}
        ?>

        var optionsProdutividade = {
            title: 'Produtividade Esperada por Produto',
            hAxis: {title: 'Produto'},
            vAxis: {title: 'Produtividade'},
            bars: 'horizontal'
        };

        var optionsTaxa = {
            title: 'Taxa por Produto',
            hAxis: {title: 'Produto'},
            vAxis: {title: 'Taxa (%)'}, // Adicionar a unidade de porcentagem
            bars: 'horizontal'
        };

        var optionsComparativo = {
        title: 'Comparação entre Produtividade Esperada e Taxa',
        hAxis: { title: 'Produto' },
        vAxis: { title: 'Valor' },
        curveType: 'function',
        series: {
            0: { color: 'blue' }, // Cor para a Produtividade Esperada
            1: { color: 'red' }   // Cor para a Taxa
        }
    };

        var chartProdutividade = new google.visualization.BarChart(document.getElementById('graficoProdutividade'));
        chartProdutividade.draw(dataProdutividade, optionsProdutividade);

        var chartTaxa = new google.visualization.BarChart(document.getElementById('graficoTaxa'));
        chartTaxa.draw(dataTaxa, optionsTaxa);

        var chartComparativo = new google.visualization.LineChart(document.getElementById('graficoComparativo'));
        chartComparativo.draw(dataComparativo, optionsComparativo);
    }
    
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(desenharGraficos);
</script>

</body>
</html>
<?php
else: header("Location: login.php"); endif;
?>