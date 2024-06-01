<?php
include('../../config.php');
$database = new Database();
$db = $database->dbConnection(); 
//print_r($_POST);

//$value = $_POST['editvalue'];
$id = $_POST['id'];

$sql= "Update `faculty`  Set Priority='".$_POST["editvalue"]."' where id='$id'"; 
 
$q = $db->query($sql) or die("failed!");
 	 
 								  
?>