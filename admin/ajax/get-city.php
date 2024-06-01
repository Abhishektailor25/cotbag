<?php session_start(); 
require_once("../../config.php"); 
require_once("../../classes/class.common.php");
$Common=new COMMON();
if(isset($_POST['stateid']))
{ //$CountryId = $COMMON->get_require_data('country','Id','Name',$_POST['cont']);

   $allCity = $Common->getRows('city',array('where'=>array('stateid'=>$_POST['stateid'],'status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
				if(!empty($allCity)) {
			  	for($c=0;$c<count($allCity);$c++) {?>
                <option  value="<?php echo $allCity[$c]['id'] ?>"><?php echo $allCity[$c]['name'] ?></option>
                <?php }}}?>