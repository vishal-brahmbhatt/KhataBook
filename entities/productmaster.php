<?php
	class ProductMaster
	{
		private $connection;

		public $prodid;
		public $prodname;
		public $proddesc;
		public $rateofpurchase;
		public $rateofsell;
		public $uom;
		public $userid;
		public $isactive;


		// This is constructor we have to pass connection of the database

		public function __construct($connection)
		{
        	$this->connection = $connection;
    	}


		//This function will perform insert operation for UserMaster table

		public function ins_productmaster()
		{
			$sql = "INSERT Into `productmaster` (`ProdName`,`ProdDesc`,`RateOfPurchase`,`RateOfSell`,`UOM`,`UserID`,`Isactive`) values('$this->prodname','$this->proddesc','$this->rateofpurchase','$this->rateofsell','$this->uom','$this->userid',TRUE)";
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

		public function product_view()
		{

			    $sql = "SELECT ProdID,ProdName,RateOfSell,RateOfPurchase FROM productmaster WHERE UserID = '$this->userid'";
		      $result = mysqli_query($this->connection,$sql);



		      // If result matched email and password, table row must be 1 row

          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
                $datadict->prodname=$row1["ProdName"];
  		      		$datadict->rateofpurchase = $row1["RateOfPurchase"];
  		      		$datadict->rateofsell = $row1["RateOfSell"];
								$datadict->prodid = $row1["ProdID"];
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


		public function product_byid()
		{

			    $sql = "SELECT ProdID,ProdName,RateOfSell,RateOfPurchase,UOM FROM productmaster WHERE ProdID = '$this->prodid'";
		      $result = mysqli_query($this->connection,$sql);



		      // If result matched email and password, table row must be 1 row

          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
								$datadict->prodid=$row1["ProdID"];
                $datadict->prodname=$row1["ProdName"];
  		      		$datadict->ros = $row1["RateOfSell"];
  		      		$datadict->rop = $row1["RateOfPurchase"];
								$datadict->uom = $row1["UOM"];
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

		public function upd_productmaster()
		{
			$sql = "UPDATE `productmaster` set `ProdName`='$this->prodname',`RateOfPurchase`='$this->rateofpurchase',`RateOfSell`='$this->rateofsell',`UOM`='$this->uom' where ProdID = '$this->prodid'";
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

	}
?>
