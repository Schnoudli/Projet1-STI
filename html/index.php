<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 06/10/2018
 * Time: 10:54
 */

session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Portail Mail</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
    <script type="text/javascript" src="JS/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="JS/ajax.js"></script>
</head>
<?php if (isset($_SESSION["user_id"])){
    require_once "INC/webMail.html.inc.php";
}
else{
    require_once "INC/layout.html.inc.php";
}?>
</html>
