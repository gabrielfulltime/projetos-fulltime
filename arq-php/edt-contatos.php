<?php
$data = json_decode(file_get_contents("php://input"));

$id = $data->id;
$nome = $data->nome ;
$email = $data->email;

$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli 
if ($con->connect_error) {
    die($con->connect_error);
}
$sql = "UPDATE contatos
    SET email = '$email',
    nome = '$nome'
    WHERE id = '$id';
    ";

$queryRealizada = ((($con->query($sql) == true) and ($con->error == "")) and $con->affected_rows > 0);
if ($queryRealizada) {
    http_response_code(200);
    return false;
} elseif ($con->errno) {
    http_response_code(204);
    return false;
}

http_response_code(409);

$con->close();
