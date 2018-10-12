<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 12.10.2018
 * Time: 18:38
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

// Permet de récupérer l'id de l'utilisateur suivant qu'on soit admin ou non
if($_SESSION["admin"] === NULL) {
    $user = $_SESSION["user_id"];
}
// Récupére la variable dans la page accessible uniquement aux admins
else{
    $user = $user_id;
}

// Mise à jour du password
$result = $file_db->query("UPDATE Personne SET Pass = $password WHERE User_id=$user");