<?php

/**
 * 
 */
class Main
{
	private $db;
	function __construct($db)
	{
		$this->_db = $db;
	}

	function login()
	{
		if (isset($_POST['btn'])) {
			$user=$_POST['username'];
			$pw=md5($_POST['password']);
			if (!empty($user) AND !empty($pw)) {
				$sql = $this->_db->prepare("SELECT * FROM `users` WHERE contact_info=:user AND password=:pw");
				$sql->execute(array("user"=>$user,"pw"=>$pw));
				if ($sql->rowCount()) {
					$data=$sql->fetch();
					$_SESSION['id']=$data['id'];
					$_SESSION['id']=true;
					$_SESSION['username']  = $data['firstname'];
			        $_SESSION['email_of_user'] = $data['email'];
			        $_SESSION['userid'] = $data['id'];
			        $type = $data['type'];
			        if ($type==1) {
			        	header('location:admin/dashboard.php');
			        } if ($type==3) {
			        	header('location:index.php');
			        } 
			       
			        
			        // $softwarelang=$_POST['language'];
			        
			        
			        	
			        
			    
			   
				} else{
					$_SESSION['error']='username and password are wrong';
				}
			} else{
				$_SESSION['error']='please enter username and password';
			}
		}
	}












}


?>