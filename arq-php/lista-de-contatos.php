<?php
include("conexao.php");
// $busc = isset($_GET['busc']) ? $_GET['busc'] : '';
$data = json_decode(file_get_contents("php://input"));
$testeConteudo = isset($data->busca)? true : false;
if ($testeConteudo){
    $data = json_decode(file_get_contents("php://input"));
    $busc = $data->busca;
} else{
    $busc = '';
}
$sql = "SELECT * FROM contatos 
    WHERE nome LIKE '%$busc%' OR email LIKE '%$busc%'
    ORDER BY nome, email";
$result = $con->query($sql);


if ($result->num_rows > 0) {
    while ($linha = $result->fetch_array()) { ?>
        <tr>
            <td> <?php echo  $linha["nome"]; ?> </td>
            <td> <?php echo  $linha["email"]; ?> </td>
            <td>
                <a href="altera-contatos.php?id=<?php echo $linha['id'] ?>"><button class='editar'>Editar</button></a>
                <a href="excluir.php?id=<?php echo $linha['id'] ?>"><button class='excluir'>Excluir</button></a>
            </td>
        </tr>
<?php }
} else {
    echo "0 Resultados";
}
$con->close();
?>