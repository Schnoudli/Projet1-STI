<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 14.10.2018
 * Time: 16:28
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portail de connexion</title>
    <style>

    </style>
</head>

<body>
    <form method="post" action="sendMessages.php">
        <label for="destinataire">Destinataire</label>
        <input type="text" id="destinataire" name="destinataire" placeholder="destinataire" value="" required><br><br>

        <label for="sujet">Sujet</label>
        <input type="text" id="sujet" name="sujet" placeholder="sujet" value="" required><br><br>

        <label for="message">Message</label>
        <input type="text" id="message" name="message" placeholder="message" value="" required><br><br>

        <input type="submit" value="submit">
    </form>
</body>
</html>