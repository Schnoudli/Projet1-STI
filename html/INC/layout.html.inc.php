<?php /*  Protection de fichier */
if ( count( get_included_files() ) == 1) die( '--access denied--' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portail de connexion</title>
    <style>
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
<body>
    <form action="javascript:login()">
        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="email" value="test.bob" required><br><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="password" value="password" required><br><br>
        <input type="submit" value="submit">
    </form>
    <div class="msgError" id="msgErrorId"></div>
</body>
</html>