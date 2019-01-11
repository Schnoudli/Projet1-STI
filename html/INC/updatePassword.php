<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 12.10.2018
 * Time: 18:38
 */

session_start();

if (isset($_SESSION["user_id"])) {
    /***********    Phase de connection à la databases     ************/
    try {
        /*** connect to SQLite database ***/

        $file_db = new PDO("sqlite:../../databases/database.sqlite");

    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<br><br>Database -- NOT -- loaded successfully .. ";
        die("<br><br>Query Closed !!!");
    }

    /***********    Connection à la databases OK     ************/

    $user_id = filter_var($_SESSION["user_id"], FILTER_SANITIZE_STRING);
    $oldPass = filter_var($_POST["oldPass"], FILTER_SANITIZE_STRING);
    $newPass = filter_var($_POST["newPass"], FILTER_SANITIZE_STRING);
    $newPassCheck = filter_var($_POST["newPassCheck"], FILTER_SANITIZE_STRING);

    if ($newPass !== $newPassCheck) {
        echo "Veuillez taper le même mot de passe!";
    } else {
        $dbPass = '';
        $sth = $file_db->prepare("SELECT Pass FROM Personne WHERE User_id = :user_id;");
        $sth->execute(array(':user_id' => $user_id));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $dbPass = $row['Pass'];
        }
        if ($oldPass == $dbPass) {
            $sth = $file_db->prepare("UPDATE Personne SET Pass = :newPass WHERE User_id = :user_id");
            $sth->execute(array(':newPass' => $newPass, ':user_id' => $user_id));
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            echo "Mot de passe mis à jour avec succès";
        } else {
            echo "Mot de passe erroné!";
        }
    }

    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}
else {
    header('Location: ../index.php');
    exit();
}