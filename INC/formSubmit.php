<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 02/10/2018
 * Time: 08:54
 */
    $db = new SQLite3( "sqlite", SQLITE3_OPEN_READWRITE);
    $name = $_POST["login"];
    $password = $_POST["password"];
    $result = $db->query("SELECT login FROM ????");

