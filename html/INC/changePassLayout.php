<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 15:29
 */

if (isset($_SESSION["user_id"])) {
    $layout = '<form action="javascript:changePassUser()">'
        . '<label for="oldPass">Ancien mot de passe: </label>'
        . '<input type="password" name="oldPass" id="oldPass" required><br>'
        . '<label for="newPass">Nouveau mot de passe: </label>'
        . '<input type="password" name="newPass" id="newPass" required><br>'
        . '<label for="newPassCheck">Nouveau mot de passe vérification: </label>'
        . '<input type="password" name="newPassCheck" id="newPassCheck" required><br>'
        . '<input type="submit" value="Changer de mot de passe"><br>'
        . '</form>';


    $arrToSend = array();
    array_push($arrToSend, '#content', $layout);
    echo json_encode($arrToSend);
}
else {
    header('Location: ../index.php');
    exit();
}