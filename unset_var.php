<?php  session_start();
	if(isset($_SESSION['sessData'])){ 
		unset($_SESSION['sessData']); 
	} 
?> 