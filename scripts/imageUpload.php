<?php

	//$error_message="";
	
	function imageValidation($userName,$sourceButton)
	{
		$img_Type = pathinfo(basename($_FILES[$sourceButton]["name"]),PATHINFO_EXTENSION);
		$target_dir = "images/".$userName.".".$img_Type;
		
		
		$img_val="valid";
		$check = getimagesize($_FILES[$sourceButton]["tmp_name"]);
		if($check == false) 
		{
			$img_val = "Not a valid image";
			return $img_val;
		} 
		
		
		if ($_FILES[$sourceButton]["size"] > 512000) 
		{
			$img_val = "Image size is more than 500kb";
			return $img_val;
		}
		
		
		if (!move_uploaded_file($_FILES[$sourceButton]["tmp_name"], "../".$target_dir)) 
		{
			$img_val = "Sorry, Image is not uploaded";
			return $img_val;
		}
		
		$_SESSION["imgDir"]=$target_dir;
		return $img_val;

	}
?>