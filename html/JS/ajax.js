//Fonction testant si le JSON peut-être parsé
function testeParseJson(json) {
    let parsed;
    try {
        parsed = JSON.parse(json);
    }
    catch (e) {
        parsed = {"jsonError": {'error': e, 'json': json}};
    }
    return parsed;
}

function alertInfo(str){
    alert(str);
}

function afterReload(str){
    var r = confirm(str);
        location.reload();
}

function manageReturn(retour) {
    let json = testeParseJson(retour);
    $(json[0]).html(json[1]);
}

function login() {
    let log = $('#login')[0].value;
    let login_spam = $('#login_spam')[0].value;
    let pass = $('#password')[0].value;

    $.post('INC/login.php',{login : log , login_spam: login_spam, password : pass }, manageReturn);
}

function getAllMessage(){
    $.post('INC/getAllMessages.php', manageReturn);
}

function getMessage(idMsg){
    $.post('INC/getMessages.php', {idMsg: idMsg}, manageReturn);
}

function deconnexion(){
    var r = confirm("Veuillez confirmer votre déconnexion");
    if (r === true) {
        $.post('INC/deco.php', afterReload);
    }
}

function newMessage(){
    $.post('INC/sendMessageLayout.php', manageReturn);
}

function returnSendMessage(retour) {
    let json = testeParseJson(retour);
    if(json[0]== 1) {
        var r = confirm(json[1]);
        if (r || !r) {
            responseMsg();
        }
    }
    else {
        alert(json[1]);
    }
}

function sendMessage(){
    let destinataire = $('#destinataire')[0].value;
    let sujet = $('#sujet')[0].value;
    let message_spam = $('#message_spam')[0].value;
    let message = $('#message')[0].value;
    $.post('INC/sendMessages.php',{destinataire : destinataire , sujet : sujet, message_spam: message_spam, message : message }, returnSendMessage);
}

function supressMsg(idMsg) {
    var r = confirm("Voulez-vous vraiment supprimer ce message?");
    if (r == true) {
        $.post('INC/deleteMessage.php', {idMsg : idMsg}, afterReload);
    }
}


function responseMsg(idMsg = ''){
    $.post('INC/sendMessageLayout.php', {idMsg : idMsg}, manageReturn);
}

function modifUser() {
    $.post('INC/modifUserLayout.php', manageReturn);
}

function updateUser(userId) {
    let arrayTemp = $('.'+userId);
    let isActif = arrayTemp[0].checked;
    let newMdp = arrayTemp[1].value;
    let isAdmin = arrayTemp[2].checked;
    $.post('INC/manageUser.php', {context: 'update', userId: userId, isActif: isActif, newMdp: newMdp, isAdmin: isAdmin}, modifUser);
}

function deleteUser(userId) {
    var r = confirm("Voulez-vous vraiment supprimer cet utilisateur?");
    if (r == true) {
        $.post('INC/manageUser.php', {context: 'delete', userId: userId}, modifUser);
    }
}

function changePass() {
    $.post('INC/changePassLayout.php', manageReturn);
}

function changePassUser() {
    let oldPass = $("#oldPass")[0].value;
    let newPass = $("#newPass")[0].value;
    let newPassCheck = $("#newPassCheck")[0].value;

    if(newPass !== newPassCheck) {
        alertInfo("Veuillez taper le même mot de passe!");
    }
    else {
        $.post('INC/updatePassword.php', {oldPass: oldPass, newPass: newPass, newPassCheck: newPassCheck}, alertInfo);
    }
}

function createNewUserLayout(){
    $.post('INC/createNewUserLayout.php', manageReturn);
}

function createNewUser(){
    let firstname = $('#firstname')[0].value;
    let lastname = $('#lastname')[0].value;
    let pass = $("#pass")[0].value;
    let passCheck = $("#passCheck")[0].value;
    let isActif = $('#isActif')[0].checked;
    let isAdmin = $('#isAdmin')[0].checked;

    if(pass !== passCheck) {
        alertInfo("Veuillez taper le même mot de passe!");
    }
    else {
        $.post('INC/createNewUser.php',{firstname:firstname, lastname:lastname, pass:pass, passCheck:passCheck, isActif:isActif, isAdmin:isAdmin}, alertInfo);
    }
}

function updateNewUsername() {
    let firstname = $('#firstname')[0].value;
    let lastname = $('#lastname')[0].value;

    let str = firstname + '.' + lastname;
    str = str.toLowerCase();
    $('#newUsername').html(str);
}