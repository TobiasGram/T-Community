<?php
include_once "lib/bundle-all.php";
createHead("Activation");
echo "<body>";
$Verify_Email =  (isset($_GET['email'])  ? trim($_GET['email']) : "");
$Verify_Code = (isset($_GET['code'])  ? trim($_GET['code']) : "");
include "lib/template/navbar.php";
$UserExists = $db->select("hnw_users", array(), array("User_Email"=>$Verify_Email))->results();

?>
<div class="container mainpage">
<!-- Sidens Indhold starter her -->
<h1>Activation</h1>
<?php 
if (!empty($UserExists))  {
    if ($Verify_Code==$UserExists["User_ActivationCode"]) 
    {
        if ($UserExists["User_Rank"]==0) {
        echo '<div class="alert alert-success alert-dismissable">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "<strong>Success!</strong> Your account is now activated, you can login now with your username and password.";
        echo '</div>';
        $db->update("hnw_users",array("User_Rank"=>1), array("User_Email"=>$Verify_Email));
        }
        else {
        echo '<div class="alert alert-info alert-dismissable">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "<strong>Info!</strong> Your account has already been activated.";
        echo '</div>';
        }    
    }
    else {
        echo '<div class="alert alert-warning alert-dismissable">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "<strong>Error!</strong> Something went wrong, sorry :-(";
        echo '</div>';
    }  
}
else {
        echo '<div class="alert alert-warning alert-dismissable">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "<strong>Error!</strong> Something went wrong, sorry :-(";
        echo '</div>';
}  
?>
</div>
</div>
<?php include "lib/template/footer.php";?>
</body>
</html>
