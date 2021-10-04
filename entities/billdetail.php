<?php
	class BillDetail
	{
		private $connection;

		public $userid;
		public $customerid;
		public $billcode;
		public $totalamt;
		public $toatlpaidamt;
		public $dateofbill;



		// This is constructor we have to pass connection of the database

		public function __construct($connection)
		{
        	$this->connection = $connection;
    	}


		//This function will perform insert operation for UserMaster table

		public function ins_billdtl()
		{
			$sql = "INSERT Into `billmaster` (`BillCode`,`TotalAmt`,`ToatlPaidAmt`,`DateOfBill`,`CustomerID`,`UserID`) values('$this->billcode','$this->totalamt','$this->totalpaidamt','$this->dateofbill','$this->customerid','$this->userid')";
				if ($this->connection->query($sql) === TRUE)
				{
					 $last_id = mysqli_insert_id($conn);
				  return true;
				}
				else
				{
				  // echo "Error: " . $sql . "<br>" . $this->connection->error; // uncomment this if you are getting errors
				  return false;
				}

		}

		public function billmaster_view()
		{

			    $sql = "SELECT BillId,BillCode,ToatalAmt FROM billmaster WHERE UserID = '$this->userid'";
		      $result = mysqli_query($this->connection,$sql);



          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
								$datadict->billid=$row1["BillId"];
                $datadict->billcode=$row1["BillCode"];
  		      		$datadict->totalamt = $row1["ToatalAmt"];

                array_push($data,$datadict);
								$datadict="";
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

		public function billmaster_byid()
		{

			    $sql = "SELECT BillID,BillCode,ToatlAmt,ToatlPaidAmt,DateOfBill FROM billmaster WHERE BillID = '$this->billid'";
		      $result = mysqli_query($this->connection,$sql);



		      // If result matched email and password, table row must be 1 row

          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
								$datadict->billid=$row1["BillId"];
                $datadict->billcode=$row1["BillCode"];
  		      		$datadict->totalamt = $row1["ToatalAmt"];
								$datadict->totalpaidamt = $row1["ToatlPaidAmt"];
								$datadict->dateofbill = $row1["DateOfBill"];
                array_push($data,$datadict);
								$datadict="";
              }
							$status="Success";
							array_push($data);
		      }
		      else
		      {
		         	$datadict->status="Fail";
		      		$datadict->userid = 0;
		      		$datadict->username = "NA";
              array_push($data,$datadict);
							$status="Success";
		      }

		      return array($data,$status);
		}

	}
?>
