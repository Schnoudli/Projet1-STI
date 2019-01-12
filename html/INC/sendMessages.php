<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 12.10.2018
 * Time: 18:31
 */
session_start();

if (isset($_SESSION["user_id"])) {

    if(!empty($_POST['message_spam'])){
        $arrToSend = array();
        array_push($arrToSend, "1", 'die spamming bot');
        die(json_encode($arrToSend));
    }

    /***********    Phase de connection à la databases     ************/
    try {
        /*** connect to SQLite database ***/

        $file_db = new PDO("sqlite:../../databases/database.sqlite");

    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<br><br>Database -- NOT -- loaded successfully .. ";
        die("<br><br>Query Closed !!!");
    }

    /***********    Connection à la databases OK     ************/

    $dest_name = strTolower(filter_var($_POST['destinataire'], FILTER_SANITIZE_STRING));
    $sujet = filter_var($_POST['sujet'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $expediteur_id = filter_var($_SESSION["user_id"], FILTER_SANITIZE_STRING);
    $dest_id_db = '';
    $arrToSend = array();

    date_default_timezone_set('UTC');

// Pour le destinataire
    $sth = $file_db->prepare("SELECT User_id, Username FROM Personne WHERE Username=:dest_name");
    $sth->execute(array(':dest_name' => $dest_name));
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $dest_id_db = $row['User_id'];
        $dest_name_db = strTolower($row['Username']);
    }

// Pour l'expediteur

    $sth = $file_db->prepare("SELECT Username FROM Personne WHERE User_id=:expediteur_id");
    $sth->execute(array(':expediteur_id' => $expediteur_id));
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $expediteur_name_db = strTolower($row['Username']);
    }

// Verif du destinataire existant
    if ($dest_name == $dest_name_db && $dest_id_db) {
// Remplissage de la table Message

        $sth = $file_db->prepare("INSERT INTO Message  (Date, Expediteur, Destinataire, Sujet, Message, Lu) VALUES (:date, :expediteur_name_db, :dest_name, :sujet, :message,0)");
        $sth->execute(array(':date' => date("Y-m-d H:i:s"), ':expediteur_name_db' => $expediteur_name_db, ':dest_name' => $dest_name, ':sujet' => $sujet, ':message' => $message));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

// Remplissage de la table Messages

        $sth = $file_db->prepare("INSERT INTO Messages (Expediteur, Destinataire, Message_id) VALUES ( :expediteur_id , :dest_id_db , :lastFile)");
        $sth->execute(array(':expediteur_id' => $expediteur_id, ':dest_id_db' => $dest_id_db, ':lastFile' => $file_db->lastInsertId()));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        array_push($arrToSend, "1", "Message envoyé!");
        echo json_encode($arrToSend);
    } else {
        array_push($arrToSend, "0", "Ce destinataire n'existe pas!");
        echo json_encode($arrToSend);
    }
    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}
else {
    header('Location: ../index.php');
    exit();
}