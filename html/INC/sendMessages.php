<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 12.10.2018
 * Time: 18:31
 */
session_start();
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
//echo ($expediteur_id = $_POST["expediteur_id"]). "<br/>";
//echo ($expediteur = $_POST["expediteur"]). "<br/>";
//echo ($destinataire_id = $_POST["destinataire_id"]). "<br/>";
/***** TODO a enlever!!! seulement pour test!! *****/
//$_SESSION["user_id"] = 1;
//$_SESSION["username"] = "andre.jacquemond";

date_default_timezone_set('UTC');

$sql = "SELECT User_id FROM Personne WHERE Username='$destinataire';";
$result = $file_db->exec($sql);

$dest_id = $result["User_id"];

$sql = "INSERT INTO Message VALUES (NULL,'" . date("Y-m-d H:i:s") ."',
'" . $_SESSION["username"] . "','" . $destinataire . "','" . $sujet . "',\"" . $message . "\",0);";

$result = $file_db->exec($sql);

$sql = "INSERT INTO Messages VALUES (NULL, '". $_SESSION["user_id"] ."', '". $dest_id ."', '". $file_db->lastInsertId() ."');";
$result = $file_db->exec($sql);

