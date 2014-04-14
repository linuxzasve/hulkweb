<?php
error_reporting(E_ALL);


$dirname = dirname($_SERVER['PHP_SELF']);

//ovo je zakomentirano jer će stvarati probleme na dev serveru i kod lokalnih instalacija
//za subfoldere bi isto trebalo ../ includeanje, pa moramo riješiti taj problem

//if($dirname = '/'){
require_once '_class/cms_class.php';
//}
//else {
require_once '../_class/cms_class.php';
//}

$obj = new modernCMS();

// Postavlja vezu s databazom - varijable veze
$obj->host = 'localhost';
$obj->username = 'pulsir_sql1';
$obj->password = 'mT+3X)dT2ez1w%7*e8';
$obj->db = 'pulsir_hulkweb';

// Spajanje na databazu
$obj->connect();
error_reporting(E_FATAL | E_ERROR);

?>
