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
$username = $_SESSION["username"];
$idMsg = $_POST['idMsg'];

$result = $file_db->query("DELETE FROM Messages WHERE Messages.Message_id='$idMsg' AND Messages.Destinataire='$user';");
// TODO: c'est normal qu'on ai deux fois la requêtes? supprimer un message de messages, c'est normal si l'on veux plus
// dans la réception, mais l'autre c'était pour garder une trace, ou simplement voir les envoyé (mais c'est pas demandé,
// et les supprimer impliquerais de checker qu'il ne soit plus dans messages).
$result = $file_db->query("DELETE FROM Message WHERE Message.Message_id='$idMsg' AND Message.Destinataire='$username';");



/***********    Déconnexion de la DB        ************/
$file_db = null;