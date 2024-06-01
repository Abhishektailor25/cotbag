<?php 
class LOGIN extends COMMON
{
	public function doLogin($username,$pass,$remember_me)
	{
		try
		{
			 
			$COMMON = new COMMON; 
			$stmt = $COMMON->conn->prepare("SELECT * FROM admin WHERE status=:status and username=:username ");
			$stmt->execute(array(':username'=>$username,':status'=>"1"));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($pass, $userRow['password']))
				{
					if($remember_me=='1' || $remember_me=='on')
					{
						$hour = time() + 3600 * 24 * 30;
						setcookie('pausername', $username, $hour);
						setcookie('papassword', $pass, $hour);
					}
					$_SESSION['pasessid'] = $userRow['id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function is_loggedin()
	{
		if(isset($_SESSION['pasessid']))
		{
			return true;
		}
	} 
	public function doLogout()
	{
		unset($_SESSION['pasessid']);
		return true;
	}
}
?>