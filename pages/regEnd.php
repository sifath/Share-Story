<!Doctype html>

<?php
	
	session_start();
	require '../scripts/imageUpload.php';
	require '../scripts/DBConnection.php';
	

	$error=$name=$phone=$email=$address="";
	
	
		if(isset($_SESSION["name"]))
		{
			$name=$_SESSION["name"];
		}
	
		if(isset($_SESSION["phone"]))
		{
			$phone=$_SESSION["phone"];
		}
	
		if(isset($_SESSION["email"]))
		{
			$email=$_SESSION["email"];
		}
	
		if(isset($_SESSION["address"]))
		{
			$address=$_SESSION["address"];
		}

	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["phone"] = $_POST["phone"];
		$_SESSION["email"] = $_POST["email"];
		$_SESSION["address"] = $_POST["address"];
		
		
		if(isset($_POST["back"]))
		{
			header("Location: regStart.php");
			exit();
		}
		
		$i=imageValidation($_SESSION["name"],"pic");
		if($i=="valid")
		{	
			insert($_SESSION["userName"], $_SESSION["password"], $_POST["name"], $_POST["phone"], $_POST["email"], $_POST["address"], $_SESSION["imgDir"]);
			header("Location: successful.php");
		}
		else
		{
			$error=$i;
		}
	}
?>


<html>
	<head>
		<title>Registration Cont.</title>
		
		<style>
			body {
				margin: 0px 
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

			#header{
				height:100px;
				width:inherit;
				background-color:#e3e3e3;
			}
			
			#main{
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
	</head>
	
	<body>
		

		<div id="navigation">
			<nav>
				<ul>
					<li><a href="../index.php">Home</a></li>
				</ul>
			</nav>
		</div>

		<br><br><br>
		
		
		<div id="main">
			<div id="header"></div>
				<br>
				<h3 align="center">Complete Your Registration</h3>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
					<br>
					<input type="text" class="textBox" name="name" placeholder="Full Name" value=<?php echo '"'.$name.'"'?> required/>
					<span style="color:red">&nbsp;&nbsp;* Required</span>
					<br><br>
					<input type="text" class="textBox" name="phone" placeholder="Your Phone Number" value=<?php echo '"'.$phone.'"'?> required/>
					<span style="color:red">&nbsp;&nbsp;* Required</span>
					<br><br>
					<input type="email" class="textBox" name="email" placeholder="Your Email Address" value=<?php echo '"'.$email.'"'?> required/>
					<span style="color:red">&nbsp;&nbsp;* Required</span>
					<br><br>
					<textarea rows="4" cols="30" name="address" placeholder="Write your Address Here" required><?php echo $address?></textarea>
					<span style="color:red">&nbsp;&nbsp;* Required</span>
					<br><br>
					<label>Upload your Profile Picture</label>
					
					<input type="file" name="pic" accept="image/jpg,image/jpeg,image/png"  required>	
					<span style="color:red">* Required</span>
					<br>
					<small style="color:green">(File Size<500kb, Formate: JPG/JPEG/PNG)</small>
					<br>
					<?php echo '<span style="color:red">'.$error.'</span>'?>
					<br><br>
					<input type="submit" class="button" name="back" value="back" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" class="button" name="finish" value="finish"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</form>
			
		</div>
		
	</body>
</html>