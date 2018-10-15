<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 12.10.2018
 * Time: 18:31
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

// Permet de supprimer le message_id dans la table liant un message à deux personnes
$messages_id = $_POST["messages_id"];

echo $user_id . "<br/>";

$sql = "DELETE Messages WHERE Messages_id = " . $messages_id . ";";

// Mise à jour du password
$result = $file_db->exec($sql);