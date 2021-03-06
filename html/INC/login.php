<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */

require_once "manageLayout.php";

session_start();

//in your php ignore any submissions that inlcude this field
if(!empty($_POST['login_spam'])) {
    $arrToSend = array();
    array_push($arrToSend, "#msgErrorId", "die spamming bot") ;
    die(json_encode($arrToSend));
}

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

/***********    Connection à la databases OK     ************/

// Permet de récupérer le login et le password passé depuis la page de connection

$name = filter_var ( $_POST["login"], FILTER_SANITIZE_STRING);
$password = filter_var ( $_POST["password"], FILTER_SANITIZE_STRING);

// Permet de regarder que notre user, ainsi que sont mdp figre dans notre databases
$sth = $file_db->prepare("SELECT Actif, User_id, Admin, Username FROM Personne WHERE Username=:name AND Pass=:password");
$sth->execute(array(':name' => $name, ':password' => $password));
$result = $sth->fetchAll(PDO::FETCH_ASSOC);


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