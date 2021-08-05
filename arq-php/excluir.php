<?php
include("conexao.php");
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

$sql = "DELETE FROM contatos WHERE id = '$id';";

$queryRealizada = (($con->query($sql) == true) and ($con->error == "") and $con->affected_rows > 0);
if ($queryRealizada) {
    http_response_code(204);
    return false;
}
http_response_code(409);

$con->close();