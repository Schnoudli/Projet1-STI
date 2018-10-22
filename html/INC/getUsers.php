<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 16/10/2018
 * Time: 19:21
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

// TODO: j'ai repris le code de get msg, mais ça fait des trucs bizarres
function setupUsers($arr) {
    $string="<div id='contentUsers'>";
    foreach ($arr as $row) {
        $string .= "<div><h3>". $row['Username']  ."</h3></div><hr>"
            . "<div id='headUsers'><span><strong>" . $row['Actif'] ."</strong></span>"
            . "<span style='float: right;'>". $row['Nom']."</span><br>"
            . "<span>à " . $row['Prenom'] . "</span></div><hr>"
            . "<div>" . $row['Admin'] . "</div>";
    }
    $string .="</div>";

    return $string;
}

/***********    Connexion à la DB OK     ************/
$user = $_SESSION["user_id"];
// Permet de récupérer tout les messages où l'on est le destinataire
$result = $file_db->query("SELECT * FROM Personne WHERE Personne.Admin='0';");

// Affichage des différents messages

$usr = setupUsers($result);

$arrToSend = array();
array_push($arrToSend, '#content', $usr ? $usr : 'Pas d\'utilisateur') ;
echo json_encode($arrToSend);


/***********    Déconnexion de la DB        ************/
$file_db = null;