<?php /*  Protection de fichier */
if ( count( get_included_files() ) == 1) die( '--access denied--' );
?>
<form action="javascript:login()">
    <label for="login">Login</label>
    <input type="text" id="login" name="login" placeholder="email" value="steve.henriquet" required><br><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="password" value="pass" required><br><br>
    <input type="submit" value="submit">
</form>
<div class="msgError" id="msgErrorId"></div>