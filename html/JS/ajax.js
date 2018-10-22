//Fonction testant si le JSON peut-être parsé
function testeJson(json) {
    let parsed;
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
    let log = document.getElementById('login').value;
    let pass = document.getElementById('password').value;
    let type = 'login';
    $.post('INC/formSubmit.php',{login : log , password : pass, type : type }, manageReturn);
};

function getAllMessage(){
    $.post('INC/getAllMessages.php', manageReturn);
}

function getMessage(){
    $.post('INC/getMessages.php', manageReturn);
}

function manageReturn(retour) {
    let json = testeJson(retour);
    $(json[0]).html(json[1]);
}

function deconnexion(){
    var r = confirm("Veuillez confirmer votre déconnexion");
    if (r == true) {
        $.post('INC/deco.php').done(location.reload());
    }
}

function newMessage(){

    $.post('INC/message.php', manageReturn);
}

function returnSendMessage(retour) {
    console.log(retour);
    if(retour) {
        alert('Message envoyé');
    }
    else {
        alert('Fail');
    }
}

function sendMessage(){
    let destinataire = document.getElementById('destinataire').value;
    let sujet = document.getElementById('sujet').value;
    let message = document.getElementById('message').value;
    $.post('INC/sendMessages.php',{destinataire : destinataire , sujet : sujet, message : message }, returnSendMessage);
}