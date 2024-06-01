<?php
require_once("../../config.php"); 
require_once("../classes/class.common.php");
$Common=new COMMON();
if (!empty($_REQUEST['url'])) {
$data = $Common->alreadyexisturl($_REQUEST['url']);
if ($data == 0) {
echo "true";  //good to register
} else {
echo "false"; //already registered
}
} else {
	echo "false"; //invalid post var
}
