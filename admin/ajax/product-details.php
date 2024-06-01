<?php require_once("../../config.php");  require_once("../classes/class.common.php");   $Common=new COMMON();
$productid = $_REQUEST['productid']; 

 $AllData = $Common->getRows('product',array('where'=>array('id'=>$productid),'return_type'=>'single'));
$category = ($AllData['categroyid']!='') ? $Common->getRows('category',array('where'=>array('id'=>$AllData['categroyid']),'limit'=>1,'return_type'=>'single')): ""; 				
$subcategory = ($AllData['subcategoryid']!='') ? $Common->getRows('subcategory',array('where'=>array('id'=>$AllData['subcategoryid']),'limit'=>1,'return_type'=>'single')): ""; 	
//$mill = $Common->getRows('masters',array('where'=>array('id'=>$AllData['millid']),'limit'=>1,'return_type'=>'single'));	
//$shade = $Common->getRows('masters',array('where'=>array('id'=>$AllData['shadeid']),'limit'=>1,'return_type'=>'single'));	
//$gsm = $Common->getRows('masters',array('where'=>array('id'=>$AllData['gsmid']),'limit'=>1,'return_type'=>'single')); 	

$gsm = $AllData['gsmid'];
//$size = $Common->getRows('masters',array('where'=>array('id'=>$AllData['sizeid']),'limit'=>1,'return_type'=>'single'));	
//$grade = $Common->getRows('masters',array('where'=>array('id'=>$AllData['gradeid']),'limit'=>1,'return_type'=>'single'));	 
$state = ($AllData['state']!='') ? $Common->getRows('state',array('where'=>array('id'=>$AllData['state']),'limit'=>1,'return_type'=>'single')) : ""; 				
$country = ($AllData['country']!='') ? $Common->getRows('country',array('where'=>array('id'=>$AllData['country']),'limit'=>1,'return_type'=>'single')) : ""; 
$city = ($AllData['city']!='') ? $Common->getRows('city',array('where'=>array('id'=>$AllData['city']),'limit'=>1,'return_type'=>'single')) : "";
	  
 ?>
<div class="table-responsive">
   <table class="table table-bordered" width="100%" cellspacing="0"> 
           <tbody>
            <tr>                                
                <th>Categroy </th>
                <td> <?php echo $category['name'];  if($AllData['categroyid']==15) { echo ' ('.$subcategory['name'].')';}?> </td> 
                <th>Name </th>
                <td> <?php echo $AllData['name']; ?></td>
            </tr> 
           
              <tr>                                
                <th>Stock</th>
                <td> <?php echo $AllData['stock']; ?></td>
                                               
                <th>Weight</th>
                <td> <?php echo $AllData['weight']; ?></td>
            </tr>  
             <tr>                                
                <th>Price </th>
                <td> Rs.<?php echo $AllData['price']; ?></td>
            
            
            <tr>                                
                <th>Mill </th>
                <td> <?php echo $AllData['millid']; ?></td>
                                          
                <th>Shade </th>
                <td> <?php echo $AllData['shadeid']; ?></td>
            </tr> 
             
             <tr>                                
                <th>Gsm </th>
                <td> <?php echo $AllData['gsmid']; ?></td>
                                          
                <th>Size</th>
                <td> <?php echo $AllData['sizeid']; ?></td>
            </tr> 
            <tr>
                <th>Country:</th>
                <td><?php if($AllData['country']!='') { echo $country['name']; }?></td>
            
                <th>State:</th>
                <td><?php if($AllData['state']!='') { echo $state['name'];} ?></td>
            </tr>
            <tr>
                <th>City:</th>
                <td colspan="4"><?php if($AllData['city']!='') { echo $city['name'];} ?></td>
            </tr>
             <tr>
                <th>Image:</th>
                <td colspan="4"><img src="../uploads/product/<?php echo $AllData['image'] ?>" style="width:200px;"/></td>
            </tr>
         </tbody>
                
             
            </table>
</div>
