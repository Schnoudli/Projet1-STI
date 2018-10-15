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
        .msgError
        {
            color : red;
            font-size : 200%;
            width: 300px;
            height: 40px;
        }
    </style>
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
