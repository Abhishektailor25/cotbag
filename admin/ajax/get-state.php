<?php session_start(); 
require_once("../../config.php"); 
require_once("../../classes/class.common.php");
$Common=new COMMON();
if(isset($_POST['countryid']))
{ //$CountryId = $COMMON->get_require_data('country','Id','Name',$_POST['cont']);

   $allStates = $Common->getRows('state',array('where'=>array('countryid'=>$_POST['countryid'],'status'=>'1'),'return_type'=>'all','order_by'=>'id asc'));
				if(!empty($allStates)) {
			  	for($c=0;$c<count($allStates);$c++) {?>
                <option  value="<?php echo $allStates[$c]['id'] ?>"><?php echo $allStates[$c]['name'] ?></option>
                <?php }}}?>