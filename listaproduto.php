<?php
include('cabecalho.php');
include('conectadb.php');


// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['editar_produto'])) {
    // Coletando os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['novo_nome'];
    $descricao = $_POST['nova_descricao'];
    $custo = $_POST['novo_custo'];
    $preco = $_POST['novo_preco'];
    $quantidade = $_POST['nova_quantidade'];
    $status = $_POST['novo_status'];

    // Executando a consulta SQL de atualização
    $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descricao = '$descricao', pro_custo = '$custo', pro_preco = '$preco', pro_quantidade = '$quantidade', pro_status = '$status' WHERE pro_id = '$id'";
    $resultado = mysqli_query($link, $sql);

    if ($resultado) {
        echo "Atualização realizada com sucesso!";
    } else {
        echo "Erro na atualização: " . mysqli_error($link);
    }
}

$sql = "SELECT pro_id, pro_nome, pro_descricao, pro_custo, pro_preco, pro_quantidade, pro_status FROM produtos WHERE pro_status = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = "s";

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : 's';
     if($ativo == 's'){
        $sql = "SELECT pro_id, pro_nome, pro_descricao, pro_custo, pro_preco, pro_quantidade, pro_status FROM produtos 
        WHERE pro_status = 's'";
        $retorno = mysqli_query($link, $sql);
     }
     else if($ativo == "todos"){
        $sql = "SELECT pro_id, pro_nome, pro_descricao, pro_custo, pro_preco, pro_quantidade, pro_status FROM produtos";
        $retorno = mysqli_query($link, $sql);
     }
     else{
        $sql = "SELECT pro_id, pro_nome, pro_descricao, pro_custo, pro_preco, pro_quantidade, pro_status FROM produtos 
        WHERE pro_status = 'n'";
        $retorno = mysqli_query($link, $sql);
     }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>LISTA PRODUTOS</title>
</head>
<body>
    <div class='container'>
        <form action="listaproduto.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()"<?= $ativo == 's'?"checked":""?>> ATIVOS
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()"<?= $ativo == 'n'?"checked":""?>> INATIVOS
            <input type="radio" name="ativo" class="radio" value="todos" required onclick="submit()"<?= $ativo == 'todos'?"checked":""?>> TODOS

        </form>
        <table border="2">
            <tr>
                <th>NOME</th>
                <th>DESCRIÇÃO</th>
                <th>CUSTO</th>
                <th>PREÇO</th>
                <th>QUANTIDADE</th>
                <th>STATUS</th>
                <th>ALTERAR</th> 
            </tr>
            <!-- TRAZENDO DADOS DA TABELA -->
        <?php
            while($tbl = mysqli_fetch_array($retorno)){
            ?>
        <tr>
        <td><?= $tbl[1] ?></td> <!--COLETA NOME DA QUERY-->
        <td><?= $tbl[2] ?></td>
        <td><?= number_format($tbl[3], 2, ',', '.') ?></td>
        <td><?= number_format($tbl[4], 2, ',', '.') ?></td>
        <td><?= $tbl[5] ?></td>
        <td><?= $tbl[6] ?></td>
        <td><a href="alteraproduto.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR"></a></td>
        
    </tr>
        <?php
            }
        ?>
        </table>
    </div>
    
</body>
</html>