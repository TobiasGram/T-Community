<?php
class user 
{
	public  $db;
    public function __construct($new_ID) { 
		global $db;
		$Hent = $db->select("hnw_users", array(),array('User_ID'=>$new_ID))->results();
		$Online = ($Hent['User_Online'] > 0 ? 'Online' : 'Offline');
		$this->data = array
		(
			"Username"=>$Hent['User_Username'],
			"Firstname"=>$Hent['User_Firstname'],
			"Lastname"=>$Hent['User_Lastname'],
			"Birthdate"=>$Hent['User_Birthdate'],
			"Status"=>$Online,
			"Rank"=>$Hent['User_Rank'],
			"Picture"=>$Hent['User_Picture'],
		);
		}
} 
?>
