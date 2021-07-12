<?php
?>
<?php
$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli
$busc = isset($_GET['busc']) ? $_GET['busc'] : '';
if ($con->connect_error) {
    die("<script>
        alert('Conexão falhou');
        location='./lista-de-contatos.php'; </script>");
}
$sql = "SELECT * FROM contatos 
    WHERE nome LIKE '%$busc%' OR email LIKE '%$busc%'
    ORDER BY nome, email";
$result = $con->query($sql);



?>


<!DOCTYPE html>
<html>

<head>

    <title>Lista de Contato</title>
    <meta charset="UTF-8">
    <meta name="author" content="Beatriz, João, Paula">
    <meta name="description" content="Lista de contatos com nome e email." />
    <meta name="keywords" content="Lista, Contatos, Lista de Contatos" />
    <link rel="stylesheet" href="css-salvar.css">
</head>

<body>

    <header>
        <h1>Lista de Contato</h1>

        <div id="barra_pesquisa">
            <form action="lista-de-contatos.php" method="GET">
                <label for="busc"></label>
                <input type="search" name="busc" id="txtBusca" placeholder="Buscar Contato">
                <button type="submit" id="pesquisa">Pesquisar</button>
            </form>
        </div>
    </header>
    <article>
        <section id="sec_adicionar">

            <form action="addcontato.php" method="POST" class="add">

                <h3>Adicionar contato</h3>

                <label for="nome" class="lbl_add">Nome:</label><br>
                <input type="text" name="nome" id="input_name" class="add" placeholder="Seu nome">
                <br>
                <label for="email" class="lbl_add">Email:</label><br>
                <input type="email" name="email" class="add" placeholder="exemplo@email.com">

                <button type="submit" class="see" id="salvar">Salvar</button>

            </form>
        </section>

        <section id="sec_tabela">
            <div id="tabela">

                <table>

                    <thead>
                        <tr>

                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Funções</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        if ($result->num_rows > 0) {


                            while ($linha = $result->fetch_array()) { ?>

                                <tr>
                                    <td> <?php echo  $linha["nome"]; ?> </td>
                                    <td> <?php echo  $linha["email"]; ?> </td>
                                    <td>
                                        <a href="altera-contatos.php?id=<?php echo $linha['id']?>"><button class='editar'>Editar</button></a>
                                        <a href="excluir.php?id=<?php echo $linha['id']?>"><button class='excluir'>Excluir</button></a>
                                    </td>
                                </tr>

                        <?php }
                        } else {
                            echo "0 Resultados";
                        }


                        $con->close();

                        ?>


                    </tbody>
                </table>
            </div>



        </section>

    </article>
    <footer>
        <p>Creditos</p>
        <p>Creditos</p>
        <p>Creditos</p>
    </footer>

</body>

</html>