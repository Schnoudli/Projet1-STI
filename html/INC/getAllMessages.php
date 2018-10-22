<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */
/***********    Phase de connection à la DB     ************/
session_start();
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

function setupMsg($arr) {
    $string="<table><tbody>";
    foreach ($arr as $row) {
        $string .= "<tr>"
        . "<td class='row1' onclick=getMessage(". $row['Message_id'] .")>" . $row['Expediteur'] . "</td>"
        . "<td class='row2' onclick=getMessage(". $row['Message_id'] .")>" . $row['Sujet'] . "</td>"
        . "<td class='row3' onclick=getMessage(". $row['Message_id'] .")>" . $row['Date'] . "</td>"
        . "<td class='row4'><input type='button' onclick=responseMsg(". $row['Message_id'] .") value='Répondre'></td>"
        . "<td class='row5'><input type='button' onclick=supressMsg(". $row['Message_id'] .") value='Supprimer'></td>"
        . "</tr>";
    }
    $string .="</tbody></table>";

    if($string == "<table><tbody></tbody></table>"){
        $string = "";
    }
    return $string;
}

/***********    Connexion à la DB OK     ************/
$user = $_SESSION["user_id"];
// Permet de récupérer tout les messages où l'on est le destinataire
$result = $file_db->query("SELECT * FROM Messages INNER JOIN Message ON Messages.Message_id = Message.Message_id WHERE Messages.Destinataire='$user'");

// Affichage des différents messages

$msg = setupMsg($result);

$arrToSend = array();
array_push($arrToSend, '#content', $msg ? $msg : 'Pas de message') ;
echo json_encode($arrToSend);


/***********    Déconnexion de la DB        ************/
$file_db = null;