<!Doctype html>

<?php
	session_start();
	require 'scripts/DBConnection.php';
	
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
		<script type="text/javascript">
			function loadUserInfo(user)
			{
				//alert(user);

				var xhttp, xmlDoc;
 				xhttp = new XMLHttpRequest();
  				xhttp.onreadystatechange = function() {
  				if (xhttp.readyState == 4 && xhttp.status == 200) {
    			document.getElementById("info").innerHTML = xhttp.responseText;;
   			 }
  			};
  			xhttp.open("GET", "info.php?q="+user, true);
  			xhttp.send();
			}
		</script>
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
				
				border-top-left-radius:25px;
				border-top-right-radius:25px;
				background-color: #f2f2f2;
				box-shadow: 0 5px 17px 0 rgba(0,0,0,.6);
				
			}

			#header{
				//height:100px;
				margin-top: 0px;
				width:inherit;
				//border: 3px solid #8AC007;
				border-radius: 25px;
				text-align: center;
				color:white;
				font-size: 50px;
				//background-color:#CC6600   ;
			}


			#header span{
				font-size: 30px;
			}	

			#welcomePic{
				width: 100%;
				height: 400px;
				background-image: url("img/mysterydogwoodcross.jpg");
				background-repeat: no-repeat;
				background-size: 100% 100%;
				text-align: center;
				//border-radius:25px;
				border-top-left-radius:25px;
				border-top-right-radius:25px;
				//position: fixed;
			}	

			#welcomePic div{
				margin:auto;
				text-align: center;
				//background-color: black;
				width: 600px;
				//opacity: 0.6;
			}

			#welcomePic div span{
				color:white;
				font-size: 30px;
			}
			
			
			#welcomePic h2{
				color:orange;
				background-color: #7FFFD4;
				opacity:0.5;
				width: 40%;
				margin: auto;
				border-radius: 25px;
			}

			#storySection{
				width: 100%;
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
			.story h6{
				height: 28px;
				overflow: hidden;
				word-wrap:break-word;
			}


			.story p{
				height:120px;
				width: 90%;
				margin: auto;
				overflow: hidden;
				word-wrap:break-word;
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
			</form>
			</div>
		</div>

		<br><br><br><br><br><br>


		
		<div id="wrapper">
		<div id="welcomePic">
			<h1 id="header">
			<br>
			Sharing our stories
			<br>
			<span>Inspire | Motivate | Live the Life</span>
			</h1>
		</div>

				
		<div id="storySection" align="center">
			<?php
			$index=1;
			foreach (array_reverse($allStory) as $story) {
			?>
				<article class="story">
				
					
					<img src="storyPhoto/<?php echo $index;?>.jpg" alt="Story Cover Photo">
					<h6>
						<a href="pages/story.php?id=<?php echo $story["storyID"]; ?>" style="float:none;font-size:20px">
							<?php echo htmlspecialchars($story["title"],ENT_IGNORE);?>	
						</a>		
					</h6>
					<p align="justify">
						<?php echo htmlspecialchars($story["storyBody"],ENT_IGNORE); ?>	
					</p>
					<a href="pages/story.php?id=<?php echo $story["storyID"]; ?>">Read More ...</a>
					<br>
					<p style="text-align:left"> 
						Story By, 
						<?php echo '<button type="button" onclick="loadUserInfo(this.value)" style="text-align:left; float:none" value="'.$story["userName"].'">'.$story["userName"].'</button>'; ?>

					</p>
				
				</article>
			<?php
				if($index==9)
				{
					break;
				}
				$index++;
			}
			?>
		</div>	
		<p id="info" style="text-align:center">

		</p>		
		</div>
		

		
	</body>
</html>
