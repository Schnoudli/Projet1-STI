<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 14.10.2018
 * Time: 16:28
 */

$string = '<form action="javascript:sendMessage()">'
        .'<label for="destinataire">Destinataire</label>'
        .'<input type="text" id="destinataire" name="destinataire" placeholder="destinataire" value="" required><br><br>'
        .'<label for="sujet">Sujet</label>'
        .'<input type="text" id="sujet" name="sujet" placeholder="sujet" value="" required><br><br>'
        .'<label for="message">Message</label>'
        .'<input type="text" id="message" name="message" placeholder="message" value="" required><br><br>'
        .'<input type="submit" value="submit">'
        .'</form>';


$arrToSend = array();
array_push($arrToSend, '#content', $string) ;
echo json_encode($arrToSend);