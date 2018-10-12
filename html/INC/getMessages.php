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

/***********    Connection à la DB OK     ************/

// Permet de récupérer tout les messages où l'on est le destinataire
$result = $file_db->query("SELECT * FROM Messages INNER JOIN Message ON Messages.Message_id = Message.Message_id WHERE Messages.Destinataire='$user'");

if($result === NULL){
    echo "pas de messages"; // TODO à fixer, ne fonctionne pas (cas de bob l'éponge
}

// Affichage des différents messages
else{
    foreach ($result as $row) {
        echo "Message_id: " . $row['Message_id'] . "<br/>";
        echo "Date: " . $row['Date'] . "<br/>";
        echo "Expediteur: " . $row['Expediteur'] . "<br/>";
        echo "Destinataire: " . $row['Destinataire'] . "<br/>";
        echo "Sujet: " . $row['Sujet'] . "<br/>";
        echo "Message: " . $row['Message'] . "<br/>";
        echo "Lu: " . $row['Lu'] . "<br/>";
        echo "<br/>";

    }
}