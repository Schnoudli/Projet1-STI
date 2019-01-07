<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 16/10/2018
 * Time: 19:21
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

    function setupMsg($arr)
    {
        $string = "<div id='contentMsg'>";
        foreach ($arr as $row) {
            $string .= "<div  id='headMsgTitle'><h3>" . $row['Sujet'] . "</h3>"
                . "<input type='button' onclick=responseMsg(" . $row['Message_id'] . ") value='Répondre'><input type='button' onclick=supressMsg(" . $row['Message_id'] . ") value='Supprimer'></div>"
                . "<hr>"
                . "<div id='headMsg'><span><strong>" . $row['Expediteur'] . "</strong></span>"
                . "<span style='float: right;'>" . $row['Date'] . "</span><br>"
                . "<span>à " . $row['Destinataire'] . "</span></div><hr>"
                . "<div>" . $row['Message'] . "</div>";
        }
        $string .= "</div>";

        return $string;
    }

    /***********    Connexion à la databases OK     ************/
    $user = $_SESSION["user_id"];
    $idMsg = $_POST['idMsg'];
// Permet de récupérer tout les messages où l'on est le destinataire
    $result = $file_db->query("SELECT * FROM Messages INNER JOIN Message ON Messages.Message_id = Message.Message_id WHERE Messages.Destinataire='$user' AND Messages.Message_id='$idMsg' ");

// Affichage du message

    $msg = setupMsg($result);

    $arrToSend = array();
    array_push($arrToSend, '#content', $msg);
    echo json_encode($arrToSend);


    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}
else {
    header('Location: ../index.php');
    exit();
}