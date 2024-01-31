<?php
include("conectadb.php");
include("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $senha =$_POST['senha'];
    $login = $_POST['login'];
    
    $key = RAND(100000,999999);

    #INSERIR INSTRUÇÕES NO BANCO
    $sql = "SELECT COUNT(usu_id) FROM usuarios
    WHERE usu_email = '$email' OR usu_login = '$login'";
    $resultado = mysqli_query($link, $sql);
    $resultado = mysqli_fetch_array($resultado) [0];
    ##GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
        VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
    #VERIFICA SE EXISTE
    if($resultado >= 1){
        echo"<script>window.alert('EMAIL EXISTENTE');</script>";
        echo"<script>window.location.href='login.html';</script>";

    }
    else{
        $sql = "INSERT INTO usuarios
        (usu_login, usu_senha, usu_status, usu_key, usu_email)
        VALUES ('$login','$senha', 's', '$key', '$email')";
        mysqli_query($link, $sql);
        ##GRAVA LOG
        $sql ='"'.$sql.'"';
        $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
            VALUES ($sql, NOW())";
        mysqli_query($link, $sqllog);
        echo"<script>window.alert('USUARIO CADASTRADO');</script>";
        echo"<script>window.location.href='login.html';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>CADASTRA USUARIO</title>
</head>
<body>
    <div id="container">
        <form action="cadastrausuario.php" method="post">
        <label>LOGIN</label>
        <input type="text" name='login' id="login"></input>

        <label>EMAIL</label>
        <input type="email"  name='email' id="@gmail.com"></input>

        <label>SENHA</label>
        <input type="password" name="senha" id="senha" placeholder="*****" required/>

        <input type="submit" name="cadastrar" value="CADASTRAR"></input>
        </form>
    </div>
    
</body>
</html>