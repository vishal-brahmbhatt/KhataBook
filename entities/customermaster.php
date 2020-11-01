<?php
	class CustomerMaster
	{
		private $connection;

		public $custid;
		public $email;
		public $custname;
		public $mobile;
		public $userid;
		public $isactive;


		// This is constructor we have to pass connection of the database

		public function __construct($connection)
		{
        	$this->connection = $connection;
    	}


		//This function will perform insert operation for UserMaster table

		public function ins_customermaster()
		{
			$sql = "INSERT Into `customermaster` (`Email`,`CustName`,`Mobile`,`UserID`,`Isactive`) values('$this->email','$this->custname','$this->mobile','$this->userid',TRUE)";
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

		public function customer_view()
		{

			    $sql = "SELECT CustName,Email,Mobile FROM customermaster WHERE UserID = '$this->userid'";
		      $result = mysqli_query($this->connection,$sql);



		      // If result matched email and password, table row must be 1 row

          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
                $datadict->custname=$row1["CustName"];
  		      		$datadict->email = $row1["Email"];
  		      		$datadict->mobile = $row1["Mobile"];
                array_push($data,$datadict);
              }
		      }
		      else
		      {
		         	$datadict->status="Fail";
		      		$datadict->userid = 0;
		      		$datadict->username = "NA";
              array_push($data,$datadict);
		      }

		      return $data;
		}

	}
?>
