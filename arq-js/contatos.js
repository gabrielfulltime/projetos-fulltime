function trazerContatos() {
    let url = "http://127.0.0.1:8080/lista-testes/arq-php/buscontatos.php";

    //Teste para pesquisa
    /* let busc = document.getElementById("txtBusca");
    let inform = { "busca": busc.value };
    let data = JSON.stringify(inform);*/
    let request = new XMLHttpRequest(); // request é um onjeto que trata das informações da requisição criada
    request.open("GET", url);
    request.responseType = 'json';
    request.send();
    // Onload é um atributo que perite executar a função apenas quando a resposta é enviada do servidor,
    // não tendo preocupação caso o atributo response da request ainda esteja vazio.
    request.onload = function () {
        let contatosjson = request.response;
        // JSON.parse(contatosjson)
        gerarTab(contatosjson);

        // gerarTab(contatos)
    }
}
function gerarTab(jsonList) {
    let resp = document.getElementById('resposta');
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
                btnEdt.setAttribute("onclick", `editarContato('${(jsonList['contatos'][i].id)}', '${(jsonList['contatos'][i].nome)}', '${(jsonList['contatos'][i].email)}')`)
                btnExc.setAttribute("onclick", `excluirContato('${(jsonList['contatos'][i].id)}', '${(jsonList['contatos'][i].nome)}', '${(jsonList['contatos'][i].email)}')`)
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

function test(params) {
    alert("Foi bro")
}
