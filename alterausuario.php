<?php
include('cabecalho.php');
include('conectadb.php');

// Coletando os dados passados via GET
$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE usu_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $login = $tbl[1];
    $email = $tbl[5];
    $senha = $tbl[2];
    $status = $tbl[3];

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>ALTERA USUÁRIO</title>
</head>

<body>
    <div class='container'>
        <form action="listausuario.php" method="post">
            <!-- Adicione um campo hidden para enviar o ID do usuário -->
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="novo_login">NOVO LOGIN:</label>
            <input type="text" name="novo_login" value="<?= $login ?>" required>

            <label for="novo_email">NOVO EMAIL:</label>
            <input type="text" name="novo_email" value="<?= $email ?>" required>

            <label for="nova_senha">NOVA SENHA:</label>
            <input type="password" name="nova_senha" value="<?= $senha ?>" required>

            <label for="novo_status">NOVO STATUS:</label>
            <select name="novo_status" required>
                <option value="s" <?= ($status == 's') ? 'selected' : '' ?>>Ativo</option>
                <option value="n" <?= ($status == 'n') ? 'selected' : '' ?>>Inativo</option>
            </select>

            <input type="submit" name="editar_usuario" value="Salvar Alterações">
        </form>
    </div>
</body>

</html>
