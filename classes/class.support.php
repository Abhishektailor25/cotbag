<?php
class SUPPORT extends COMMON
{	
public function headofmail($Domain)
{ $COMMON = new COMMON;	
$Head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cotton Bags Manufacturer In India, Cotton Bags India, Cotton Tote & Cotton Bags Suppliers & Wholesalers in Delhi, India</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
  .container {
    padding: 20px 10px !important;
}
.mobile-shell {
    width: 100% !important;
    min-width: 100% !important;
}
.p30-15 {
    padding: 30px 15px !important;
}
.container {
    padding: 20px 10px !important;
}
}
</style>
</head>
<body style="margin: 0; padding: 0;background: #828486;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td style="padding: 10px 0 30px 0;" class="td container">
   <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" class="mobile-shell" style="border-collapse: collapse;">
    <tr>
     <td class="p30-15" align="center" bgcolor="#fff" style="padding: 20px 0 15px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;border-radius: 26px 26px 0px 0px;border-bottom: 1px solid #d8d8d8;"> <a href="'.$Domain.'" target="_blank" rel="noopener noreferrer"> <img src="'.$Domain.'images/logo.jpg" alt="logo" width="400" height="102" style="display: block;" /> </a> </td>
    </tr>';
	  return $Head;	
}
	
public function headoffooter($Domain)
{ $COMMON = new COMMON;	
   $Footer = '<tr>
     <td bgcolor="#222933" style="padding: 50px 15px 50px 20px;border-radius: 0px 0px 26px 26px;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
            <td align="center" style="padding-bottom: 30px;">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
              <td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="https://www.facebook.com/Ronak-Industries-1010506119006409/" target="_blank"><img src="'.$Domain.'images/fb.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" /></a></td>
             <td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="https://www.instagram.com/cot_bags/" target="_blank"><img src="'.$Domain.'images/insta.png" alt="insta" width="38" height="38" style="display: block;" border="0" /></a></td>
              <td class="img" width="38" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="https://twitter.com/cotbags2" target="_blank"><img src="'.$Domain.'images/twit.png" alt="twitter" width="38" height="38" style="display: block;" border="0" /></a></td>
             </tr>
             </table>
           </td>
           </tr>
           <tr>
            <td style="color:#fff; font-size:15px; font-family:Arial,sans-serif; line-height:26px; text-align:center;"> <a href="mailto:info@cotbags.com" style="color: #ffffff; text-decoration:none;">info@cotbags.com</a>
            
           </td>
           </tr>
           <tr>
           <td style="color:#fff; font-family:Arial,sans-serif; font-size:15px; line-height:26px; text-align:center;"> Copyright ©2024 Ronak Industries. All Rights Reserved</td>
           </tr>
       </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</body>
</html>';
return $Footer;	
}

