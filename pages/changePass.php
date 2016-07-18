<!Doctype html>
<?php
	session_start();
	require '../scripts/DBConnection.php';
	
	if(!isset($_SESSION["currentUser"]))
	{
		header("Location: ../index.php");
	}
	
	$error="";
	
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$pass=selectPassword($_SESSION["currentUser"]);
		
		if(!empty($pass) &&($pass == $_POST["password"]))
		{
			if($_POST["newPassword"]==$_POST["reTypeNewPassword"])
			{
				updatePassword($_SESSION["currentUser"],$_POST["newPassword"]);
				$error="Password Successfully updated";
			}
			else
			{
				$error="New Password & Retype New Password doesn't match";
			}
		}
		else
		{
			
			$error="Wrong old password inserted";
		}
		
		
	}

?>

<html>
	<head>
		<title>Change Info</title>
		
		<style>
			body {
				margin:0px;
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
				width: 80%;
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
				width:130px;
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

		<br><br><br><br><br><br>

		<div id="main">
			
			<h3 align="center">Change your password here</h3>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				
				<input type="password" class="textBox" placeholder="Old Password" name="password"  required/>
				<br><br>
				<input type="password" class="textBox" placeholder="New Password" name="newPassword"  required/>
				<br><br>
				<input type="password" class="textBox" placeholder="Retype New Password" name="reTypeNewPassword" required/>
				<br><br>
				<input type="submit" class="button" value="Change Password"/>
				<br>
				<?php echo '<span style="color:red">'.$error.'</span>';?>
				<br>
			</form>
		</div>
	</body>
</html>