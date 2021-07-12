<?php
//Tra
$id = $_GET['id'];

$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli
$op = $_GET['op'];
if ($op == 'Excluir') {

    $sql = "DELETE FROM contatos WHERE id = '$id';";

    if ($con->connect_error) {
        die("<script>
        alert('Erro ao excluir este contato');
        location='./lista-contatos.php'; </script>");
    }

    $result = $con->query($sql);

    echo "<script>
        alert('Excluido com sucesso')
        location = './lista-contatos.php';
    </script>;";
}
if ($op == 'Editar') {
    $sql = "SELECT nome, email FROM contatos WHERE id = '$id'";
    $result = $con->query($sql);
    $linha = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        
        #sec_adicionar {
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
        }

        #antigo {
            display:grid;
            text-align: center;
            font-weight: bold;
            font-size: larger;
        }

        #form{ 
            border: 1px solid blue;
            font-size: larger;
            text-align: center;
        }

    </style>
</head>

<body>
    <div id='sec_adicionar'>
        <div id="antigo">
            <p>Nome antigo: <?php echo $linha['nome']; ?> </p>
            <p> Email antigo: <?php echo  $linha['email']; ?> </p>
        </div><br>
        <div id="form">
            <form action="edt-contatos.php" method="POST" class="add">

                <h3>Editando um contato</h3>

                <label for="nome" class="lbl_add">Novo Nome:</label><br>
                <input type="text" name="nome" id="input_name" class="add" value="<?php echo $linha['nome']; ?>">
                <br>
                <label for="email" class="lbl_add">Novo Email:</label><br>
                <input type="email" name="email" class="add" value="<?php echo  $linha['email']; ?>">
                <br>
                <input type="checkbox" name='id' value='<?php echo $id; ?>' hidden checked>
                <button type="submit" class="see" id="salvar">Salvar</button>

            </form>
        </div>
    </div>
</body>

</html>