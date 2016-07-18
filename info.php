<?php
	require 'scripts/DBConnection.php';

	if(isset($_GET["q"]))
	{
			$userInfo=selectUserInfo($_GET["q"]);
		
			echo $userInfo["name"]."<br>";
			echo $userInfo["email"]."<br>";
			echo $userInfo["phone"]."<br>";
			echo $userInfo["address"]."<br>";
			//$photo = $userInfo["photo"];	
	}
?>