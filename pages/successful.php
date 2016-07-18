<!Doctype html>


<?php
	session_start();
	session_unset(); 
?>
<html>
	<head>
		<title>Registration Completed</title>
		<style>
			body {
				margin-left: 10%;
				margin-right:10%;
			}
			#header{
				height:100px;
				width:inherit;
				background-color:#680000;
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
			<div id="header"></div>
			<br>
			<h3>Congratulation! You registration is successfully completed</h3>
			<h3><a href="../index.php">Click to Login</a></h3>
		</div>
	</body>
</html>