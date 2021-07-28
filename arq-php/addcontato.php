<?php


// Teste de dados Json  
// header("Content-type: text/html; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

$nome = $data->nome;
$email = $data->email;

// Dê include em conexão.php
include("conexao.php");
$sql = "INSERT INTO contatos (id, nome, email) VALUES (DEFAULT, '$nome', '$email');";
if ($con->connect_error) {
    die($con->connect_error);
}
if ($con->query($sql) === true) {
    die("Salvo com sucesso $nome e $email");
} else {
    die("Erro ao salvar");
}

$con->close();

?>













<?php
/* //Recebimento das informações do formulario atraves do método post e as alocando em variáveis
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    
    //Estabelecendo uma conexão com o Mysql
    $con = mysqli_connect('localhost:3306', 'root', '', 'cadastro') or die("Erro ao salvar informações inseridas");
    $sql = "INSERT INTO contatos VALUES ( DEFAULT,'$nome', '$email');";

    //A função mysqli_query recebe 2 parametros. O primeiro é para conexão e o segundo para comandos no sql
    mysqli_query($con, $sql) or die ("Erro ao conectar e cadastrar o registro");
    
    //A função mysqli_close recebe um parametro que é a conexão sql e a fecha
    mysqli_close($con);
    

    echo "<script>
    alert('Cadastro de contato realizado com sucesso');
    location='./salvarContatos.php'; </script>"; */

?>
  