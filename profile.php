<?php
include_once "lib/bundle-all.php";
if (!is_numeric($_GET['id'])) {
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;	
}
$id = $_GET['id'];
$UserExists = $db->select("hnw_users", array(), array("User_ID"=>$id))->results();
if (empty($UserExists)) {
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;		
}
$User = new user($id); 
$User = $User->data;
createHead($User["Username"]);
echo "<body>";
include "lib/template/navbar.php";
?>
<div class="container mainpage">
	<div class="row">
		<div class="col-lg-3 col-sm-6">

            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
                    <img alt="" src="uploads/<?php echo $User["Picture"];?>">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" a data-toggle='modal' href='lib/modals/private-message.html' data-target='#RemoteModal'><?php echo $User["Username"];?></a>
                    </div>
                    <div class="desc">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
					<?php echo $User["Firstname"]." ".$User["Lastname"];?>
					</div>
                    <div class="desc">
                    	<?php echo ($User["Status"]=="Offline" ? "<span style='color:red;'>".$User["Status"]."</span>" : "<span style='color:green;'>".$User["Status"]."</span>");?>
                    </div>
                    <div class="desc">Age <?php echo age($User["Birthdate"]);?></div>
                </div>
            </div>

        </div>
        <div class="col-lg-9 col-sm-6">
        <?php
        $get_Notifications = $db->prepare("SELECT count(*) FROM hnw_users_tagwall WHERE User_Tagwall_OwnerID = :Author");
        $get_Notifications->execute(array(":Author"=>$id));
        $Notifications = $get_Notifications->fetch(PDO::FETCH_NUM);
        ?>
        <h3>Tagwall</h3>
        <hr>
        <div class="container-fluid">
            <a href="#" class="btn btn-success pull-right"><i class="fa fa-comment" aria-hidden="true"></i> Add Tag</a>
            <h5>
                There is <b><?php echo $Notifications[0];?></b> Tags on this wall
            </h5>
        </div>
        <div class"tagwall">
        <?php 
        $sql = "SELECT * FROM hnw_users_tagwall LEFT JOIN hnw_users  ON hnw_users_tagwall.User_Tagwall_UserID=hnw_users.User_ID WHERE User_Tagwall_OwnerID = :ID Order by hnw_users_tagwall.User_Tagwall_UserID DESC";
        $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $query->execute(array(":ID"=>$id));
        $Tagwall_List = $query->fetchAll();
        if (!empty($Tagwall_List))  {
        foreach($Tagwall_List as $tag):
        $TagUserID = $tag["User_Tagwall_UserID"];
        $TagUser = $tag["User_Username"];
        $TagUserPicture =  $tag["User_Picture"];
        ?>
        <div class="panel panel-default">
        <div class="panel-body">
        <img src="uploads/<?php echo $TagUserPicture;?>" class='img-circle pull-left' style="width:100px;height:100px;margin-right:1em;">
        <h4 class="text-muted"><?php echo $tag["User_Tagwall_Title"];?></h4>
        <p><?php echo $tag["User_Tagwall_Text"];?></p>
        </div>
        <div class="panel-footer">Written by <a href="profile.php?id=<?php echo $TagUserID;?>"><?php echo $TagUser; ?></a></div>
        </div>
        <?php
        endforeach;
        }
        ?>
    </div>
	</div>
</div>
</div>
<?php include "lib/template/footer.php";?>
</body>
</html>