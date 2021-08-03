window.onload = function () {
    trazerContatos();
    var btnPesq = document.getElementById('pesquisa');
    btnPesq.onclick = function () {
        return pesquisar()
    };

    var btnSalv = document.getElementById("salvar");
    btnSalv.onclick = function () { return addContatos() };
}

// ---->>>> Funções referente a tabela e a pesquia <<<<----
// Traz todos os contatos
function trazerContatos() {
    let url = "http://127.0.0.1:8080/lista-testes/arq-php/buscontatos.php";

    let request = new XMLHttpRequest(); // request é um onjeto que trata das informações da requisição criada
    request.open("GET", url);
    request.responseType = 'json';
    request.send();
    request.onload = function () {
        let contatosjson = request.response;
        gerarTab(contatosjson);
    }
}

//Faz uma requisição enviando uma informação como parâmetro que filtra o que será trazido
function pesquisar() {
    let pesquisa = document.getElementById("txtBusca");
    let request = new XMLHttpRequest(); // request é um onjeto que trata das informações da requisição criada
    let url = "http://127.0.0.1:8080/lista-testes/arq-php/buscontatos.php?pesquisa=" + pesquisa.value;
    request.open("GET", url);
    request.setRequestHeader("Content-type", "application/json");
    request.responseType = 'json';
    request.send();

    request.onload = function () {
        let pesquisou = (request.response)['contatos'].length > 0
        if (pesquisou) {
            let contatosjson = request.response;
            gerarTab(contatosjson);
        } else {
            document.getElementById('resposta').innerHTML = '';
            alert("Nenhum contato encontrado");
        }

    }
    return false;
}
// Função que irá gerar a tabela de contatos. Ela recebe um parametro json que determina quais contatos trazerá
function gerarTab(jsonList) {
    let resp = document.getElementById('resposta');
    resp.innerHTML = '';

    for (let i = 0; i < jsonList['contatos'].length; i++) {
        let myTr = document.createElement('tr');
        resp.appendChild(myTr);
        // myTr.setAttribute()
        for (j = 1; j <= 3; j++) {
            let content;
            if (j != 3) {
                if (j == 1) {
                    content = jsonList['contatos'][i].nome;
                } else {
                    content = jsonList['contatos'][i].email;
                }
                myTr.appendChild(montTd(content, "any"));
            } else {
                let myTd = document.createElement('td');
                let btnExc = document.createElement('button');
                let btnEdt = document.createElement('button');
                myTd.classList.add("funcoes");
                btnExc.classList.add("excluir");
                btnEdt.classList.add('editar');
                btnEdt.setAttribute("onclick", `editarContato('${(jsonList['contatos'][i].id)}', '${(jsonList['contatos'][i].nome)}', '${(jsonList['contatos'][i].email)}')`);
                btnExc.setAttribute("onclick", `excluirContato('${(jsonList['contatos'][i].id)}', '${(jsonList['contatos'][i].nome)}', '${(jsonList['contatos'][i].email)}')`);
                btnEdt.setAttribute("type", 'button');
                btnExc.setAttribute("type", 'button');
                btnEdt.textContent = "Editar";
                btnExc.textContent = "Excluir";
                myTr.appendChild(myTd);
                myTd.appendChild(btnExc);
                myTd.appendChild(btnEdt);
            }
        }
    }
    function montTd(dados, classe) {
        let td = document.createElement('td');
        td.innerText = dados;
        td.classList.add(classe);
        return td;
    }
}

// ---->>>> Funções para os botões dos contatos <<<<----



