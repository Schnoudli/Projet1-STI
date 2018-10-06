<?php /*  Protection de fichier */
//if ( count( get_included_files() ) == 1) die( '--access denied--' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portail Mail</title>
    <style>
        #top{
            text-align: left;
            width: inherit;
        }
        main{
            display: flex;
        }
        #lateral{
            flex: 1;
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

        </div>
    </main>
</body>
</html>