<?php
	include_once 'Session.php';
	include'Database.php';

class User
{
	private $db;
	
	public function __construct()
	{
		$this->db=new Database();
	}
	public function userRegistration($data)
	{
		$name	=$data['name'];
		$username=$data['username'];
		$email	=$data['email'];
		$chk_email=$this->emailcheck($email);
		$password=md5($data['password']);

		if ($name=="" AND $username=="" AND $email=="" AND $password=="") {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Must Need to Fill 
			All Field</div>";
			 return $msg;
		}

		if (strlen($username)<5) {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>UserName Must Be 
			Greater Than 5</div>";
			 return $msg;
		}
		elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>UserName Must Be 
			Only Content alphanumerical,dashes and underscores</div>";
			 return $msg;
		}

		if (filter_var($email,FILTER_VALIDATE_EMAIL)==false) {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Email Address Is 
			Not Valid</div>";
			 return $msg;
		}
		if ($chk_email==true) {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Email Address Is 
			Already Exist</div>";
			 return $msg;
		}
		$sql="INSERT INTO user_table(name,username,email,password) VALUES(:name,:username,
			:email,:password) ";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':name',$name);
		$query->bindValue(':username',$username);
		$query->bindValue(':email',$email);
		$query->bindValue(':password',$password);
		$result = $query->execute();
		if ($result) {
			$msg="<div class='alert alert-success'><strong>Success!</strong>
			Registration Successful</div>";
			 return $msg;
		}
		else{
			$msg="<div class='alert alert-danger'><strong>Error!</strong>
			Registration Not Successful</div>";
			 return $msg;
		}


	}



	public function CarRegistration($data)
	{
		$cid    =$data["cid"];
		$carname	=$data['carname'];
		$carcolor=$data['carcolor'];
		$ctime	=$data['ctime'];

		if ($cid=="" AND $carname=="" AND $carcolor=="" AND $ctime=="") {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Must Need to Fill 
			All Field</div>";
			 return $msg;
		}
		if($cid=="")
		{
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Enter The Registration Number</div>";
			 return $msg;
		}
		if($carname=="")
		{
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Enter The Car Name</div>";
			 return $msg;
		}
		if($carcolor=="")
		{
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Enter The Car Color</div>";
			 return $msg;
		}
		if($ctime=="")
		{
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Enter The Car Parking Time</div>";
			 return $msg;
		}



		$sql="INSERT INTO carentry_table(cid,carname,carcolor,ctime) VALUES(:cid,:carname,
			:carcolor,:ctime) ";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':cid',$cid);
		$query->bindValue(':carname',$carname);
		$query->bindValue(':carcolor',$carcolor);
		$query->bindValue(':ctime',$ctime);
		$result = $query->execute();
		
		
			if ($result) {
				$msg="<div class='alert alert-success'><strong>Success!</strong>
				Car Entry  Successful</div>";
				 return $msg;
			}
			else{
				$msg="<div class='alert alert-danger'><strong>Error!</strong>
				Car Entry  Not Successful</div>";
				 return $msg;
			}
		

	}


	public function isparking($ltime='')
	{

		$sql="SELECT ltime from carentry_table where ltime=:ltime";
		$q=$this->db->pdo->prepare($sql);
		$q->bindValue(':ltime',$ltime);
		$result1 = $q->execute();
		if($result1==""){
			return true;
		}
		else{
			return false;
		}
	}





	public function emailcheck($email='')
	{
		$sql="SELECT email from user_table where email=:email";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->execute();
		if ($query->rowCount()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function getloginuser($email,$password)
	{
		$sql="SELECT * FROM user_table WHERE email=:email AND password=:password LIMIT 1";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->bindValue(':password',$password);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		return $result;
		
	}

	public function userlogin($data)
	{

		$email	=$data['email'];
		$chk_email=$this->emailcheck($email);
		$password=md5($data['password']);

		if ($email=="" OR $password=="") {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Must Need to Fill 
			All Field</div>";
			 return $msg;
		}

		if (filter_var($email,FILTER_VALIDATE_EMAIL)==false) {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Email Address Is 
			Not Valid</div>";
			 return $msg;
		}
		if ($chk_email==false) {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Email Address Is 
			not Exist</div>";
			 return $msg;
		}

		$result=$this->getloginuser($email,$password);
		if ($result) {
			Session::int();
			Session::set("login",true);
			Session::set("id",$result->id);
			Session::set("name",$result->name);
			Session::set("username",$result->username);
			Session::set("loginmsg","<div class='alert alert-success'><strong>Success!</strong>
			You are logged In!</div>");
			header("Location:index.php");
			
		}
		else
		{
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Data Not Found</div>";
			 return $msg;
		}


	}

	public function getuserdata()
	{
		$sql="SELECT * FROM carentry_table ";
		$query=$this->db->pdo->prepare($sql);
		$query->execute();
		$result=$query->fetchAll();
		return $result;
		
	}


	public function getuserbyid($userid)
	{
		$sql="SELECT * FROM carentry_table WHERE id=:id LIMIT 1";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':id',$userid);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		return $result;

	}


	public function getuserbycid($userid)
	{
		$sql="SELECT * FROM carentry_table WHERE cid=:cid ";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':cid',$userid);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		return $result;

	}

	public function updateuserdata($userid,$data)
	{
		$ltime	=$data['ltime'];
		

		if ($ltime=="") {
			$msg="<div class='alert alert-danger'><strong>Error!</strong>Must Need to Fill 
			All Field</div>";
			 return $msg;
		}

		
		$sql="UPDATE carentry_table  SET ltime=:ltime WHERE 
		id=:id";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':ltime',$ltime);
		$query->bindValue(':id',$userid);
		$result = $query->execute();
		if ($result) {
			$msg="<div class='alert alert-success'><strong>Success!</strong>
			Update Successful</div>";
			 return $msg;
		}
		else{
			$msg="<div class='alert alert-danger'><strong>Error!</strong>
			Update Not Successful</div>";
			 return $msg;
		}

		
	}

}

?>