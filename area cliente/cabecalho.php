<?php 
include("conectadb.php");
session_start();
isset($_SESSION['nomecliente'])?$nomecliente = $_SESSION['nomecliente']: "";
$nomecliente = $_SESSION['nomecliente'];
?>


<div>
    <ul class="menu">
        <li><a href="cadastrausuario.php">CADASTRAR USUARIO</a></li>
        <li><a href="listausuario.php">LISTAR USUARIO</a></li>
        <li><a href="cadastraproduto.php">CADASTRAR PRODUTO</a></li>
        <li><a href="listaproduto.php">LISTAR PRODUTO</a></li>
        <li><a href="cadastracliente.php">CADASTRAR CLIENTE</a></li>
        <li><a href="listacliente.php">LISTAR CLIENTES</a></li>
        <li><a href="fornecedor.php">FORNECEDOR</a></li>
        <li><a href="encomendas.php">ENCOMENDAS</a></li>
        

        <li class="menuloja"><a href="logout.php">SAIR</a></li>

        <?php 
        if($nomecliente != null) {
        ?>
        <li class="profile">OLÁ <?=strtoupper($nomecliente) ?></li>
        <?php
        } else {
            echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO')
            window.location.href='login.html';</script>";
        }
        ?>
    </ul>
</div>