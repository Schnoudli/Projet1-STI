<?php /*  Protection de fichier */
  if ( count( get_included_files() ) == 1) die( '--access denied--' );
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portail Mail</title>
    <style>
        #top{
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid gray;
        }
        main{
            display: flex;
        }
        #lateral{
            flex: 1;
            border-right: 1px solid gray;
            height: 100vh;
        }
        #content{
            flex: 9;
        }
    </style>
</head>
<body>
    <div id="top">
        <input type="button" value="Changer de mot de passe">
        <input type="button" value="Nouveau message">
        <input type="button" value="Déconnexion">
    </div>
    <main>
        <div id="lateral">
            <p>Boite de réception</p>
            <p>Messages envoyés</p>
            <p>Messages supprimés</p>
        </div>
        <div id="content">
            <?php
            echo "User id is " . $_SESSION["user_id"] . ".<br>";
            echo "Admin is " . $_SESSION["admin"] . ".<br>";
            $user = $_SESSION["user_id"];
            include "getMessages.php";
            ?>
        </div>
    </main>
</body>
</html>