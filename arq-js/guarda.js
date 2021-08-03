function contatoExiste(idCont, callback ) {
    let url = "http://127.0.0.1:8080/lista-testes/arq-php/buscontatos.php?idCont=" + idCont;
    let request = new XMLHttpRequest();
    request.open("GET", url);
    request.setRequestHeader("Content-type", "application/json");
    request.responseType = 'json';
    request.send();

    request.onload = function () {
        var jsonCont = request.response;
        callback(jsonCont)
    }


}

var jsonCont = contatoExiste(numId, function(jsonCont){

    var naoEncontrounContato = jsonCont ==  null;
    if (naoEncontrounContato) {
        alert("Esse contato pode ter sido apagado em outra página ");
        document.location.reload();
        return false;
    }

    alert(JSON.stringify(jsonCont));

})