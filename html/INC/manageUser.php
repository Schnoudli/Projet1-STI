<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 15:00
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

    $isAdmin;
    $userIdSession = $_SESSION["user_id"];

    $sth = $file_db->prepare("SELECT Admin FROM Personne WHERE User_id =:userId");
    $sth->execute(array(':userId' => $userIdSession));
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $isAdmin = $row['Admin'];
        $_SESSION['admin'] = $row['Admin'];
    }

    if($isAdmin) {
        if ($_POST['context'] === 'update') {
            $userId = $_POST['userId'];
            $newMdp = $_POST['newMdp'];
            $isActif = $_POST["isActif"] === 'true' ? 1 : 0;
            $isAdmin = $_POST["isAdmin"] === 'true' ? 1 : 0;

            $sth = $file_db->prepare("UPDATE Personne SET Actif=:isActif, Pass=:newMdp, Admin=:isAdmin WHERE User_id =:userId");
            $sth->execute(array(':isActif' => $isActif, ':newMdp' => $newMdp, ':isAdmin' => $isAdmin, ':userId' => $userId));
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        } elseif ($_POST['context'] === 'delete') {
            $userId = $_POST['userId'];
            if ($userIdSession !== $userId) {
                $result = $file_db->query("DELETE FROM Personne WHERE User_id='$userId'");
            }
        }
    }
    /***********    Déconnexion de la databases        ************/
    $file_db = null;
}
else {
    header('Location: ../index.php');
    exit();
}