<?php
class COMMON
{
	public $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	 public function setting()
	 {
		 try {
			 $sql="SELECT * FROM settings";
			 $q = $this->conn->query($sql) or die("failed!");
			 while($r = $q->fetch(PDO::FETCH_ASSOC)){  $data=$r;  } 
			 return $data;
			 }
			 catch(PDOException $e)
			 {
				 echo 'Query failed'.$e->getMessage();
			 }
	}
	
	// Genrate Random Password
	public	function random_password( $length = 6 )
	{
		$chars = "0123456789";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}	
	/* 
     * clear string remove unwanted content from string
     * @data string name of the data 
     */
	public function cleardeta($data)
	{
		// Fix &entity\n;
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		do
		{
			// Remove really unwanted tags
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);
		$data = $data;
		return $data;
	}
	/* 
     * make seo frendly url from string
     * @str string name of the data 
     */
	public function seo_friendly_url($str)
	{
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32'))
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		$str = strtolower( trim($str, '-') );
		return $str;
	}
	
	/* 
     * Redirect With Time
     * @url string name of the url 
     * @time in how many second page will be redirect
     */ 
	public function redirect($url,$data='',$time="0")
	{
		$inactive = 0.0000000000005;		
		$sessData['status']['msg'] = $data; 
		$_SESSION['sessData'] = $sessData; 		
		$_SESSION['expire'] = time()+$inactive; 		
		if($time!=0)
		{
			echo ("<script language='javaScript'> setTimeout(function(){window.location = '$url';, $time); </script>");
		}
		else
		{
			echo ("<script language='javaScript'> window.location = '$url';</script>");
		}
	}
	 public function getreletedproduct($pid,$id){  
		try {  
		
		   $sql=$this->conn->prepare("SELECT * FROM `tbl_product_list` WHERE `Status` = '1' and pid='$pid' and id!='$id' order by Rand() limit 4 ");
		   $sql->execute(); 
		   while($r = $sql->fetch(PDO::FETCH_ASSOC)){  $data[]=$r;  }  
		   if(!empty($data))
			   return $data;
			}
		   catch(PDOException $e)
		   {
				echo 'Query failed'.$e->getMessage();
		   }
		} 
	 /* 
     * Get data From the database 
     * @param string name of the table 
     * @param array the data for select from the table 
     * @param array where condition on Select data 
     */ 

