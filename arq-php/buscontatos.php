
<?php

include("conexao.php");

header('Content-Type: application/json');
$sql = " SELECT * FROM contatos ";
$sql .= "WHERE nome like '%%' or email LIKE '%%'";
$sql .= "ORDER BY nome, email";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    $contatos =   '{"contatos":[';

    $coloqvirg = false;

    while ($linha = $result->fetch_array()) {
        if ($coloqvirg) {
            $contatos .= ',';
        }
        $contatos .= '{"nome":"' . $linha['nome'] . '", "email": "' . $linha['email'] . '", "id": ' . $linha['id'] . '}';
        $coloqvirg = true;
    }
    $contatos .= "]}";
    json_encode($contatos);
    echo $contatos;
    file_put_contents("dados.json", ($contatos));
}


 /*WHERE nome LIKE '%$busc%' OR email LIKE '%$busc%'*/
