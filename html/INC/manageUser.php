<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 22/10/2018
 * Time: 15:00
 */

session_start();

if($_SESSION['admin']) {
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

    if($_POST['context']==='update'){
        $userId = $_POST['userId'];
        $newMdp = $_POST['newMdp'];
        $isActif = $_POST["isActif"]==='true' ? 1 : 0;
        $isAdmin = $_POST["isAdmin"]==='true' ? 1 :  0;
        $result = $file_db->query("UPDATE Personne SET Actif='$isActif', Pass='$newMdp', Admin='$isAdmin' WHERE User_id ='$userId'");
    }
    elseif ($_POST['context']==='delete'){
        $userId = $_POST['userId'];
        $result = $file_db->query("DELETE FROM Personne WHERE User_id='$userId'");
    }
    /***********    Déconnexion de la DB        ************/
    $file_db = null;
}