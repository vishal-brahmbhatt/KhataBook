<?php
	class UserMaster
	{
		private $connection;

		public $userid;
		public $emailid;
		public $name;
		public $shopname;
		public $address;
		public $gstno;
		public $otp;
		public $password;


		// This is constructor we have to pass connection of the database

		public function __construct($connection)
		{
        	$this->connection = $connection;
    	}


		//This function will perform insert operation for UserMaster table

		public function ins_usermaster()
		{
			$sql = "INSERT Into `usermaster` (`EmailID`,`Name`,`ShopName`,`Address`,`GSTNo`) values('$this->emailid','$this->name','$this->shopname','$this->address','$this->gstno')";
				if ($this->connection->query($sql) === TRUE)
				{
				  return true;
				}
				else
				{
				  // echo "Error: " . $sql . "<br>" . $this->connection->error; // uncomment this if you are getting errors
				  return false;
				}

		}

		public function login()
		{

			  $sql = "SELECT UserID,Name FROM usermaster WHERE EmailID = '$this->emailid' and Password = '$this->password'";
		      $result = mysqli_query($this->connection,$sql);  	      
		      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);		      
		      $count = mysqli_num_rows($result);

		      // If result matched email and password, table row must be 1 row

		      if($count == 1) 
		      {
		      		$datadict->status="Success";
		      		$datadict->userid = $row["UserID"];
		      		$datadict->username = $row["Name"];
		      }
		      else 
		      {
		         	$datadict->status="Fail";
		      		$datadict->userid = 0;
		      		$datadict->username = "NA";
		      }

		      return $datadict;
		}

	}
?>
