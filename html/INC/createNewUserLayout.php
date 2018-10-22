<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 16:27
 */

session_start();
$layout = '';

if($_SESSION['admin']) {

    $layout = '<form action="javascript:createNewUser()">'
        .'<label for="lastname">Nom: </label>'
        .'<input type="text" name="lastname" id="lastname" required onchange="updateNewUsername()"><br>'
        .'<label for="firstname">Prénom: </label>'
        .'<input type="text" name="firstname" id="firstname" required onchange="updateNewUsername()"><br>'
        .'<label for="pass">Mot de passe: </label>'
        .'<input type="password" name="pass" id="pass" required><br>'
        .'<label for="passCheck">Nouveau mot de passe vérification: </label>'
        .'<input type="password" name="passCheck" id="passCheck" required><br>'
        .'<label for="isActif">Actif : </label>'.'<input id="isActif" type="checkbox"><br>'
        .'<label for="isAdmin">Admin : </label>'.'<input id="isAdmin" type="checkbox"><br>'
        .'<span>Le username créé sera sous la forme "prénom.nom"</span><br>'
        .'<span id="newUsername"></span><br>'
        .'<input type="submit" value="Créer l\'utilisateur"><br>'
        .'</form><br><br>';

}

$arrToSend = array();
array_push($arrToSend, '#content', $layout ? $layout : "Vous n'êtes pas administrateur!!!") ;
echo json_encode($arrToSend);