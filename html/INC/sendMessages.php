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

// Permet de récupérer le message désiré
echo ($expediteur_id = $_POST["expediteur_id"]). "<br/>";
echo ($expediteur = $_POST["expediteur"]). "<br/>";
echo ($destinataire_id = $_POST["destinataire_id"]). "<br/>";
echo ($destinataire = $_POST["destinataire"]). "<br/>";
echo ($sujet = $_POST["sujet"]). "<br/>";
echo ($message = $_POST["message"]). "<br/>";

date_default_timezone_set('UTC');
echo date("Y-m-d H:i:s"). "<br/>";

$sql = "INSERT INTO Message VALUES (NULL,'" . date("Y-m-d H:i:s") ."',
'" . $expediteur . "','" . $destinataire . "','" . $sujet . "',\"" . $message . "\",0);";

echo $sql . "<br/>";
$result = $file_db->exec($sql);

$sql = "SELECT last_insert_rowid();";

$result = $file_db->exec($sql);

echo $result. "<br/>";
