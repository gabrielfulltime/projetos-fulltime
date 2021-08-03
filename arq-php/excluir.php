<?php
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli

$sql = "DELETE FROM contatos WHERE id = '$id';";


$queryRealizada = (($con->query($sql) == true) and ($con->error == "") and $con->affected_rows > 0);
if ($queryRealizada) {
    http_response_code(204);
    return false;
}
http_response_code(409);

$con->close();

