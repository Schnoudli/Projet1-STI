<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 10:40
 */
session_start();
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

/***********    Connexion à la DB OK     ************/
$user = $_SESSION["user_id"];
$idMsg = $_POST['idMsg'];

$result = $file_db->query("DELETE FROM Messages WHERE Message_id='$idMsg'");
$result = $file_db->query("DELETE FROM Message WHERE Message_id='$idMsg'");



/***********    Déconnexion de la DB        ************/
$file_db = null;