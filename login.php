<?php
	include_once "lib/bundle-all.php";
	$User_Username = (isset($_POST['User_Username'])  ? trim($_POST['User_Username']) : "");
	$User_Password = (isset($_POST['User_Password'])  ? trim($_POST['User_Password']) : "");
	$Password = TobiKrypt($User_Password);
	if (!filter_var($User_Username, FILTER_VALIDATE_EMAIL)) {
	$sql_result = $db->select("hnw_users", array(), array("User_Username"=>$User_Username, "User_Password"=>$Password))->results();
	}
	else {
	$sql_result = $db->select("hnw_users", array(), array("User_Email"=>$User_Username, "User_Password"=>$Password))->results();	
	}
	if(!empty($sql_result))
	{
		if($sql_result['User_Rank']<1)
		{
		$_SESSION["LoginErrors"][] = "Your account has not been activated yet.";
		} else {
		//start af login sessions med database værdier
		$_SESSION["User_ID"] = $sql_result['User_ID'];
		unset($_SESSION["LoginErrors"]);
		}
	} else {
	$_SESSION["LoginErrors"][] = "Wrong Login, please try again";
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
?>