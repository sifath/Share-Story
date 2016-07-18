<?php
	require '../scripts/DBConnection.php';

	if(isset($_GET["user"]))
	{
			//$userInfo=selectUserInfo($_GET["user"]);
		
			insertNewStory($_GET["user"],$_GET["title"],$_GET["story"],0,0);
			echo "Story Successfully uploaded";
	}
?>