<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 16/10/2018
 * Time: 19:21
 */
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
    $string="<div id='contentMsg'>";
    foreach ($arr as $row) {
        $string .= "<div><h3>". $row['Sujet']  ."</h3></div><hr>"
         . "<div id='headMsg'><span><strong>" . $row['Expediteur'] ."</strong></span>"
         . "<span style='float: right;'>". $row['Date']."</span><br>"
         . "<span>à " . $row['Destinataire'] . "</span></div><hr>"
         . "<div>" . $row['Message'] . "</div>";
    }
    $string .="</div>";

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