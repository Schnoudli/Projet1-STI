<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */
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

$name = $_POST["login"];
$password = $_POST["password"];

$result = $file_db->query("SELECT Actif, Username, Pass, Admin FROM Personne WHERE Username='$name' AND Pass='$password'");
if($result === NULL){
    echo "Login impossible, aller prendre un café avec l'admin pour obtenir un compte";
}
else{
    foreach ($result as $row) {
        if(empty($row['Actif'])){
            echo "Compte inactif!" . "<br/>";
        }
        else{
            require_once 'webMail.html.inc.php';
            exit();
        }
    }
}