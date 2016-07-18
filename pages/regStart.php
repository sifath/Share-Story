<!Doctype html>

<?php
		
	session_start();
	require '../scripts/DBConnection.php';
	
	$userName=$password=$errorMessage="";
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if($_POST["password"]==$_POST["reTypePassword"])
		{
			if(!selectUserInfo(trim($_POST["userName"])))
			{
				$_SESSION["userName"]=$_POST["userName"];
				$_SESSION["password"]=$_POST["password"];
				header("Location: regEnd.php");
				exit;
			}
			else
			{
				$errorMessage="This User Name is already registered. Please try another user name.";
			}
		}
	}
	
	if(isset($_SESSION["userName"]))
	{
		$userName=$_SESSION["userName"];
	}
	if(isset($_SESSION["password"]))
	{
		$password=$_SESSION["password"];
	}
		
?>

<html>
	<head>
		<title>Registration</title>
		
		<style>
			body {
				margin: 0px;
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
	
		</style>
		
	</head> 
	
	<body>
			
			<div id="main">

			<div id="navigation">
			<nav>
				<ul>
					<li><a href="../index.php">Home</a></li>
				</ul>
			</nav>
		</div>

		<br><br><br><br><br><br>



				<div id="header"></div>

				<h3 align="center">Start Your registration Here</h3>
				<br><br>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<br>
					<input type="text" class="textBox" placeholder="User Name" name="userName" <?php echo 'value="'.$userName.'" '?> required/>
					<span style="color:red">&nbsp;&nbsp;* Required</span>
					<br><br>
					<input type="password" class="textBox" placeholder="Password" name="password" <?php echo 'value="'.$password.'" '?> required/>
					<span style="color:red">&nbsp;&nbsp;* Required</span>
					<br><br>
					<input type="password" class="textBox" placeholder="Retype Password" name="reTypePassword" <?php echo 'value="'.$password.'" '?> required/>
					<span style="color:red">&nbsp;&nbsp;* Required</span>
					<br><br>
					<input type="submit" class="button" value="Next"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<br><br>
				</form>
				
				<?php
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
						if($_POST["password"]!=$_POST["reTypePassword"])
						{
							echo '<span style="color:red">Password did not match</span>';
						}
						echo'<br>';
					}
					
					echo '<span style="color:red">'.$errorMessage.'</span>';
				?>
			</div>
			

		
	</body>
</html>