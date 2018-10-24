<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */

require_once "manageLayout.php";

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

// Permet de récupérer le login et le password passé depuis la page de connection

$name = $_POST["login"];
$password = $_POST["password"];

// Permet de regarder que notre user, ainsi que sont mdp figre dans notre DB
$result = $file_db->query("SELECT Actif, User_id, Admin, Username FROM Personne WHERE Username='$name' AND Pass='$password'");

// Nous indique que le login et mot de passe tapé ne match pas
function chargeTemplate(){
    //$name = "cc"; //Test pour l'erreur
    $filename = 'INC/webmail.html.inc.php';
    return file_exists($filename) ? implode("\n", file($filename)) : false;
}

function checkLogin($arr) {
    $bool = true;
    $arrToSend = array();
    foreach ($arr as $row) {
        // Permet de savoir si l'utilisateur courant est actif ou non
        if(empty($row['Actif'])){
            array_push($arrToSend, "error", "Compte inactif!" . "<br/>") ;
            echo json_encode($arrToSend);
            $bool = false;
        }
        else{
            // Permet de setter les variables de session utile pour toute la connection
            $_SESSION["user_id"] = $row['User_id'];
            $_SESSION["username"] = $row['Username'];
            if(empty($row['Admin'])){
                $_SESSION["admin"] = 0;
            }
            else{
                $_SESSION["admin"] = 1;
            }
            array_push($arrToSend, "body", manageLayout()) ;
            echo json_encode($arrToSend);
            $bool = false;
        }
    }
    return $bool;
}

if(checkLogin($result)){
    $arrToSend = array();
    array_push($arrToSend, "#msgErrorId", "Login impossible, aller prendre un café avec l'admin pour obtenir un compte") ;
    echo json_encode($arrToSend);
}