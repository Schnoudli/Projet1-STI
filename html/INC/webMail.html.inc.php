<?php /*  Protection de fichier */
  if ( count( get_included_files() ) == 1) die( '--access denied--' );
?>
<body>
    <div id="top">
        <input type="button" value="Changer de mot de passe">
        <input type="button" value="Nouveau message">
        <input type="button" value="Déconnexion" onclick="deconnexion()" >
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