// Função executada ao clicar no botão de editar um contato
function editarContato(numId, nomeContato, emailContato) {
    let confirmacao = confirm("Voce tem certeza que deseja editar o contato? \n(nome: " + nomeContato + ", email: " + emailContato + ")");
    if (!confirmacao) {
        alert("Operação cancelada");
    } else { // Aqui vai todo o codigo para editar
        let validaNome = true;
        while (validaNome) {
            var newNome = window.prompt(`Insira um novo nome no espaço a seguir: `, `${nomeContato}`);
            if (newNome === null) {
                alert("Edição cancelada");
                validaNome = false;
            } else if (newNome == '' || newNome == " ") {
                alert("Insira algum caractere no seu novo nome");
            } else {
                validaNome = false;
            }
        }
        if (!validaNome) {
            let validaEmail = true;
            while (validaEmail) {
                var newEmail = window.prompt(`Insira um novo email no espaço a seguir: `, `${emailContato}`);
                if (newEmail === null) {
                    alert("Operação cancelada");
                    return false
                }

                let posiAr = newEmail.indexOf("@")
                let emailInvalido = (newEmail.indexOf(" ") != -1 || posiAr == -1 || newEmail == '' ||newEmail.indexOf(".", posiAr) == -1)
                
                if (emailInvalido) {
                    alert("Email invalido");
                } else {
                    validaEmail = false;
                }
            }
            confirmacao = window.confirm(`Você deseja salvar seu novo contato como: \n Nome: ${newNome} \n Email: ${newEmail}`);
            if (!confirmacao) {
                alert("Alteração cancelada");
            } else {
                let inform = {
                    "id": numId,
                    "nome": newNome,
                    "email": newEmail
                };
                let data = JSON.stringify(inform)
                let url = "http://127.0.0.1:8080/lista-testes/arq-php/edt-contatos.php";
                let request = new XMLHttpRequest();
                //Abertura da conexão
                request.open("PUT", url);
                // Cabeçalho
                request.setRequestHeader("Content-type", "application/json");
                request.send(data);
                request.onload = function () {
                    let editou = (request.status) == 200;
                    if (editou) {
                        alert("Editado com sucesso com sucesso");
                    } else {
                        let contatoExiste = (request.status) == 204;
                        if (contatoExiste) {
                            alert("Erro ao editar \nO novo email já está cadastrado em outro contato de sua lista \nTente novamente com outro email")

                        } else {
                            alert("Erro ao editar \nEsse contato pode ter sido excluido em outra página \nAtualizando...")

                        }
                    }
                    trazerContatos();
                    return false;
                }
            }
        }
    }
}
// função acionada ao clicar no botão de excluir um contato
function excluirContato(numId, nomeContato, emailContato) {

    let confirmado = confirm("Voce tem certeza que deseja excluir o contato? \n(nome: " + nomeContato + ", email: " + emailContato + ")");
    if (!confirmado) {
        alert("Operação cancelada");
        return false
    }
    // Criando um Json com o id para que esse seja acessado pelo PHP
    let inform = {
        "id": numId
    };
    let data = JSON.stringify(inform);
    excluir(data);




    //Função que vai fazer a requisição para que o contato seja excluido
    function excluir(idJson) {
        let url = "http://127.0.0.1:8080/lista-testes/arq-php/excluir.php";
        let request = new XMLHttpRequest();

        request.open("DELETE", url);

        request.setRequestHeader("Content-type", "application/json");
        request.send(idJson);

        request.onload = function () {
            let excluiu = (request.status) == 204;
            if (excluiu) {
                alert("Excluido com sucesso");
                trazerContatos();
                return false;
            }
            alert("Esse contato pode ter sido excluido em outra página \nAtualizando...");
            trazerContatos();

        }
    }

}


// ---->>>> Função para adicionar um contato <<<<----

function addContatos() {
    // Pegando dados do html 
    let nome = document.getElementById("input_name");
    let email = document.getElementById("input_email");

    let inputVazio = (nome.value == "" || email.value == "")
    let posiAr = ((email.value).indexOf("@"))
    let emailInvalido = ((posiAr == -1) || (email.value).indexOf(".", posiAr) ==-1 || (email.value).indexOf(" ") != -1)

    if (inputVazio) {
        alert("Campo de nome ou de email vazios");
        return false;
    }
    if (emailInvalido) {
        alert("Email inválido!!");
        return false;
    }
    let inform = {
        "nome": nome.value,
        "email": email.value
    };
    let data = JSON.stringify(inform);

    // Criando um objeto XMLHttpRequest
    let url = "http://127.0.0.1:8080/lista-testes/arq-php/addcontato.php"
    let request = new XMLHttpRequest();

    //Abertura da conexão
    request.open("POST", url);
    // Cabeçalho
    request.setRequestHeader("Content-type", "application/json");
    request.send(data);
    request.onload = function () {
        let codigoResposta = (request.status) == 201;
        if (codigoResposta) {
            nome.value = '';
            email.value = '';
            alert("Contato salvo com sucesso");
        } else {
            alert("Erro ao salvar o contato \n O e-mail inserido possivelmente já foi salvo anteriormente.")
        }
        trazerContatos();
    }
    return false;


}