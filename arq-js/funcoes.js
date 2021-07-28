function excluirContato(numId, nomeContato, emailContato) {
    confirmacao = confirm("Voce tem certeza que deseja excluir o contato? \n( id: " + numId + ", nome: " + nomeContato + ", email: " + emailContato + ")")
    if (!confirmacao) {
        alert("Operação cancelada")
    } else { // Dentro do else é o código para exclusão

        // Criando um Json com o id para que esse seja acessado pela API
        let inform = {
            "id": numId
        }
        let data = JSON.stringify(inform);
        excluir(data)
    } // Fim código exclusão

}
function excluir(idJson) {
    let url = "http://127.0.0.1:8080/lista-testes/arq-php/excluir.php";
    let request = new XMLHttpRequest();

    request.open("DELETE", url);

    request.setRequestHeader("Content-type", "application/json");
    request.send(idJson);

    request.onload = function () {
        resposta = request.response;
        alert(resposta);
        location.reload()
    }

}
