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
    print_r($_SESSION, true);
    if($_SESSION["admin"] == 1) {
        $string .= '<input type="button" value="Modification utilisateur">';
    }
    $string .= '<input type="button" value="Changer de mot de passe">'
            .'<input type="button" value="Nouveau message" onclick="newMessage()">'
            .'<input type="button" value="Déconnexion" onclick="deconnexion()" >';

    $string .= '</div>'
            .'<main>'
            .'<div id="lateral">'
            .'<p onclick="getAllMessage()">Boite de réception</p>'
            .'<p>Messages envoyés</p>'
            .'</div>'
            .'<div id="content">'
            .'</div>'
            .'</main>'
            .'<script>getAllMessage()</script>';
}
else{
    $string .= '<form action="javascript:login()">'
            .'<label for="login">Login</label>'
            .'<input type="text" id="login" name="login" placeholder="email" value="steve.henriquet" required><br><br>'
            .'<label for="password">Password</label>'
            .'<input type="password" id="password" name="password" placeholder="password" value="pass" required><br><br>'
            .'<input type="submit" value="submit">'
            .'</form>'
            .'<div class="msgError" id="msgErrorId"></div>';
}

return $string;
}