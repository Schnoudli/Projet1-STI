<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */
session_start();

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

// Permet de récupérer le login et le password passé depuis la page de connection
$name = $_POST["login"];
$password = $_POST["password"];

// Permet de regarder que notre user, ainsi que sont mdp figre dans notre DB
$result = $file_db->query("SELECT Actif, User_id, Admin FROM Personne WHERE Username='$name' AND Pass='$password'");

// Nous indique que le login et mot de passe tapé ne match pas

function checkLogin($arr) {
    $bool = true;
    foreach ($arr as $row) {
        // Permet de savoir si l'utilisateur courant est actif ou non
        if(empty($row['Actif'])){
            echo "Compte inactif!" . "<br/>";
        }
        else{
            // Permet de setter les variables de session utile pour toute la connection
            $_SESSION["user_id"] = $row['User_id'];
            if(empty($row['Admin'])){
                $_SESSION["admin"] = false;
            }
            else{
                $_SESSION["admin"] = true;
            }
            require_once 'webMail.html.inc.php';
        }
    }
    return $bool;
}

if(checkLogin($result)){
    echo "Login impossible, aller prendre un café avec l'admin pour obtenir un compte";
}