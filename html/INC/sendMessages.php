<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 12.10.2018
 * Time: 18:31
 */
session_start();
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

/***********    Connection à la databases OK     ************/

$dest_name = strTolower($_POST['destinataire']);
$sujet = $_POST['sujet'];
$message = $_POST['message'];
$expediteur_id = $_SESSION["user_id"];
$dest_id_db = '';
$arrToSend = array();

date_default_timezone_set('UTC');

// Pour le destinataire
$sql = "SELECT User_id, Username FROM Personne WHERE Username='$dest_name';";
$result = $file_db->query($sql);
foreach ($result as $row) {
    $dest_id_db = $row['User_id'];
    $dest_name_db = strTolower($row['Username']);
}

// Pour l'expediteur
$sql = "SELECT Username FROM Personne WHERE User_id='$expediteur_id';";
$result = $file_db->query($sql);
foreach ($result as $row) {
    $expediteur_name_db =  strTolower($row['Username']);
}

// Verif du destinataire existant
if($dest_name == $dest_name_db && $dest_id_db){
// Remplissage de la table Message
    $sql = "INSERT INTO Message  (Date, Expediteur, Destinataire, Sujet, Message, Lu) VALUES ('" . date("Y-m-d H:i:s") ."', '" . $expediteur_name_db . "','" . $dest_name . "','" . $sujet . "',\"" . $message . "\",0);";
    $result = $file_db->exec($sql);

// Remplissage de la table Messages
    $sql = "INSERT INTO Messages (Expediteur, Destinataire, Message_id) VALUES ('". $expediteur_id ."', '". $dest_id_db ."', '". $file_db->lastInsertId() ."');";
    $result = $file_db->exec($sql);

    array_push($arrToSend, "1", "Message envoyé!") ;
    echo json_encode($arrToSend);
}
else {
    array_push($arrToSend, "0", "Ce destinataire n'existe pas!") ;
    echo json_encode($arrToSend);
}
/***********    Déconnexion de la databases        ************/
$file_db = null;