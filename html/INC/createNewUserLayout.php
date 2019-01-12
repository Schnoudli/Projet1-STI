<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 16:27
 */

session_start();

if($_SESSION['admin']) {

    /***********    Phase de connection à la databases     ************/
    try
    {
        /*** connect to SQLite database ***/

        $file_db = new PDO("sqlite:../../databases/database.sqlite");

    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        echo "<br><br>Database -- NOT -- loaded successfully .. ";
        die( "<br><br>Query Closed !!!");
    }


    $layout = '';
    $isAdmin;
    $userIdSession = $_SESSION["user_id"];

    $sth = $file_db->prepare("SELECT Admin FROM Personne WHERE User_id =:userId");
    $sth->execute(array(':userId' => $userIdSession));
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $isAdmin = $row['Admin'];
        $_SESSION['admin'] = $row['Admin'];
    }

    if($isAdmin) {
        $layout = '<form action="javascript:createNewUser()">'
            . '<label for="lastname">Nom: </label>'
            . '<input type="text" name="lastname" id="lastname" required onchange="updateNewUsername()"><br>'
            . '<label for="firstname">Prénom: </label>'
            . '<input type="text" name="firstname" id="firstname" required onchange="updateNewUsername()"><br>'
            . '<label for="pass">Mot de passe: </label>'
            . '<input type="password" name="pass" id="pass" required><br>'
            . '<label for="passCheck">Nouveau mot de passe vérification: </label>'
            . '<input type="password" name="passCheck" id="passCheck" required><br>'
            . '<label for="isActif">Actif : </label>' . '<input id="isActif" type="checkbox"><br>'
            . '<label for="isAdmin">Admin : </label>' . '<input id="isAdmin" type="checkbox"><br>'
            . '<span>Le username créé sera sous la forme "prénom.nom"</span><br>'
            . '<span id="newUsername"></span><br>'
            . '<input type="submit" value="Créer l\'utilisateur"><br>'
            . '</form><br><br>';
    }

    $arrToSend = array();
    array_push($arrToSend, '#content', $layout ? $layout : "Vous n'êtes pas administrateur!!!") ;
    echo json_encode($arrToSend);

    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}
else {
    header('Location: ../index.php');
    exit();
}