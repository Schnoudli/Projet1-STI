<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */
/***********    Phase de connection à la databases     ************/
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
        $string = "<table><tbody>";
        foreach ($arr as $row) {
            $string .= "<tr>"
                . "<td class='row1' onclick=getMessage(" . $row['Message_id'] . ")>" . $row['Expediteur'] . "</td>"
                . "<td class='row2' onclick=getMessage(" . $row['Message_id'] . ")>" . $row['Sujet'] . "</td>"
                . "<td class='row3' onclick=getMessage(" . $row['Message_id'] . ")>" . $row['Date'] . "</td>"
                . "<td class='row4'><input type='button' onclick=responseMsg(" . $row['Message_id'] . ") value='Répondre'></td>"
                . "<td class='row5'><input type='button' onclick=supressMsg(" . $row['Message_id'] . ") value='Supprimer'></td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";

        if ($string == "<table><tbody></tbody></table>") {
            $string = "";
        }
        return $string;
    }

    /***********    Connexion à la databases OK     ************/
    $user = $_SESSION["user_id"];
// Permet de récupérer tout les messages où l'on est le destinataire
    $sth = $file_db->prepare("SELECT * FROM Messages INNER JOIN Message ON Messages.Message_id = Message.Message_id WHERE Messages.Destinataire=:user ORDER BY Date DESC");
    $sth->execute(array(':user' => $user));
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

// Affichage des différents messages
    $msg = setupMsg($result);

    $arrToSend = array();
    array_push($arrToSend, '#content', $msg ? $msg : 'Pas de message');
    echo json_encode($arrToSend);

    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}