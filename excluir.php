<?php
$id = $_GET['id'];
$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli

$sql = "DELETE FROM contatos WHERE id = '$id';";

if ($con->connect_error) {
    die("<script>
            alert('Erro ao excluir este contato');
            location='./lista-de-contatos.php'; 
        </script>");
}

$result = $con->query($sql);

echo "<script>
            alert('Excluido com sucesso')
            location = './lista-de-contatos.php';
      </script>;";
