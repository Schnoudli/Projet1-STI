<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */
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

function setupMsg($arr) {
    $string="";
    foreach ($arr as $row) {
        $string .= "Message_id: " . $row['Message_id'] . "<br/>";
        $string .= "Date: " . $row['Date'] . "<br/>";
        $string .= "Expediteur: " . $row['Expediteur'] . "<br/>";
        $string .= "Destinataire: " . $row['Destinataire'] . "<br/>";
        $string .= "Sujet: " . $row['Sujet'] . "<br/>";
        $string .= "Message: " . $row['Message'] . "<br/>";
        $string .= "Lu: " . $row['Lu'] . "<br/>";
        $string .= "<br/>";
    }
    return $string;
}

/***********    Connexion à la DB OK     ************/

// Permet de récupérer tout les messages où l'on est le destinataire
$result = $file_db->query("SELECT * FROM Messages INNER JOIN Message ON Messages.Message_id = Message.Message_id WHERE Messages.Destinataire='$user'");

// Affichage des différents messages

$msg = setupMsg($result);
echo $msg ? $msg : 'Pas de message';


/***********    Déconnexion de la DB        ************/
$file_db = null;