	    public function selectcategory(){  
		try {  
		
		   $sql=$this->conn->prepare("SELECT * FROM `tbl_product` WHERE `Status` = '1' order by id desc ");
		   $sql->execute(); 
		   while($r = $sql->fetch(PDO::FETCH_ASSOC)){  $data[]=$r;  }  
		   if(!empty($data))
			   return $data;
			}
		   catch(PDOException $e)
		   {
				echo 'Query failed'.$e->getMessage();
		   }
		} 
	    public function selectSubCategory($id,$limit){  
		try {  
		
		   $sql=$this->conn->prepare("SELECT * FROM `tbl_product_list` WHERE `Status` = '1' and pid=$id order by id Asc Limit $limit");
		   $sql->execute(); 
		   while($r = $sql->fetch(PDO::FETCH_ASSOC)){  $data[]=$r;  }  
		   if(!empty($data))
			   return $data;
			}
		   catch(PDOException $e)
		   {
				echo 'Query failed'.$e->getMessage();
		   }
		} 
	public function getRows($table,$conditions = array())
	{
		
		$sql = 'SELECT '; 
		$sql .= array_key_exists("select",$conditions)?$conditions['select']:'*'; 
        $sql .= ' FROM '.$table; 
        if(array_key_exists("where",$conditions))
		{
			$sql .= ' WHERE '; 
			$i = 0; 
            foreach($conditions['where'] as $key => $value)
			{ 
                $pre = ($i > 0)?' AND ':''; 
                $sql .= $pre.$key." = '".$value."' "; 
                $i++; 
            } 
        }
		
		
		if(array_key_exists("where_in",$conditions))
		{
			//$sql .= ' WHERE '; 
			$i = 0; 
            foreach($conditions['where_in'] as $key => $value)
			{ 
                $pre = ($i > 0)?' AND ':'AND '; 
                $sql .= $pre.$key." IN ('".$value."')"; 
                $i++; 
            } 
        }           
      
		 if(array_key_exists("group_by",$conditions))
		{ 
            $sql .= ' GROUP BY '.$conditions['group_by'];  
        } 
		  if(array_key_exists("order_by",$conditions))
		{ 
            $sql .= ' ORDER BY '.$conditions['order_by'];  
        }        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions))
		{ 
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];  
        }
		elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions))
		{ 
            $sql .= ' LIMIT '.$conditions['limit'];  
        }    
		// echo $sql;     

        $query = $this->conn->prepare($sql); 
        $query->execute();          
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all')
		{
			switch($conditions['return_type'])
			{
				case 'count': $data = $query->rowCount(); 
				break; 
				case 'single': $data = $query->fetch(PDO::FETCH_ASSOC); 
				break;  default: $data = ''; 
            } 
        }
		else
		{ 
            if($query->rowCount() > 0)
			{ 
                $data = $query->fetchAll(); 
            } 
        } 
        return !empty($data)?$data:false; 
    }  

    /* 
     * Insert data into the database 
     * @param string name of the table 
     * @param array the data for inserting into the table 
     */ 

	 public function getproductdetailsbystyle($style){  
		try {  
		
		   $sql=$this->conn->prepare("SELECT * FROM `tbl_product_list` WHERE `Status` = '1' and style='$style' ");
		   $sql->execute(); 
		   $data = $sql->fetch(PDO::FETCH_ASSOC);	 
			   return $data;
		}
		   catch(PDOException $e)
		   {
				echo 'Query failed'.$e->getMessage();
		   }
		} 
		public function insert($table,$data)
		{ 
        if(!empty($data) && is_array($data)){ 
            $columns = ''; 
            $values  = ''; 
            $i = 0; 
            if(!array_key_exists('created',$data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists('modified',$data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
 
            $columnString = implode(',', array_keys($data)); 
            $valueString = ":".implode(',:', array_keys($data)); 
            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")"; 
            $query = $this->conn->prepare($sql); 
            foreach($data as $key=>$val){ 
                 $query->bindValue(':'.$key, $val); 
            } 
            $insert = $query->execute(); 
            return $insert?$this->conn->lastInsertId():false; 
        }else{ 
            return false; 
        } 
    } 
     
    /* 
     * Update data into the database 
     * @param string name of the table 
     * @param array the data for updating into the table 
     * @param array where condition on updating data 
     */ 
    public function update($table,$data,$conditions){ 
        if(!empty($data) && is_array($data)){ 
            $colvalSet = ''; 
            $whereSql = ''; 
            $i = 0; 
            if(!array_key_exists('modified',$data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
            foreach($data as $key=>$val){ 
                $pre = ($i > 0)?', ':''; 
                $colvalSet .= $pre.$key."='".$val."'"; 
                $i++; 
            } 
            if(!empty($conditions)&& is_array($conditions)){ 
                $whereSql .= ' WHERE '; 
                $i = 0; 
                foreach($conditions as $key => $value){ 
                    $pre = ($i > 0)?' AND ':''; 
                    $whereSql .= $pre.$key." = '".$value."'"; 
                    $i++; 
                } 
            } 
            $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql; 
			//echo $sql;
            $query = $this->conn->prepare($sql); 
            $update = $query->execute(); 
            return $update?$query->rowCount():false; 
        }else{ 
            return false; 
        } 
    } 
     
    /* 
     * Delete data from the database 
     * @param string name of the table 
     * @param array where condition on deleting data 
     */ 
    public function delete($table,$conditions){ 
        $whereSql = ''; 
        if(!empty($conditions)&& is_array($conditions)){ 
            $whereSql .= ' WHERE '; 
            $i = 0; 
            foreach($conditions as $key => $value){ 
                $pre = ($i > 0)?' AND ':''; 
                $whereSql .= $pre.$key." = '".$value."'"; 
                $i++; 
            } 
        } 
        $sql = "DELETE FROM ".$table.$whereSql; 
        $delete = $this->conn->exec($sql); 
        return $delete?$delete:false; 
    }
	
	 public function changedateformat($date)
	{
		$return = date('Y-m-d', strtotime(str_replace("/","-",$date)));
        return $return; 
    }
	
	 /* 
     * showindate Converto timestamp into date
     * @date timestamp of the date 
     * @return return date in validate date formate
     */ 
    public function showindate($date)
	{
		$return = date("d-m-y",strtotime($date));        
        return $return; 
    }
	 /* 
     * showindatendtime Converto timestamp into date
     * @date timestamp of the date 
     * @return return date in validate date formate
     */ 
	public function showindatendtime($date)
	{
		$return = date("d-m-y H:i",strtotime($date));        
        return $return; 
    }
	 /* 
     * showstatus Converto timestamp into date
     * @status showing Value 0 and 1 
     * @return return date in Active Or Inactive date
     */ 
	public function showstatus($status)
	{
		if($status==1)
		{
			$return  = '<span class="shadow-none badge badge-primary">Active</span>';
		}
		else		
		{
			$return  = '<span class="shadow-none badge badge-danger">Inactive</span>';
		}     
        return $return; 
    }
	
	 /* 
     * age Calculate age by using date of birth
     * @dob date of birth
     * @age return age in Year
     */ 
	public function age($dob)
	{
		  if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }  
    }
	public function get_require_data($table,$require, $column,$value)
	{
		try
		{
			$sql=$this->conn->prepare("SELECT $require FROM $table Where `$column`='$value'");
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($data))
			return $data[$require];
		}
		catch(PDOException $e)
		{
			echo 'Query failed'.$e->getMessage();
		}
	}
	public function sendmail($from,$to,$subject,$msg)

  {
		$mail = new PHPMailer;
		$Setings = $this->setting();
		$Domain = $Setings['LiveUrl'];
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = $Setings['SmtpHost'];
		$mail->Port = $Setings['SmtpPort'];
		$mail->SMTPSecure = 'auto';
		$mail->SMTPAuth = true;
		$mail->Username = $Setings['SmtpUsername'];
		$mail->Password = $Setings['SmtpPassword'];
		$mail->setFrom($from, $Setings['SiteName']);  
		$mail->addAddress($to);
		//$mail->AddBCC('dev2.cespl@gmail.com');
		$mail->AddBCC('ronakindustries07@gmail.com');
		$mail->isHTML(true);	
		$mail->Subject = $subject;
		$mail->msgHTML($msg);
		$mail->send(); 
	}
	
	public function sendmail_thanks($from,$to,$subject,$msg)
 	 {
	  	$mail = new PHPMailer;
		$Setings = $this->setting();
		$Domain = $Setings['LiveUrl'];
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = $Setings['SmtpHost'];
		$mail->Port = $Setings['SmtpPort'];
		$mail->SMTPSecure = 'auto';
		$mail->SMTPAuth = true;
		$mail->Username = $Setings['SmtpUsername'];
		$mail->Password = $Setings['SmtpPassword'];
		$mail->setFrom($from, $Setings['SiteName']);  
		$mail->addReplyTo($Setings['ReplyTo'], $Setings['SiteName']);
		$mail->addAddress($to);
		$mail->isHTML(true);
		$mail->msgHTML($msg);
		$mail->Subject = $subject;
		$mail->send();
	}	
	
	
	public function admissionform($name,$email,$pin_code,$percentage,$mobile,$dob,$enquiry_for,$address)
	{
		try
		{ 
			global $Domain;
			$stmt = $this->conn->prepare("INSERT INTO admission_form(name,email,mobile,address,pin_code,percentage,dob,enquiry_for) VALUES(:name,:email,:mobile,:address,:pin_code,:percentage,:dob,:enquiry_for)");
			$stmt->bindparam(":name", $name);
			$stmt->bindparam(":email", $email);
			$stmt->bindparam(":mobile", $mobile);
			$stmt->bindparam(":address", $address);
			$stmt->bindparam(":pin_code", $pin_code);
			$stmt->bindparam(":percentage", $percentage);
			$stmt->bindparam(":dob", $dob);
			$stmt->bindparam(":enquiry_for", $enquiry_for);
			$stmt->execute();
			//$SUPPORT = new SUPPORT;
			//$SUPPORT->sendmailadmission($name,$email,$pin_code,$percentage,$mobile,$dob,$enquiry_for,$address);
			return $stmt ;
     }
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	
	public function redirect_other($url)
	{
		//header("Location: $url");
		echo ("<SCRIPT LANGUAGE='JavaScript'>  window.location.href='$url'; </SCRIPT>");
		
	}	
	
	public function addcontact ($Name,$Email,$Mobile,$Message)
	{
		try
		{ 
			global $Domain;
			$stmt = $this->conn->prepare("INSERT INTO contact_us(`Name`,`Mobile`,`Email`,`Message`) VALUES(:Name,:Mobile,:Email,:Message)");
			$stmt->bindparam(":Name", $Name);
			$stmt->bindparam(":Mobile", $Mobile);
			$stmt->bindparam(":Email", $Email);
			$stmt->bindparam(":Message", $Message);
			$stmt->execute();
			$SUPPORT = new SUPPORT;
			$SUPPORT->sendmailcontact($Name,$Email,$Mobile,$Message);
			return $stmt ;
     }
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	public function addenquiry($Name,$Email,$Mobile,$Product_style,$Description)
	{
		try
		{ 
			global $Domain;
			$stmt = $this->conn->prepare("INSERT INTO enquiry_popup(`Name`,`Mobile`,`Email`,`Product_style`,`Description`) VALUES(:Name,:Mobile,:Email,:Product_style,:Description)");
			$stmt->bindparam(":Name", $Name);
			$stmt->bindparam(":Mobile", $Mobile);
			$stmt->bindparam(":Email", $Email);
			$stmt->bindparam(":Product_style", $Product_style);
			$stmt->bindparam(":Description", $Description);
			$stmt->execute();
			$SUPPORT = new SUPPORT;
			$SUPPORT->sendmailenquiry($Name,$Email,$Mobile,$Product_style,$Description);
			return $stmt ;
     }
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

	
	





}

?>