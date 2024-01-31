<?php
include('cabecalho.php');
include('conectadb.php');


// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['editar_usuario'])) {
    // Coletando os dados do formulário
    $id = $_POST['id'];
    $login = $_POST['novo_login'];
    $email = $_POST['novo_email'];
    $senha = $_POST['nova_senha'];
    $status = $_POST['novo_status'];

    // Executando a consulta SQL de atualização
    $sql = "UPDATE usuarios SET usu_login = '$login', usu_email = '$email', usu_senha = '$senha', usu_status = '$status' WHERE usu_id = '$id'";
    $resultado = mysqli_query($link, $sql);

    if ($resultado) {
        echo "Atualização realizada com sucesso!";
    } else {
        echo "Erro na atualização: " . mysqli_error($link);
    }
}

$sql = "SELECT usu_id, usu_login, usu_senha, usu_email, usu_status FROM usuarios WHERE usu_status = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = "s";

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : 's';
     if($ativo == 's'){
        $sql = "SELECT usu_id, usu_login, usu_senha, usu_email, usu_status FROM usuarios 
        WHERE usu_status = 's'";
        $retorno = mysqli_query($link, $sql);
     }
     else if($ativo == "todos"){
        $sql = "SELECT usu_id, usu_login, usu_senha, usu_email, usu_status FROM usuarios";
        $retorno = mysqli_query($link, $sql);
     }
     else{
        $sql = "SELECT usu_id, usu_login, usu_senha, usu_email, usu_status FROM usuarios 
        WHERE usu_status = 'n'";
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
    <title>LISTA USUARIO</title>
</head>
<body>
<div class='container'>
        <form action="listausuario.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()"<?= $ativo == 's'?"checked":""?>> ATIVOS
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()"<?= $ativo == 'n'?"checked":""?>> INATIVOS
            <input type="radio" name="ativo" class="radio" value="todos" required onclick="submit()"<?= $ativo == 'todos'?"checked":""?>> TODOS

        </form>
        <table border="2">
            <tr>
                <th>ID</th>
                <th>LOGIN</th>
                <th>SENHA</th>
                <th>EMAIL</th>
                <th>STATUS</th>
                <th>ALTERA</th>
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
        <td><a href="alterausuario.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR"></td>
    </tr>
<?php
}
?>
</table>
    </div>
</body>
</html>

