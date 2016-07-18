<?php
	require 'DBConnection.php';
	session_start();

	if(isset($_GET["delete"]))
	{
		deleteStory($_GET["delete"]);	
	}
	
	header("Location: ../pages/storyStatus.php");
?>