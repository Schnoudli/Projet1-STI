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
    var post = $.post('INC/formSubmit.php',{login : log , password : pass, type : type }, manageReturn);
    post.done($.post('INC/getMessages.php', manageReturn));
};

function manageReturn(retour) {
    var json = testeJson(retour);
    $(json[0]).html(json[1]);
};

function deconnexion(){
    var post = $.post('INC/deco.php');
    post.done(window.location.reload());
};