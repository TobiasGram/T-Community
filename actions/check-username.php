<?php
        include "../lib/connect.php";
        $Username = (isset($_POST['username'])  ? $_POST['username'] : "");
        $get_Notifications = $db->prepare("SELECT count(*) FROM hnw_users WHERE User_username = :Author");
        $get_Notifications->execute(array(":Author"=>$Username));
        $Notifications = $get_Notifications->fetch(PDO::FETCH_NUM);
        echo $Notifications[0];
?>
