<?php
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli

$sql = "DELETE FROM contatos WHERE id = '$id';";

if ($con->connect_error) {
    die("Erro ao excluir esse contato");
}

$result = $con->query($sql);

echo "Excluido com sucesso";


$con->close();

