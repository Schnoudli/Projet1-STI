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

    $file_db = new PDO("sqlite:/usr/share/nginx/databases/database.sqlite");
    echo "Handle has been created ...... <br><br>";

}
catch(PDOException $e)
{
    echo $e->getMessage();
    echo "<br><br>Database -- NOT -- loaded successfully .. ";
    die( "<br><br>Query Closed !!! $error");
}

echo "Database loaded successfully ...." . "<br/>";

$name = $_POST["login"];
$password = $_POST["password"];
echo "name " . $name . "pass " . $password;
$result = $file_db->query("SELECT Actif, Username, Pass, Admin FROM Personne WHERE Username='$name' AND Pass='$password'");
if($result != NULL){
    foreach ($result as $row) {
        echo "Actif: " . $row['Actif'] . "<br/>";
        echo "Username: " . $row['Username'] . "<br/>";
        echo "Pass: " . $row['Pass'] . "<br/>";
        echo "Admin: " . $row['Admin'] . "<br/>";
        echo "<br/>";
    }
}
else{
    echo "Login impossible, aller prendre un café avec l'admin pour obtenir un compte";
}
?>