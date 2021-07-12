<?php
$id = $_GET['id'];
$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli
$sql = "SELECT nome, email FROM contatos WHERE id = '$id'";
$result = $con->query($sql);
$linha = $result->fetch_array();
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
            justify-content: center;
            align-items: center;
        }

        #antigo {
            display: grid;
            text-align: center;
            font-weight: bold;
            font-size: larger;
        
        }

        #form {
            border: 3px solid black;
            font-size: larger;
            text-align: center;
            border-radius: 5px;
        }

        #salvar {
            border-color: green;
            background-color: rgb(208, 255, 208);
            width: 150px;
            margin: 5px auto 5px auto;
            height: 25px;
            border-radius: 5px;
            cursor: pointer;

        }

        #salvar:hover {
            background-color: rgb(226, 255, 226);
        }
        input {
            border-radius: 5px;
            margin: 5px auto 5px;
            height: 25px;

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
            <form action="edt-contatos.php?id=<?php echo $id; ?>" method="POST" class="add">

                <h3>Editando um contato</h3>

                <label for="nome" class="lbl_add">Novo Nome:</label><br>
                <input type="text" name="nome" id="input_name" class="add" value="<?php echo $linha['nome']; ?>">
                <br>
                <label for="email" class="lbl_add">Novo Email:</label><br>
                <input type="email" name="email" class="add" value="<?php echo  $linha['email']; ?>">
                <br>
                <button type="submit" class="edit" id="salvar">Salvar</button>

            </form>
        </div>
    </div>
</body>

</html>