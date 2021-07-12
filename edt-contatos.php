<?php
$id = $_GET['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];

$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli 
if ($con->connect_error) {
    die("<script>
    alert('Conexão falhou');
    location='./lista-de-contatos.php'; </script>");
}
$sql = "UPDATE contatos
    SET email = '$email',
    nome = '$nome'
    WHERE id = '$id';
    ";

if ($con->query($sql) === true){
    echo "<script>
    alert('Editado com sucesso');
    location = './lista-de-contatos.php';
    </script>";
}else {
    echo"<script>
    alert('Falha ao Editar');
    location = './lista-de-contatos.php';
    </script>";
}

?>