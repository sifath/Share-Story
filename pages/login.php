<!Doctype html>

<?php
	session_start();
	require '../scripts/DBConnection.php';
	
	$allStory=selectAllStory();


	$pass="";

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$pass=selectPassword($_POST["userName"]);
		if(!empty($pass) &&($pass == $_POST["password"]))
		{
			$_SESSION["currentUser"]=$_POST["userName"];
			header("Location: story.php?id=".$_POST["id"]);
		}
	}
?>

<html>
	<head>
		<title>Registration</title>
		<meta charset="utf-8"/>
		
		<style>
			body {
				
				margin:0px;
				height: 700px;
				border: solid;
				//background-color: rgb(228,244,248);
				background-image: url("../img/loginback.jpg");
				background-repeat: no-repeat;
				background-position: fixed;
				background-size: 100% 100%;
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



			#wrapper{
				width: 80%;
				margin:auto;
				height: 500px;

				//margin-bottom: 0px;
				//background-color: #27c1dd;
				//border-radius:25px;
				//border-top-left-radius:25px;
				//border-top-right-radius:25px;
				background-color: transparent;
				//box-shadow: 0 5px 17px 0 rgba(0,0,0,.6);
				//background-color: #f3f3f3;
				//opacity: 0.8;
			}

			#wrapper h1{
				margin-top: 200px;
				width: 50%;
				border: solid;
				margin-left: auto;
				margin-right: auto;
				color:white;
				font-size: 40px;
				text-align: center;
				background-color: black;
				opacity: 0.6;
			}

			.textBox{
				width:200px;
				height: 25px;
				//background-color: white;
				color:black;
				//border-radius: 10px;
				font-size: 15px;
				//opacity: 0.5
			}

			form{
				float: right;
				margin-right:160px
			}
			
			.button{
				height: 30px;
				width:100px;
				//border-radius: 10px;
				color:white;
				background-color: #27c1dd ;
				border: none;
				font-size: 20px;
				//opacity:1;
			}

			.button:hover{
				opacity:0.8;
			}
	
		</style>
		
	</head> 
	
	<body>

		<?php
		if(isset($_SESSION["currentUser"]))
			echo '<div id="navigation">';
		else
			echo '<div id ="navigation" style="background-color:#FFF">';
	?>


		<?php 
				if(isset($_SESSION["currentUser"]))
				{
			?>
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="pages/allStory.php">Read</a></li>
					<li><a href="pages/profile.php">Write</a></li>
					<li><a href="pages/storyStatus.php">Story Status</a></li>
					<li><a href="#"><?php echo $_SESSION["currentUser"];?></a>
						<ul>
							
							<li><a href="pages/changeInfo.php">Edit Profile</a></li>
							<li><a href="pages/changePass.php">Change Password</a></li>
							<li><a href="scripts/logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<?php
				}
				else
				{
			?>
			<div style="padding-top:10px">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<input type="text" class="textBox" placeholder="User Name" name="userName" required/>
				&nbsp;&nbsp;&nbsp;
				<input type="password" class="textBox" placeholder="Password" name="password" required/>
				&nbsp;&nbsp;&nbsp;
				<input type="submit" class="button" value="Log In"/>
				&nbsp;&nbsp;&nbsp;
				<span style="color:black;font-size:25"><b> OR </b></span>
				&nbsp;&nbsp;&nbsp;
				<a href="pages/regStart.php"><input type="button" class="button" style="width:170px; background-color:#27c1dd"  value="Sign up for Free"></a>
				<?php
				if($_SERVER["REQUEST_METHOD"]=="POST")
				{
					if(empty($pass)|| ($pass != $_POST["password"]))
					{
						echo '<label style="background-color:white;color:red"><pre> Wrong User Name or Password </pre></label>';
					}
				}
			}
			?>
			<input type="text" name="id" value="<?php echo $_GET["id"]?>" style="display:none">
			</form>
			</div>
		</div>

		<br><br><br><br><br><br>


		
		<div id="wrapper" align="center">
			<h1 align="center">
				Please Login to Read the Complete story
			</h1>
		</div>			
		
	</body>
</html>
