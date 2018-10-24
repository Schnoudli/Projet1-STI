<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 16:48
 */

session_start();

if($_SESSION['admin']) {
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

    $pass = $_POST["pass"];
    $passCheck = $_POST["passCheck"];

    if($pass !== $passCheck){
        echo "Veuillez taper le même mot de passe!";
    }
    else{
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $isActif = $_POST["isActif"]==='true' ? 1 : 0;
        $isAdmin = $_POST["isAdmin"]==='true' ? 1 :  0;

        $username = $firstname.'.'.$lastname;
        $username = strtolower($username);
        $usernameDb = '';

        $result = $file_db->query("SELECT Username FROM Personne WHERE Username='" . $username . "';");
        foreach ($result as $row) {
            $usernameDb = $row['Username'];
        }
        if($username == $usernameDb){
            echo "Utilisateur déjà existant";
        }
        else {
            $result = $file_db->query("INSERT INTO Personne (Actif, Nom, Prenom, Username, Pass, Admin) VALUES ('$isActif', '$lastname', '$firstname', '$username', '$passCheck', '$isAdmin');");
            echo "Utilisateur créé avec succès";
        }
    }

    /***********    Déconnexion de la DB        ************/
    $file_db = null;
}