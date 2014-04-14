<?php
include 'boot.php';
if(isset($_GET['id'])){
$obj->read_content($_GET['id']);
}
else{
$obj->errors(404);
}
?>