/***********************************************contact Enquiry***********************************************************/

	 public	function sendmailcontact($Name,$Email,$Mobile,$Message)
{   
			$COMMON = new COMMON; 
			$Setting = $COMMON->setting();
				if($Setting['Mode']==1)
				{
				$Domain = $Setting['LiveUrl'];
				}
				if($Setting['Mode']==0)
				{
				$Domain = $Setting['DemoUrl'];
				}
	$SiteName = $Setting['SiteName']; 
	$msg=''.$this->headofmail($Domain).'      
 <tr>
 <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>
    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;text-align: center;"> <b>Hey..! Admin</b> </td>
   </tr>
   <tr>
    <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;"> New enquiry generated. Please Check it </td>
   </tr>
   <tr>
    <td style="color: #153643; font-family: Arial, sans-serif; text-align: center;">
     <table width="100%" border="1" cellspacing="1" cellpadding="3">
      <tr>
       <td> Name </td>
       <td>'.$Name.'</td>
      </tr>
      <tr>
       <td>Email</td>
       <td>'.$Email.'</td>
      </tr>
      <tr>
       <td>Mobile No.</td>
       <td>'.$Mobile.'</td>
      </tr>
      <tr>
       <td>Message.</td>
       <td>'.$Message.'</td>
      </tr>
     </table>
    </td>
   </tr>
  </table>
 </td>
</tr>
'.$this->headoffooter($Domain).' ';

$COMMON->sendmail($Setting['ReplyTo'],$Setting['admin_email'],'Contact Enquiry',$msg);
/*************************************Thanks mail For User ************************************/
$msgs=' '.$this->headofmail($Domain).'       
     <tr>
     <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <tr>
        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;text-align: center;"> <b>Welcome '.$name.' !</b> </td>
       </tr>
       <tr>
         <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;"> Thank you for your interest with <strong> '.$SiteName.' </strong>. We are excited to hear from you. However, please do not hesitate to contact us for further clarification if need be. Our Representative will call you soon. </td>
       </tr>
       <tr>
        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;text-align: center;"><a href="'.$Domain.'" style="background: #ff6666;
   color: #fff;font-size: 14px;line-height: 18px; padding: 12px 30px;text-align: center;border-radius: 0px 22px 22px 22px;font-weight: bold; text-decoration: none;"> <b> Go To Website </b></a> </td>
       </tr>
      </table>
     </td>
    </tr>    
'.$this->headoffooter($Domain).' ';	
$COMMON->sendmail_thanks($Setting['ReplyTo'],$Email,'Thank You For Submit Query ('.$SiteName.')',$msgs);
}


/***********************************************send mail for product detain enquiry***********************************************************/

	 public	function sendmailenquiry($Name,$Email,$Mobile,$Product_style,$Description)
{   
			$COMMON = new COMMON; 
			$Setting = $COMMON->setting();
				if($Setting['Mode']==1)
				{
				$Domain = $Setting['LiveUrl'];
				}
				if($Setting['Mode']==0)
				{
				$Domain = $Setting['DemoUrl'];
				}
	$SiteName = $Setting['SiteName']; 
	$msg=''.$this->headofmail($Domain).'      
 <tr>
 <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>
    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;text-align: center;"> <b>Hey..! Admin</b> </td>
   </tr>
   <tr>
    <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;"> New enquiry generated. Please Check it </td>
   </tr>
   <tr>
    <td style="color: #153643; font-family: Arial, sans-serif; text-align: center;">
     <table width="100%" border="1" cellspacing="1" cellpadding="3">
      <tr>
       <td> Name </td>
       <td>'.$Name.'</td>
      </tr>
      <tr>
       <td>Email</td>
       <td>'.$Email.'</td>
      </tr>
      <tr>
       <td>Mobile No.</td>
       <td>'.$Mobile.'</td>
      </tr>
     
      <tr>
       <td>Product Style.</td>
       <td>'.$Product_style.'</td>
      </tr>
	  <tr>
       <td>Description.</td>
       <td>'.$Description.'</td>
      </tr>
	 
     </table>
    </td>
   </tr>
  </table>
 </td>
</tr>
'.$this->headoffooter($Domain).' ';
$COMMON->sendmail($Setting['ReplyTo'],$Setting['admin_email'],'Product Enquiry',$msg);
/*************************************Thanks mail For User ************************************/
$msgs=' '.$this->headofmail($Domain).'       
     <tr>
     <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
       <tr>
        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;text-align: center;"> <b>Welcome '.$Name.' !</b> </td>
       </tr>
       <tr>
         <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;"> Thank you for your interest with <strong> '.$SiteName.' </strong>. We are excited to hear from you. However, please do not hesitate to contact us for further clarification if need be. Our Representative will call you soon. </td>
       </tr>
       <tr>
        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;text-align: center;"><a href="'.$Domain.'" style="background: #ff6666;
   color: #fff;font-size: 14px;line-height: 18px; padding: 12px 30px;text-align: center;border-radius: 0px 22px 22px 22px;font-weight: bold; text-decoration: none;"> <b> Go To Website </b></a> </td>
       </tr>
      </table>
     </td>
    </tr>    
'.$this->headoffooter($Domain).' ';	
$COMMON->sendmail_thanks($Setting['ReplyTo'],$Email,'Thank You For Submit Query ('.$SiteName.')',$msgs);
}



}

?>