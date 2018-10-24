<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 18/10/2018
 * Time: 10:49
 */
function manageLayout(){
$string = '';
if (isset($_SESSION["user_id"])){
    $string .= '<div id="top">';
    if($_SESSION["admin"]) {
        $string .= '<input type="button" value="Création utilisateur" onclick="createNewUserLayout()">';
        $string .= '<input type="button" value="Modification utilisateur" onclick="modifUser()">';
    }
    $string .= '<input type="button" value="Changer de mot de passe" onclick="changePass()">'
            .'<input type="button" value="Nouveau message" onclick="newMessage()">'
            .'<input type="button" value="Déconnexion" onclick="deconnexion()" >'
            .'<td>Nom d\'utilisateur : '.$_SESSION['username'].'</td>';

    $string .= '</div>'
            .'<main>'
            .'<div id="lateral">'
            .'<p onclick="getAllMessage()">Boite de réception</p>'
            .'</div>'
            .'<div id="content">'
            .'</div>'
            .'</main>'
            .'<script>getAllMessage()</script>';
}
else{
    $string .= '<form action="javascript:login()">'
            .'<label for="login">Login</label>'
            .'<input type="text" id="login" name="login" placeholder="email" value="" required><br><br>'
            .'<label for="password">Password</label>'
            .'<input type="password" id="password" name="password" placeholder="password" value="" required><br><br>'
            .'<input type="submit" value="submit">'
            .'</form>'
            .'<div class="msgError" id="msgErrorId"></div>';
}

return $string;
}