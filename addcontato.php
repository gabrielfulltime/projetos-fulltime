<?php
$nome = $_POST["nome"];
$email = $_POST["email"];
if ((empty($nome)) or (empty($email)) ) {
    die("<script>
    alert('Falha ao salvar pois O campo de nome e/ou de email está/ão vazio/os');
    location = './lista-contatos.php';
    </script>");
}
$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli
$sql = "INSERT INTO contatos (id, nome, email) VALUES (DEFAULT, '$nome', '$email');";
if ($con->connect_error) {
    die("<script>
        alert('Conexão falhou');
        location='./lista-contatos.php'; 
        </script>");
}
if ($con->query($sql) === true){
    echo "<script>
    alert('Salvado com sucesso');
    location = './lista-contatos.php';
    </script>";
} else {
    echo"<script>
    alert('Falha ao salvar');
    location = './lista-contatos.php';
    </script>";
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
  