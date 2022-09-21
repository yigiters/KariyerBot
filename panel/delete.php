<?php 
include './func.php';
SessionCheck();

$id = $_GET['id'];

Delete($id);

?>