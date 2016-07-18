<!Doctype <!DOCTYPE html>
<?php
	
	session_start();
	require '../scripts/DBConnection.php';

	$stories=selectAllStoryOf($_SESSION["currentUser"]);

?>



<html>
	<head>
		<title>
			Story Status
		</title>

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
				//padding-top: 150px;
				margin: auto;
				border-top-left-radius:25px;
				border-top-right-radius:25px;
				background-color: #fff;
				box-shadow: 0 5px 17px 0 rgba(0,0,0,.6);
			}

			#wrapper h1{
				width: 100%;
				height:400px;
				background-image: url("../img/still_penelope.jpg");
				color:white;
				text-align: center;
				background-repeat: no-repeat;
				background-size: 100% 100%;
				border-top-left-radius:25px;
				border-top-right-radius:25px;
				font-size: 40px;
				//border-radius: 25px;
			}

			table{
				border:1px solid;
				width: 80%;
				margin-left: auto;
				margin-right: auto;
				//margin-top: 250px;
				//margin:auto;
			}

			tr{
				border:1px solid;
				height: 50px;
				background-color: #eee;
				box-shadow: 0 0px 17px 0 rgba(0,0,0,.6);
			}

			td{
				border:1px solid;
			}

			#pagination{
				font-size: 20px;

			}

			//#currentSelection{
			//	font-size:30px;
			//}


		</style>
	</head>

		<body>
			<div id="navigation">
			<nav>
				<ul>
					<li><a href="../index.php">Home</a></li>
					
					<li><a href="allStory.php">Read</a></li>
					<li><a href="profile.php">Write</a></li>

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

		<br><br><br><br>

		<div id="wrapper">
			<h1>
				<br><br><br><br>
				Enlight yourself with the power of creativity
			</h1>

			<table id="storyList">
				<?php 

				$index=0;
				if(isset($_GET["page"]))
				{
					$index = ($_GET["page"]-1)*5;
				}
			

				for ($i=$index; $i<$index+5 ;$i++) {

					if(count($stories)==$i)
					{
						break;
					}
				?>

					<tr>
					<td >
						<?php echo $i+1;?> .
					</td>

					<td >
						<?php echo $stories[$i]["title"];?> .
					</td>

					<td>
						<a href="editStory.php?edit=<?php echo $stories[$i]["storyID"];?>" >Edit</a>
					</td>

					<td>
						<a href="../scripts/deleteStory.php?delete=<?php echo $stories[$i]["storyID"];?>" >Delete</a>
					</td>

					<td>
						<label ><?php echo $stories[$i]["view"];?> Views</label>
					</td>
					
					<td>
						<label ><?php echo $stories[$i]["like"];?> Like</label>
					</td>
					
					</tr>
					
				<?php

				

				}
				?>
			</table>
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

				<a href="storyStatus.php?page=<?php echo $i;?>"><?php echo $i;?></a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<?php
				}
					if(count($stories)< ($i*5) )
					{
						break;
					}
				}
				?>
			</div>

			<br><br><br>
		</div>
	</body>
</html>