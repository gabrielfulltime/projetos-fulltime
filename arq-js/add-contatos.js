function addContatos() {
    // Pegando dados do html 
    let nome = document.getElementById("input_name")
    let email = document.getElementById("input_email")
    let inform = {
        "nome": nome.value,
        "email": email.value
    }
    let data = JSON.stringify(inform)

    // Criando um objeto XMLHttpRequest
    let url = "http://127.0.0.1:8080/lista-testes/arq-php/addcontato.php"
    let request = new XMLHttpRequest();

    //Abertura da conexão
    request.open("POST", url)

    // Cabeçalho
    request.setRequestHeader("Content-type", "application/json")

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {

            // Print received data from server
            alert("Conexão estabelecida com sucesso");
        }
    }
    request.send(data)
    location.reload()
}