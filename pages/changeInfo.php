<!Doctype html>
<?php
	session_start();
	require '../scripts/DBConnection.php';
	require '../scripts/imageUpload.php';
	
	if(!isset($_SESSION["currentUser"]))
	{
		header("Location: ../index.php");
	}
	
	$error=$userName=$name=$phone=$email=$address=$photo="";
	$userName=$_SESSION["currentUser"];
	
	if($_SERVER["REQUEST_METHOD"]!="POST")
	{
		$userInfo=selectUserInfo($userName);
		
			$name = $userInfo["name"];
			$email = $userInfo["email"];
			$phone = $userInfo["phone"];
			$address = $userInfo["address"];
			$photo = $userInfo["photo"];
			
		
	}
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		
		$name = $_POST["name"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$address = $_POST["address"];
		
		if($_FILES['img']['error'] == UPLOAD_ERR_NO_FILE) 
		{
			$userInfo=selectUserInfo($userName);
			$photo = $userInfo["photo"];
			updateInfo($userName, $name, $phone, $email, $address, $photo);
		}
		else
		{	
			$i=imageValidation($_SESSION["currentUser"],"img");
			if($i=="valid")
			{	
				$photo=$_SESSION["imgDir"];
				updateInfo($userName, $name, $phone, $email, $address, $photo);
			}
			else
			{
				$error=$i;
			}
		}
	}

?>

<html>
	<head>
		<title>Change Info</title>
		
		<style>
			body {
				
				margin:0;
			}
		

			#navigation{
				width: 100%;
				height: 60px;
				background-color: #27c1dd;
				position: fixed;
			}

			nav{
				width: 100%;
				margin-top: 0px;
			}

			nav ul ul {
				display: none;
			}

			nav ul li:hover > ul {
				display: block;
			}

			nav ul {
				 
				list-style: none;
				position: relative;
				display: inline-table;
				float: right;
				margin-right: 160px;
				margin-top: 0px;
			}


			nav ul li {
				display: inline-table;
			}
		
			nav ul li:hover {
				background: #4b545f;
			}
			nav ul li:hover a {
				color: #fff;
			}
	
			nav ul li a {
				display: block; 
				padding: 15px 40px;
				color:white;
				text-decoration: none;
				font-size: 20px;
			}


			nav ul ul {
				
				background: #5f6975; 
				border-radius: 0px; 
				padding: 0;
				position: absolute; 
				float: left
				top: 100%;
			}
			nav ul ul li {
				float: none; 
				border-top: 1px solid #6b727c;
				border-bottom: 1px solid #575f6a;
				position: relative;//
			}
			nav ul ul li a {
				padding: 15px 40px;
				color: #fff;
			}	
			
			#main{
				width: 80%
				margin:auto;
				background-color:#e3e3e3;
				height:1000px;
				text-align:center;
			}

			.textBox{
				width:400px;
				height: 25px;
			}
			
			.button{
				height: 25px;
				width:100px;
			}
			
			textarea{
				width:400px;
			}
		</style>
	<head>
	
	<body>
		
		<div id="navigation">
			<nav>
				<ul>
					<li><a href="../index.php">Home</a></li>
					
					<li><a href="allStory.php">Read</a></li>
					<li><a href="profile.php">Write</a></li>
					<li><a href="storyStatus.php">Story Status</a></li>
					<li><a href="#"><?php echo $_SESSION["currentUser"];?></a>
						<ul>
							<li><a href="changeInfo.php">Edit Profile</a></li>
							<li><a href="changePass.php">Change Password</a></li>
							<li><a href="../scripts/logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>

		<br><br><br>




		<div id="main">
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<br><br><br><br>
				
				<img src=<?php echo '"../'.$photo.'"';?> alt="Profile Picture" height="100" width="100"/>
				<br>
				<label>Change Your Profile Picture</label>
				&nbsp;&nbsp;
				<input type="file" name="img" accept="image/jpg,image/jpeg,image/png">
				<br>
				<small style="color:red">(File Size<500kb, Formate: JPG/JPEG/PNG)</small>
				<br><br>
				<?php echo '<span style="color:red">'.$error.'</span>';?>
				<br><br>
				<input type="text" class="textBox" placeholder="User Name" name="userName" <?php echo 'value="'.$userName.'" '?> readonly required/>
				<br><br>
				<input type="text" class="textBox" name="name" placeholder="Full Name" value=<?php echo '"'.$name.'"'?> required/>
				<br><br>
				<input type="text" class="textBox" name="phone" placeholder="Your Phone Number" value=<?php echo '"'.$phone.'"'?> required/>
				<br><br>
				<input type="email" class="textBox" name="email" placeholder="Your Email Address" value=<?php echo '"'.$email.'"'?> required/>
				<br><br>
				<textarea rows="4" cols="30" name="address" placeholder="Write your Address Here" required><?php echo $address?></textarea>
				<br><br>
				<input type="submit" class="button" value="Change Info"/>
				<br><br>
			</form>
		</div>
	</body>
</html>