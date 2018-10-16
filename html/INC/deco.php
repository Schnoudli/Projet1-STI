<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 15/10/2018
 * Time: 14:56
 */

session_start();

unset($_SESSION["user_id"]);

header("Refresh:0");