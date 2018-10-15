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
};

function login() {
    var log = document.getElementById('login').value;
    var pass = document.getElementById('password').value;
    var type = 'login';   //{};
    $.post('INC/formSubmit.php',{login : log , password : pass, type : type }, gereRetour);
};

function gereRetour(retour) {
    var json = testeJson(retour);
    if(json[0] == 'error') {
        $("#msgErrorId").html(json[1]);
    }
    else if(json[0] == 'display') {
        $("body").html(json[1]);
    }
};
function deconnexion(){
    $.post('INC/deco.php');
    location.reload();
};