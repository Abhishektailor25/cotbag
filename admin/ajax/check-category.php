<?php require_once('../../config.php');
require_once ('../classes/class.common.php');
$Common = new COMMON();
if (!empty($_REQUEST['url'])) {
$testname = $Common->seo_friendly_url($_REQUEST['url']);
$categoryname = $testname.'/';
$data = $Common->category_already_exists($categoryname);
if ($data == 0) {
echo "true";  //good to register
} else {
echo "false"; //already registered
}
} else {
	echo "false"; //invalid post
}
