<?php
$data = json_decode(file_get_contents("php://input"));
$testeConteudo = isset($data->busca) ? true : false;
if ($testeConteudo) {
    $data = json_decode(file_get_contents("php://input"));
    $busc = $data->busca;
} else {
    $busc = '';
}
