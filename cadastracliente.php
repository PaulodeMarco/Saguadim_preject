<?php
include("conectadb.php");
include("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $telefone = $_POST['number'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $sala = $_POST['sala'];
    $saldo = $_POST['saldo'];
    
    
    
    $key = RAND(100000,999999);

    #INSERIR INSTRUÇÕES NO BANCO
    $sql = "SELECT COUNT(cli_id) FROM clientes
    WHERE cli_email = '$email' OR cli_cpf = '$cpf'";
    $resultado = mysqli_query($link, $sql);
    $resultado = mysqli_fetch_array($resultado) [0];
    ##GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
        VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
    #VERIFICA SE EXISTE
    if($resultado >= 1){
        echo"<script>window.alert('CONTA EXISTENTE');</script>";
    }
    else{
        $sql = "INSERT INTO clientes
        (cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo)
        VALUES ('$nome','$email', '$telefone', '$cpf', '$curso', '$sala', 's', '$saldo')";
        mysqli_query($link, $sql);
        ##GRAVA LOG
        $sql ='"'.$sql.'"';
        $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
            VALUES ($sql, NOW())";
        mysqli_query($link, $sqllog);
        echo"<script>window.alert('CLIENTE CADASTRADO');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>CADASTRA CLIENTE</title>
</head>
<body>
    <div id="container">
        <form action="cadastracliente.php" method="post">
        <label>NOME</label>
        <input type="text" name='name' id="name" placeholder="Nome Completo" required/>

        <label>EMAIL</label>
        <input type="email"  name='email' id="email" placeholder="@gmail.com" required/>

        <label>TELEFONE</label>
        <input type="text" name="number" id="number" placeholder="(DDD) 0000-0000" required/>

        <label>CPF</label>
        <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" required/>

        <label>CURSO</label>
        <input type="text" name="curso" id="curso" placeholder="" required/>

        <label>SALA</label>
        <input type="text" name="sala" id="sala" placeholder="" required/>

        <label>SALDO</label>
        <input type="text" name="saldo" id="saldo" placeholder="R$" required/>

        <input type="submit" name="cadastrar" value="CADASTRAR"></input>
        </form>
    </div>
    
</body>
</html>