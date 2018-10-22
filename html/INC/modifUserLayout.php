<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 13:57
 */
session_start();
$layout = '';

if($_SESSION['admin']) {
    /***********    Phase de connection à la DB     ************/
    try
    {
        /*** connect to SQLite database ***/

        $file_db = new PDO("sqlite:../../DB/database.sqlite");

    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        echo "<br><br>Database -- NOT -- loaded successfully .. ";
        die( "<br><br>Query Closed !!!");
    }

    function manageLayout($arr){
        $string = '';
        foreach ($arr as $row) {
            $string .='<table><tr class="formModifUser">'
                .'<td><label>Actif : </label>'.'<input type="checkbox" class="'.$row['User_id'].'"'.($row['Actif'] ? ' checked' : ' ').'></td>'
                .'<td>Nom d\'utilisateur :<br>'.$row['Username'].'</td>'
                .'<td><label>Mot de passe : </label>' . '<input type="password" class="'.$row['User_id'].'" value="'.$row['Pass'].'" required></td>'
                .'<td><label >Admin : </label>'.'<input type="checkbox" class="'.$row['User_id'].'"'. ($row['Admin'] ? ' checked' : ' ') .'></td>'
                .'<td><input type="button" value="Editer utilisateur" onclick="updateUser('.$row['User_id'].')"></td>'
                .'<td><input type="button" value="Supprimer utilisateur" onclick="deleteUser('.$row['User_id'].')"></td>'
                .'</tr></table>';
        }
        return $string;
    }

    $result = $file_db->query("SELECT * FROM Personne");
    $layout = manageLayout($result);
    /***********    Déconnexion de la DB        ************/
    $file_db = null;
}

$arrToSend = array();
array_push($arrToSend, '#content', $layout ? $layout : "Vous n'êtes pas administrateur!!!") ;
echo json_encode($arrToSend);