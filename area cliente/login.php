<?php
#INICIA VARIAVEL DE SESSAO
session_start();

#INCLUI CODIGO DE CONEXÃO DO BANCO
include("conectadb.php");

#APÓS CLICK NO FORM POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    

    #QUERY DE VALIDA SE USUARIO EXISTE
    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email' AND cli_cpf = '$cpf'";
    $retorno = mysqli_query($link, $sql);
    
    #SUGESTÃO ARIEL DE SANITIZAÇÃO
    $retorno = mysqli_fetch_array($retorno) [0];

    ##GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
    VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);

    #SE USUARIO NÃO EXISTE LOGA, SE NÃO, NÃO LOGA
    if ($retorno == 0){
        echo"<script>window.alert('USUARIO INCORRETO');</script>";
        echo"<script>window.location.href='login.html';</script>";

    } else {
    $sql = "SELECT * FROM clientes WHERE cli_email ='$email' AND cli_cpf = '$cpf' AND cli_status = 'n'";
    $retorno = mysqli_query($link, $sql);

    ##GRAVA LOG
    $sqllog = '"' . $sql . '"';
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sqllog, NOW())";
    mysqli_query($link, $sqllog);

    if (mysqli_num_rows($retorno) > 0) {
        // O usuário está bloqueado
        echo "<script>window.alert('USUARIO BLOQUEADO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
        // O usuário não está bloqueado, continue com a verificação de status 's'
        $sql = "SELECT * FROM clientes WHERE cli_email = '$email' AND cli_cpf = '$cpf' AND cli_status = 's'";
        $retorno = mysqli_query($link, $sql);

        ##GRAVA LOG
        $sqllog = '"' . $sql . '"';
        $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sqllog, NOW())";
        mysqli_query($link, $sqllog);

        if (mysqli_num_rows($retorno) > 0) {
            // Usuário válido, proceda com o login
            while ($tbl = mysqli_fetch_array($retorno)) {
                $_SESSION['idcliente'] = $tbl[0];
                $_SESSION['nomecliente'] = $tbl[1];
            }
            echo "<script>window.location.href='backoffice.php';</script>";
        } 
    }
}
}
?>