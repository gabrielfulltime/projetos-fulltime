<?php
include("conexao.php");

// $data = json_decode(file_get_contents("php://input"));
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : "";
$id = isset($_GET['idCont']) ? $_GET['idCont'] : false;

$sql = " SELECT * FROM contatos";

// Realizar o select por id ou pelo nome/email
if ($id != false) {
    $sql .= " WHERE id = '$id'";
} else {
    $sql .= " WHERE nome like '%$pesquisa%' or email LIKE '%$pesquisa%'";
}
$sql .= " ORDER BY nome, email";

$result = $con->query($sql);

$contatos = ["contatos" => []];
$retornouLinhas = $result->num_rows > 0;
if ($retornouLinhas) {
    while ($linha = $result->fetch_array()) {
        $contatos["contatos"][] = $linha;
    }
    
}
echo json_encode($contatos);
file_put_contents("dados.json", json_encode($contatos));

