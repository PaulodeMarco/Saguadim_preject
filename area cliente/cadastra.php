<?php
include("conectadb.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $telefone = $_POST['number'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $sala = $_POST['sala'];
    
    
    
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
        echo "<script>window.location.href='login.html';</script>";
    }
    else{
        $sql = "INSERT INTO clientes
        (cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status)
        VALUES ('$nome','$email', '$telefone', '$cpf', '$curso', '$sala', 's')";
        mysqli_query($link, $sql);
        ##GRAVA LOG
        $sql ='"'.$sql.'"';
        $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
            VALUES ($sql, NOW())";
        mysqli_query($link, $sqllog);
        echo"<script>window.alert('CLIENTE CADASTRADO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
}
?>
