<?php
	
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		//echo "Connection Error<br>";
		die("Connection failed: " . $conn->connect_error);
	} 
	
	
	function insert($userName, $password, $name, $phone, $email, $address, $photo)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "INSERT INTO storyshare.userinfo(UserName, Name,Address,Phone, Email,Photo)
						VALUES ('".$userName."', '".$name."', '".$address."', '".$phone."', '".$email."', '".$photo."')" ;
		if ($conn->query($sql) === TRUE) 
		{
			echo "New record created successfully" ;
		}else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		
		
		
		$sql = "INSERT INTO storyshare.logininfo(UserName, Password)
						VALUES ('".$userName."', '".$password."')";
		if ($conn->query($sql) === TRUE) 
		{
			echo "New record created successfully" ;
		}else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
	}
	
	
	function updateInfo($userName, $name, $phone, $email, $address, $photo)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "UPDATE storyshare.userinfo 
				SET Name = '".$name."', Address = '".$address."', Phone = '".$phone."', Email = '".$email."', Photo = '".$photo."' 
				WHERE UserName = '".$userName."'";
		if ($conn->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
	
	function updatePassword($userName,$pass)
	{
		/*$con = new mysqli("localhost", "root", "","loginmanagment");

	// Check connection
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		} 
	
		
		$sql = "UPDATE loginmanagment.logininfo SET GLOBALS["Password"] = '".$pass."' WHERE GLOBALS["UserName"] = '".$GLOBALS["userName"]."'";
		if ((con->query($sql)) === TRUE) 
		{
			return true;
		} 
		else 
		{
			echo "Error updating record: " .con->error;
		}
		
		con->close();*/
		
		//$GLOBALS["servername"] = "localhost";
		//$GLOBALS["username"] = "GLOBALS["username"]";
		//$GLOBALS["password"] = "GLOBALS["password"]";
		//$dbname = "myDB";

// Create connection
		$conn = mysqli_connect("localhost", "root", "", "storyshare");
// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		//$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
		$sql = "UPDATE storyshare.logininfo SET Password = '".$pass."' WHERE UserName = '".$userName."'";

		if (mysqli_query($conn, $sql)) {
			//echo "Record updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($conn);
		}

		mysqli_close($conn);
		
	}
	
	function selectUserInfo($userName)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "SELECT * FROM storyshare.userinfo where UserName='".$userName."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			// output data of each row
			$user = array();
			while($row = $result->fetch_assoc()) 
			{
				$user = array(
					"userName" => $row["UserName"],
					"name" => $row["Name"],
					"email" => $row["Email"],
					"phone" => $row["Phone"],
					"address" => $row["Address"],
					"photo" => $row["Photo"]
					);
			}
			$conn->close();
			return $user;
		} 
		else 
		{
			$conn->close();
			return null;
		}

		
	}
	
	function selectPassword($UserName)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "SELECT * FROM storyshare.logininfo where UserName='$UserName'";
		//$sql = "SELECT * FROM storyshare.storyinfo";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			// output data of each row
			$st="";
			while($row = $result->fetch_assoc()) 
			{
				//$loginInfo["UserName"]"]=$row["GLOBALS["UserName"]"];
				//$loginInfo["GLOBALS["Password"]"]=$row["GLOBALS["Password"]"];

				$st = $row["Password"];
				//$st=$row["GLOBALS["UserName"]"];
			}
			$conn->close();
			return $st;
			//return "123";
		} 
		else 
		{
			$conn->close();
			return null;
		}

		
	}
	
	
	function selectAllStory()
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "SELECT * FROM storyshare.storyinfo";
		$result = $conn->query($sql);
				
		if ( $result->num_rows> 0) 
		{
			// output data of each row
			$allStory = array();
			while($row = $result->fetch_assoc()) 
			{
				$allStory[] = array(
				"storyID" => $row['storyID'],
				"userName" => $row['UserName'], 
				"title" => $row["Title"],
				"storyBody" => $row['StoryBody'], 
				"view" => $row['View'],
				"like" => $row['Likes']
				);
			}
			
			//$conn->close();
			return $allStory;
		} 
		else 
		{
			//$conn->close();
			return null;
		}
	}
	
	function selectStory($storyID)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "SELECT * FROM storyshare.storyinfo WHERE storyID='".$storyID."'";
		$result = $conn->query($sql);
		

		if ($result->num_rows > 0) 
		{
			// output data of each row
			$story ="";
			while($row = $result->fetch_assoc()) 
			{
				$story = array(
				"storyID" => $row['storyID'],
				"userName" => $row["UserName"], 
				"title" => $row["Title"],
				"storyBody" => $row['StoryBody'], 
				"view" => $row['View'],
				"like" => $row['Likes']
				);
			}
			
			$conn->close();
			return $story;
		} 
		else 
		{
			$conn->close();
			return null;
		}
	}

	function selectAllStoryOf($userName)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "SELECT * FROM storyshare.storyinfo WHERE UserName='$userName'";
		$result = $conn->query($sql);
				
		if ( $result->num_rows> 0) 
		{
			// output data of each row
			$allStory = array();
			while($row = $result->fetch_assoc()) 
			{
				$allStory[] = array(
				"storyID" => $row['storyID'],
				"userName" => $row['UserName'], 
				"title" => $row["Title"],
				"storyBody" => $row['StoryBody'], 
				"view" => $row['View'],
				"like" => $row['Likes']
				);
			}
			
			//$conn->close();
			return $allStory;
		} 
		else 
		{
			//$conn->close();
			return null;
		}	
	}



	function updateStory($storyID,$username,$title,$body,$view,$like)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "UPDATE storyshare.storyinfo 
				SET UserName='$username',Title='$title', StoryBody='$body', View='$view', Likes='$like' where storyID='$storyID'";
		if ($conn->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}



	function insertNewStory($userName,$title,$storyBody,$view,$like)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql = "INSERT INTO storyshare.storyinfo(UserName, Title,StoryBody,View, Likes)
						VALUES ('$userName','$title','$storyBody','$view','$like')" ;
		if ($conn->query($sql) === TRUE) 
		{
			//echo "New record created successfully" ;
		}else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}

	function deleteStory($storyID)
	{
		$conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"]);
		$sql="DELETE FROM storyshare.storyinfo WHERE storyID='$storyID'";

		if ($conn->query($sql) === TRUE) {
    		//echo "Record deleted successfully";
		} else {
  		  echo "Error deleting record: " . $conn->error;
		}

			$conn->close();
	}
	
	
?>