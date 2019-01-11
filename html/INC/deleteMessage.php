<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 10:40
 */
session_start();

if (isset($_SESSION["user_id"])) {
    try {
        /*** connect to SQLite database ***/

        $file_db = new PDO("sqlite:../../databases/database.sqlite");

    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<br><br>Database -- NOT -- loaded successfully .. ";
        die("<br><br>Query Closed !!!");
    }

    /***********    Connexion à la databases OK     ************/
    $user = $_SESSION["user_id"];
    $idMsg = $_POST['idMsg'];

    $dbDestinataire = '';

    $sth = $file_db->prepare("SELECT Destinataire FROM Messages WHERE Message_id=:idMsg");
    $sth->execute(array(':idMsg' => $idMsg));
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $dbDestinataire = $row['Destinataire'];
    }

    if ($dbDestinataire == $user) {
        //Delete sur les deux tables car pas de cascades lors de la suppression dans la table Message

        $sth = $file_db->prepare("DELETE FROM Message WHERE Message_id=:idMsg");
        $sth->execute(array(':idMsg' => $idMsg));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        $sth = $file_db->prepare("DELETE FROM Messages WHERE Message_id=:idMsg");
        $sth->execute(array(':idMsg' => $idMsg));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        echo "Message supprimé!";
    } else {
        echo "Vous ne pouvez pas supprimer ce message!";
    }

    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}
else {
    header('Location: ../index.php');
    exit();
}