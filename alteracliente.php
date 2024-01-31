<?php
include('cabecalho.php');
include('conectadb.php');

// Coletando os dados passados via GET
$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1];
    $email = $tbl[2];
    $telefone = $tbl[3];
    $cpf = $tbl[4];
    $curso = $tbl[5];
    $sala = $tbl[6];
    $status = $tbl[7];
    $saldo = $tbl[8];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>ALTERA CLIENTE</title>
</head>

<body>
    <div class='container'>
        <form action="listacliente.php" method="post">
            <!-- Adicione um campo hidden para enviar o ID do usuário -->
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="novo_nome">NOVO NOME:</label>
            <input type="text" name="novo_nome" value="<?= $nome ?>" required>

            <label for="novo_email">NOVO EMAIL:</label>
            <input type="text" name="novo_email" value="<?= $email ?>" required>

            <label for="novo_telefone">NOVO TElEFONE:</label>
            <input type="text" name="novo_telefone" value="<?= $telefone ?>" required>
            
            <label for="novo_cpf">NOVO CPF:</label>
            <input type="text" name="novo_cpf" value="<?= $cpf ?>" required>

            <label for="novo_curso">NOVO CURSO:</label>
            <input type="text" name="novo_curso" value="<?= $curso ?>" required>

            <label for="nova_sala">NOVA SALA:</label>
            <input type="text" name="nova_sala" value="<?= $sala ?>" required>

            <label for="novo_saldo">NOVO SALDO:</label>
            <input type="text" name="novo_saldo" value="<?= $saldo ?>" required>

            <label for="novo_status">NOVO STATUS:</label>
            <select name="novo_status" required>
                <option value="s" <?= ($status == 's') ? 'selected' : '' ?>>Ativo</option>
                <option value="n" <?= ($status == 'n') ? 'selected' : '' ?>>Inativo</option>
            </select>

            <input type="submit" name="editar_cliente" value="Salvar Alterações">
        </form>
    </div>
</body>

</html>
