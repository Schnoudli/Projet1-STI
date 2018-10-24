<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 12.10.2018
 * Time: 18:38
 */

session_start();
/***********    Phase de connection à la DB     ************/
try
{
    /*** connect to SQLite database ***/

    $file_db = new PDO("sqlite:../../databases/database.sqlite");

}
catch(PDOException $e)
{
    echo $e->getMessage();
    echo "<br><br>Database -- NOT -- loaded successfully .. ";
    die( "<br><br>Query Closed !!!");
}

/***********    Connection à la DB OK     ************/

    $user_id =  $_SESSION["user_id"];
    $oldPass = $_POST["oldPass"];
    $newPass = $_POST["newPass"];
    $newPassCheck = $_POST["newPassCheck"];

    if($newPass !== $newPassCheck){
        echo "Veuillez taper le même mot de passe!";
    }
    else{
        $dbPass = '';
        $result = $file_db->query("SELECT Pass FROM Personne WHERE User_id ='" . $user_id . "';");
        foreach ($result as $row) {
            $dbPass = $row['Pass'];
        }
        if($oldPass == $dbPass){
            $result = $file_db->query("UPDATE Personne SET Pass = '" . $newPass . "' WHERE User_id ='" . $user_id . "';");
            echo "Mot de passe mis à jour avec succès";
        }
        else {
            echo "Mot de passe erroné!";
        }
    }

/***********    Déconnexion de la DB        ************/
$file_db = null;