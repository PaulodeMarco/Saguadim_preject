<?php
include('cabecalho.php');
include('conectadb.php');

// Coletando os dados passados via GET
$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1];
    $descricao = $tbl[2];
    $custo = $tbl[3];
    $preco = $tbl[4];
    $quantidade = $tbl[5];
    $status = $tbl[6];

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>ALTERA PRODUTOS</title>
</head>

<body>
    <div class='container'>
        <form action="listaproduto.php" method="post">
            <!-- Adicione um campo hidden para enviar o ID do usuário -->
            <input type="hidden" name="id" value="<?= $id ?>">

            <label for="novo_nome">NOME:</label>
            <input type="text" name="novo_nome" value="<?= $nome ?>" required>

            <label for="nova_descricao">DESCRICAO:</label>
            <input type="text" name="nova_descricao" value="<?= $descricao ?>" required>

            <label for="novo_custo">CUSTO:</label>
            <input type="text" name="novo_custo" value="<?= $custo ?>" required>

            <label for="novo_preco">PRECO:</label>
            <input type="text" name="novo_preco" value="<?= $preco ?>" required>

            <label for="nova_quantidade">QUANTIDADE:</label>
            <input type="text" name="nova_quantidade" value="<?= $quantidade ?>" required>

            <label for="novo_status">NOVO STATUS:</label>
            <select name="novo_status" required>
                <option value="s" <?= ($status == 's') ? 'selected' : '' ?>>Ativo</option>
                <option value="n" <?= ($status == 'n') ? 'selected' : '' ?>>Inativo</option>
            </select>

            <input type="submit" name="editar_produto" value="Salvar Alterações">
        </form>
    </div>
</body>

</html>
