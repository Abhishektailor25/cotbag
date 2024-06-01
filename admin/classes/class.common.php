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
	public function setting()
	{
		try
		{
			$q = $this->conn->query("SELECT * FROM settings") or die("failed!");
			while($r = $q->fetch(PDO::FETCH_ASSOC))
			{
				$data=$r;
			}  
    		return $data;
		}
       catch(PDOException $e)
		{
			echo 'Query failed'.$e->getMessage();
		}
	}
	/* 
     * Redirect With Time
     * @url string name of the url 
     * @time in how many second page will be redirect
     */ 
	public function redirect($url,$data='',$time="0")
	{
		$inactive = 0.0001;		
		$sessData['status']['msg'] = $data; 
		$_SESSION['sessData'] = $sessData; 		
		$_SESSION['expire'] = time() + $inactive; 		
		if($time!=0)
		{
			echo ("<script language='javaScript'> setTimeout(function(){window.location = '$url';, $time); </script>");
		}
		else
		{
			echo ("<script language='javaScript'> window.location = '$url';</script>");
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
    public function select_all_data_by_given_order_by_status($table,$stcolumn,$status,$column,$order)
    {
        try {
            
            
            $sql=$this->conn->prepare("SELECT * FROM $table Where `$stcolumn`='$status' order by $column $order ");
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
                $sql .= $pre.$key." = '".$value."'"; 
                $i++; 
            } 
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
		$return = date("d-m-Y H:i",strtotime($date));        
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
			$return  = '<span class="badge text-white bg-dark-pastel-green">Active</span>';
		}
		else		
		{
			$return  = '<span class="badge text-white bg-red">Inactive</span>';
		}     
        return $return; 
    }
    public function showvideo($status)
	{
		if($status==1)
		{
			$return  = '<span class="badge text-white bg-dark-pastel-green">Home Page Show</span>';
		}
		else		
		{
			$return  = '<span class="badge text-white bg-red">Home Page Not Show</span>';
		}     
        return $return; 
    }
	
}
?>