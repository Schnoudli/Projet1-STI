function ajax() {
    var log = document.getElementById('login').value;
    var pass = document.getElementById('password').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("msgErrorId").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("POST", "INC/formSubmit.php?login=" + log + '&password=' + pass, true);
    xmlhttp.send();
}
//Fonction testant si le JSON peut-être parsé
function testeJson(json) {
    var parsed;
    try {
        parsed = JSON.parse(json);
        /*parsed = 'C\'est bien du JSON dont les clés sont : <hr>'  //enlever dans la phase 2.1
         + Object.keys(parsed).join(' - ')
        +'<hr>'
        + json;*/
    }
    catch (e) {
        //parsed = json;  //phase01
        parsed = {"jsonError": {'error': e, 'json': json}};
    }
    return parsed;
}

function login() {
    var log = document.getElementById('login').value;
    var pass = document.getElementById('password').value;
    var type = 'login';   //{};
    $.post('INC/formSubmit.php',{login : log , password : pass, type : type }, gereRetour);
}

function gereRetour(retour) {
    var json = testeJson(retour);
    console.log(json);
    if(json[0] == 'error') {
        $("#msgErrorId").html(json[1]);
    }
    else if(json[0] == 'display') {
        $("html").html(json[1]);
    }
}