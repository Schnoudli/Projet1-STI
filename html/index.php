<?php
/**
 * Created by PhpStorm.
 * User: Mitraillet
 * Date: 06/10/2018
 * Time: 10:54
 */

session_start();
if (!isset($_SESSION['startTime'])){
    $_SESSION['startTime'] = date('YmdHis');
    $_SESSION['log']= array();
}

require_once "INC/layout.html.inc.php";