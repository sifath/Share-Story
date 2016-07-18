<!DOCTYPE html>
<?php
	require '../scripts/DBConnection.php';
	session_start();
	if(!isset($_SESSION["currentUser"]))
	{
		header("Location: login.php?id=".$_GET["id"]);
	}

	$story=$author="";
	if(isset($_GET["id"]))
	{
		
		$story=selectStory($_GET["id"]);
		updateStory($story["storyID"],$story["userName"],$story["title"],$story["storyBody"],$story["view"]+1,$story["like"]);
		$author=selectUserInfo($story["userName"]);
	}

	if(isset($_GET["liked"]))
	{
		$story=selectStory($_GET["liked"]);
		updateStory($story["storyID"],$story["userName"],$story["title"],$story["storyBody"],$story["view"],$story["like"]+1);
	}
?>
<html>
<head>
	<title>
		<?php echo $story["title"]; ?>
	</title>

	<style>
		body{
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
			margin: auto;
			border-top-left-radius:25px;
			border-top-right-radius:25px;
			background-color: #fff;
			box-shadow: 0 5px 17px 0 rgba(0,0,0,.6);
		}

		#storySection{
			width: 100%;
			//margin: auto;
			//border: solid red;
		}
		#story{
			width: 70%;
			height: 800px;
			//border: solid; 
			display:inline-table;
			vertical-align: top;
			box-shadow: 10px 10px 5px #888888;
			//word-wrap:break-word;
		}

		#story #title{
			width: 100%;
			height: 350px;
			background-image: url("../img/storyPhoto.jpg");
			background-repeat: no-repeat;
			background-size: 100% 100%;
		}

		#story #title h2{
			//border: solid;
			width: 500px;
			height: 100px;
			margin: auto;
			text-align: center;
			font-size: 35px;
			word-wrap:break-word;
		}

		#story #storyBody{
			width: 600px;
			font-size: 20px;
			margin: auto;
			word-wrap:break-word;
		}

		#story #storyBody::first-letter {
    		color: #ff0000;
    		font-size: xx-large;
		}

		#story a{
			font-size: 20px;
		}

		#storyInfo{
			width:25%;
			height:800px;
			//border:solid;
			display:inline-table;
			vertical-align: top;
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

	<div id="storySection" align="center">
		<div id="story">
			<br><br>
			<div id="title">
				<h2><?php echo htmlspecialchars($story["title"],ENT_IGNORE);?></h2>
			</div>
			<p id="storyBody" align="justify">
				<?php echo htmlspecialchars($story["storyBody"],ENT_IGNORE);?>
			</p>
			<br><br>
			<a href="story.php?liked=<?php echo $story["storyID"];?>">Like</a>
			<br><br><br><br>
		</div>

		<div id="storyInfo">
			<br><br><br><br>
			<h2 align="left">Author: </h2>
			<div align="center">
				<h3><?php echo $author["userName"]?></h3>
				<img src="../<?php echo $author["photo"];?>" height="150px" width="150px">
			</div>
		</div>
	</div>
	</div>
</body>
</html>