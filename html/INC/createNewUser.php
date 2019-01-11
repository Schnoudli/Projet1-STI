<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 16:48
 */

session_start();

if($_SESSION['admin']) {
    /***********    Phase de connection à la databases     ************/
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

    $pass = filter_var ( $_POST["pass"], FILTER_SANITIZE_STRING);
    $passCheck = filter_var ( $_POST["passCheck"], FILTER_SANITIZE_STRING);

    if($pass !== $passCheck){
        echo "Veuillez taper le même mot de passe!";
    }
    else{
        $firstname = filter_var ( $_POST["firstname"], FILTER_SANITIZE_STRING);
        $lastname = filter_var ( $_POST["lastname"], FILTER_SANITIZE_STRING);
        $isActif = $_POST["isActif"]==='true' ? 1 : 0;
        $isAdmin = $_POST["isAdmin"]==='true' ? 1 : 0;

        $username = $firstname.'.'.$lastname;
        $username = strtolower($username);
        $usernameDb = '';

        $sth = $file_db->prepare("SELECT Username FROM Personne WHERE Username=:username");
        $sth->execute(array(':username' => $username));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $usernameDb = $row['Username'];
        }
        if($username == $usernameDb){
            echo "Utilisateur déjà existant";
        }
        else {
            $sth = $file_db->prepare("INSERT INTO Personne (Actif, Nom, Prenom, Username, Pass, Admin) VALUES (:isActif, :lastname, :firstname, :username, :passCheck, :isAdmin)");
            $sth->execute(array(':isActif' => $isAdmin, ':lastname' => $lastname, ':firstname' => $firstname, ':username' => $username, ':passCheck' => $passCheck, ':isAdmin' => $isAdmin));
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            $result = $file_db->query();
            echo "Utilisateur créé avec succès";
        }
    }

    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}
else {
    header('Location: ../index.php');
    exit();
}