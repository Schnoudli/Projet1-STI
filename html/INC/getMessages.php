<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */
try
{
    /*** connect to SQLite database ***/

    # Pour Docker ou serveur Nginx
    $file_db = new PDO("sqlite:/usr/share/nginx/DB/database.sqlite");

    # Pour windows
    #$file_db = new PDO('sqlite:c:\Users\Andre\PhpstormProjects\Projet1-STI\DB\database.sqlite');

    echo "Handle has been created ...... <br><br>";

}
catch(PDOException $e)
{
    echo $e->getMessage();
    echo "<br><br>Database -- NOT -- loaded successfully .. ";
    die( "<br><br>Query Closed !!!²");
}

echo "Database loaded successfully ...." . "<br/>";

$dest = 1;

$result = $file_db->query("SELECT * FROM Messages INNER JOIN Message ON Messages.Message_id = Message.Message_id WHERE Messages.Destinataire='$dest'");
if($result === NULL){
    echo "pas de messages";
}
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