<?php
session_start();
set_time_limit(0);
ob_start();

$localhost="localhost";
$user="root";
$passw="";
$banco="comparativo";

$conecta = mysqli_connect($localhost, $user, $passw, $banco);
mysqli_set_charset($conecta, "utf8");

$file = $_FILES['file'];
//var_dump($file);

$primeira_linha = true;
$linhas_importadas = 0;
$linhas_nao_importadas = 0;
$produtos_nao_importados = "";

if ($file['type'] == "text/csv") {
    $dados_arquivo = fopen($file['tmp_name'], "r");

    while ($linha = fgetcsv($dados_arquivo, 1000, ";")) {

        if ($primeira_linha) {
            $primeira_linha = false;
            continue;
        }

        array_walk_recursive($linha, 'converter');
        //var_dump($linha);

        $query_usuario = "INSERT INTO produto (nomedoproduto, seguradora, tipo, cobertura, datadecriacao, cidade, uf, prodesperada, taxa, Safra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $cad_usuario = $conecta->prepare($query_usuario);

        // Verifique se a preparação da consulta foi bem-sucedida
        if ($cad_usuario) {
            $nomedoproduto = $linha[0] ?? null;
            $seguradora = $linha[1] ?? null;
            $tipo = $linha[2] ?? null;
            $cobertura = $linha[3] ?? null;
            $datadecriacao = $linha[4] ?? null;
            $cidade = $linha[5] ?? null;
            $uf = $linha[6] ?? null;
            $prodesperada = $linha[7] ?? null;
            $taxa = $linha[8] ?? null;
            $Safra = $linha[9] ?? null;
            
            $cad_usuario->bind_param('ssssssssss', $nomedoproduto, $seguradora, $tipo, $cobertura, $datadecriacao, $cidade, $uf, $prodesperada, $taxa, $Safra);
            $cad_usuario->execute();

            if ($cad_usuario->affected_rows > 0) {
                $linhas_importadas++;
                echo "Inclusão bem-sucedida: $conecta->error<br>";
                echo '<a href="produto.php"><button>Voltar para produtos</button></a>';
                sleep(2);

            } else {
                $linhas_nao_importadas++;
                $produtos_nao_importados .= "," . ($linha[0] ?? "NULL");
                echo "$conecta->error<br>";
                echo '<a href="produto.php"><button>Voltar para produtos</button></a>';
                sleep(2);
            }

            $cad_usuario->close(); // Feche a declaração preparada após o uso
        } else {
            // Tratamento de erro se a preparação da consulta falhar
            echo "Erro na preparação da consulta: " . $conecta->error;
            sleep(2);
            echo '<a href="produto.php"><button>Voltar para produtos</button></a>';
        }
    }

    if (!empty($produtos_nao_importados)) {
        $produtos_nao_importados = "Usuários não importados: $produtos_nao_importados.";
    }

    fclose($dados_arquivo); // Feche o arquivo CSV após o uso

   /*$_SESSION['msg'] = "<p style='color: green;'>$linhas_importadas linha(s) importa(s), $linhas_nao_importadas linha(s) não importada(s). $produtos_nao_importados</p>";

    header("Location: index.php");
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Necessário enviar arquivo CSV!</p>";
    header("Location: index.php");*/
}
function converter(&$dados_arquivo)
{
    // Converter dados de ISO-8859-1 para UTF-8
    $dados_arquivo = mb_convert_encoding($dados_arquivo, "UTF-8", "ISO-8859-1");
}
?>