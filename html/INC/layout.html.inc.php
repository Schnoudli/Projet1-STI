<?php /*  Protection de fichier */
if ( count( get_included_files() ) == 1) die( '--access denied--' );
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
    <form method="post" action="INC/formSubmit.php">
        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="email" value="test.bob" required><br><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="password" value="password" required><br><br>
        <input type="submit" value="submit">
    </form>
</body>
</html>