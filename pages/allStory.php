<!Doctype html>

<?php
	session_start();
	require '../scripts/DBConnection.php';
	
	$allStory=selectAllStory();


	$pass="";
	//$_SESSION["currentUser"]="";
	
	//if(isset($_SESSION["currentUser"]))
	//{
	//	header("Location: pages/profile.php");
	//}
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$pass=selectPassword($_POST["userName"]);
		if(!empty($pass) &&($pass == $_POST["password"]))
		{
			$_SESSION["currentUser"]=$_POST["userName"];
			//header("Location: pages/profile.php");
		}
	}
?>

<html>
	<head>
		<title>Story Share Home</title>
		<meta charset="utf-8"/>
		
		<style>
			body {
				
				margin:0px;
				//background-color: rgb(228,244,248);
				background-image: url("img/background.jpg");
				background-repeat: repeat;
				//background-size: 100% 100%;
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
				//margin-bottom: 0px;
				//background-color: #27c1dd;
				//border-radius:25px;
				border-top-left-radius:25px;
				border-top-right-radius:25px;
				background-color: #f2f2f2;
				box-shadow: 0 5px 17px 0 rgba(0,0,0,.6);
				//background-color: #f3f3f3;
				//opacity: 0.8;
			}


			#storySection{
				width: 100%;
				//margin: auto;
				//padding: 10px;
				//margin: 10px;

			}

			.story{
				
				display: inline-block;
    			width: 30%;
   				height: 400px;
    			margin: 10px;
				border: 10px transparent;
				border-radius: 15px;
				box-shadow: 0 5px 17px 0 rgba(0,0,0,.6);
    			vertical-align: top;
    			//background-color:#27c1dd;
    			//background-color: #500000;
    			color: #333;
    			//font-size: 20px;
    			
			}

			.story img{
				width: 100%;
				height: 140px;
				border-top-left-radius:15px;
				border-top-right-radius:15px;
			}
			.story h5{

			}


			.story p{
				height:120px;
				width: 90%;
				margin: auto;
				overflow: hidden;
			}

			.story a{
				color: #34b5d0;
				text-decoration: none;
				float: right;
			}

			.story a:hover{
				text-decoration:underline;
			}

			.story:hover{
				//opacity: 0.8;
			}

			.border{
				border:  black solid 20px;
				//opacity: 0.6;
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


			#pagination{
				font-size: 20px;

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
				<a href="regStart.php"><input type="button" class="button" style="width:170px; background-color:#27c1dd"  value="Sign up for Free"></a>
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
			</form>
			</div>
		</div>

		<br><br><br><br><br><br>


		
		<div id="wrapper">
		
		<h1 style="text-align:center; font-size:40px">
			<br>
			All Stories is here. Find your favourite one!
			<br>
		</h1>
		
		<div id="storySection" align="center">
			<?php
			//$index=1;
			//foreach ($allStory as $story) {



			
				$index=0;
				if(isset($_GET["page"]))
				{
					$index = ($_GET["page"]-1)*6;
				}
			

				for ($i=$index; $i<$index+6 ;$i++) {

					if(count($allStory)==$i)
					{
						break;
					}
			?>
				<article class="story">
				
					
					<img src="../storyPhoto/<?php echo rand(1,9);?>.jpg" alt="Story Cover Photo">
					<h6>
						<a href="pages/story.php?id=<?php echo $allStory[$i]["storyID"]; ?>" style="float:none;font-size:20px">
							<?php echo htmlspecialchars($allStory[$i]["title"],ENT_IGNORE);?>	
						</a>		
					</h6>
					<p align="justify">
						<?php echo htmlspecialchars($allStory[$i]["storyBody"],ENT_IGNORE); ?>	
					</p>
					<a href="story.php?id=<?php echo $allStory[$i]["storyID"]; ?>">Read More ...</a>
					<br>
					<p style="text-align:left"> 
						Story By, 
						<?php echo $allStory[$i]["userName"]; ?>

					</p>
				
				</article>
			<?php
			
			}
			
			?>
		</div>	
		<br><br>
		<div id="pagination" align="center">
				<?php
				$start=1;
				$end=5;
				if(isset($_GET["page"]) && $_GET["page"]>3)
				{
					$start=$_GET["page"]-2;
					$end=$_GET["page"]+2;
				}
				
				
				for ($i=$start;$i<=$end;$i++) {

					if((isset($_GET["page"]) && $_GET["page"]==$i)|| (!isset($_GET["page"])&&$i==1))
						{ 
							echo '<a href="storyStatus.php?page='.$i.'" style="font-size:30px">'. $i .'</a>';
							echo '&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else
						{
				?>

				<a href="allStory.php?page=<?php echo $i;?>"><?php echo $i;?></a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<?php
				}
					if(count($allStory)< ($i*5) )
					{
						break;
					}
				}
				?>
			</div>
		<br><br>
		</div>
		<br>
	</body>
</html>
