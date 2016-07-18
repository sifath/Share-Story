<!Doctype html>

<?php
	session_start();
	require '../scripts/DBConnection.php';
	if(!isset($_SESSION["currentUser"]))
	{
		header("Location: ../index.php");
	}


	$userInfo=selectUserInfo($_SESSION["currentUser"]);
	$story="";
	$storyID=$title=$body="";
	if(isset($_GET["edit"]))
	{
		$story=selectStory($_GET["edit"]);
		$storyID=$story["storyID"];
		$title=$story["title"];
		$body=$story["storyBody"];
	}


	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		
		$story=selectStory($_POST["storyID"]);
		$storyID=$_POST["storyID"];
		$title=$_POST["storyTitle"];
		$body=$_POST["storyBody"];

		updateStory($storyID,$story["userName"],$title,$body,$story["view"],$story["like"]);
		header("Location: storyStatus.php");
	}
	

?>

<html>
	<head>
		<title><?php echo $_SESSION["currentUser"];?></title>
		<style>
			body {
				margin: 0px;
				background-image: url("../img/background.jpg");
				background-repeat: repeat;
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
				padding-top: 15px;
				margin: auto;
				border-top-left-radius:25px;
				border-top-right-radius:25px;
				background-color: #fff;
				box-shadow: 0 5px 17px 0 rgba(0,0,0,.6);
			}

		
			
			#left{
				width: 80%;
				height: 800px;
				//border: solid; 
				display:inline-table;
				vertical-align: top;
				background-color: #eee;
				box-shadow: 0 0px 17px 0 rgba(0,0,0,.6);
			}

			#left #storyTitle{
				padding-top: 30px;
				width: 100%;
				height: 300px;
				background-image: url("../img/breakingthecode.jpg");
				background-repeat: no-repeat;
				background-size: 100% 100%;
			}

			#left #storyTitle{
				color: white;
				font-size: 30px;
			}

			#left textarea{
				width: 90%;
				height: 500px;
				margin:auto;
				color:#535353;
				//background-color: transparent;
				font-size: 25px;
				border:dashed thin #D5D5D5;
				overflow: hidden;
			}


			#left .textBox{
				width:80%;
				height: 70px;
				margin: auto;
				font-size: 45px;
				color: white;
				background-color: Transparent;
				text-align: center;
				overflow: hidden;
				border: dashed thin #D5D5D5;

			}
			
			
			.button{
				height: 45px;
				width:200px;
				color:white;
				background-color: #27c1dd;
				font-size: 30px;
				border-radius: 10px;
				border: none;
			}
			

			.button:hover{
				opacity:0.8;
			}

	
		</style>
	</head>
	
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
	<div id="wrapper" align="center">
	
		<div id="left" align="center">
			
			
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div id="storyTitle">
					<h3>
					Edite Your Story Here ....
					</h3>
					<input type="text" class="textBox" name="storyTitle" placeholder="Story Title" value="<?php echo $title; ?>">
				 </div>
					
				<br><br>
				<textarea name="storyBody" placeholder="Start your story from here"><?php echo $body; ?></textarea>
				<br><br><br><br>
				<input type="submit" class="button" value="Update Story">
				<br><br><br><br><br>
				<input type="text" name="storyID" style="display:none" value="<?php echo $storyID; ?>">
				</form>

		</div>

	</div>

	</body>
</html>