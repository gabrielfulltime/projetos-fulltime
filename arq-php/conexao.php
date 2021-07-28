<?php
$con = new mysqli('localhost:3306', 'root', '', 'cadastro'); //Criando conexão com um objeto mysqli
if ($con->connect_error) {
    die($con->error);
}