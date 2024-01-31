<?php
include('cabecalho.php');
include('conectadb.php');


// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['editar_cliente'])) {
    // Coletando os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['novo_nome'];
    $email = $_POST['novo_email'];
    $telefone = $_POST['novo_telefone'];
    $cpf = $_POST['novo_cpf'];
    $curso = $_POST['novo_curso'];
    $sala = $_POST['nova_sala'];
    $status = $_POST['novo_status'];
    $saldo = $_POST['novo_saldo'];

    // Executando a consulta SQL de atualização
    $sql = "UPDATE clientes SET cli_nome = '$nome', cli_email = '$email', cli_telefone = '$telefone', cli_cpf = '$cpf', cli_curso = '$curso', cli_sala = '$sala', cli_status = '$status', cli_saldo = '$saldo'  WHERE cli_id = '$id'";
    $resultado = mysqli_query($link, $sql);

    if ($resultado) {
        echo "Atualização realizada com sucesso!";
    } else {
        echo "Erro na atualização: " . mysqli_error($link);
    }
}

$sql = "SELECT cli_id, cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo  FROM clientes WHERE cli_status = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = "s";

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : 's';
     if($ativo == 's'){
        $sql = "SELECT cli_id, cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo FROM clientes 
        WHERE cli_status = 's'";
        $retorno = mysqli_query($link, $sql);
     }
     else if($ativo == "todos"){
        $sql = "SELECT cli_id, cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo FROM clientes";
        $retorno = mysqli_query($link, $sql);
     }
     else{
        $sql = "SELECT cli_id, cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo FROM clientes 
        WHERE cli_status = 'n'";
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
    <title>LISTA CLIENTE</title>
</head>
<body>
<div class='container'>
        <form action="listacliente.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()"<?= $ativo == 's'?"checked":""?>> ATIVOS
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()"<?= $ativo == 'n'?"checked":""?>> INATIVOS
            <input type="radio" name="ativo" class="radio" value="todos" required onclick="submit()"<?= $ativo == 'todos'?"checked":""?>> TODOS

        </form>
        <table border="2">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>CPF</th>
                <th>CURSO</th>
                <th>SALA</th>
                <th>STATUS</th>
                <th>SALDO</th>
                <th>ALTERAR</th>
            </tr>
            <?php
while ($tbl = mysqli_fetch_array($retorno)) {
?>
    <tr>
        <td><?= $tbl[0] ?></td>
        <td><?= $tbl[1] ?></td>
        <td><?= $tbl[2] ?></td>
        <td><?= $tbl[3] ?></td>
        <td><?= $tbl[4] ?></td>
        <td><?= $tbl[5] ?></td>
        <td><?= $tbl[6] ?></td>
        <td><?= $tbl[7] ?></td>
        <td><?= number_format($tbl[8], 2, ',', '.') ?></td>
        <td><a href="alteracliente.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR"></td>
    </tr>
<?php
}
?>
</table>
    </div>
</body>
</html>

