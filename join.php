<?php 
include_once "lib/bundle-all.php";
createHead("Join us!");
echo "<body>";
include "lib/template/navbar.php";
?>
<div class="container mainpage">  
<h2>CREATE AN ACCOUNT</h2>
<div class="col-md-6">
<?php
// 
$Errors = array();
$Validated = false;
$User_Username = (isset($_POST['User_Username'])  ? trim($_POST['User_Username']) : "");
$User_Password = (isset($_POST['User_Password'])  ? trim($_POST['User_Password']) : "");
$User_Password_Comfirm = (isset($_POST['User_Password_Comfirm'])  ? trim($_POST['User_Password_Comfirm']) : "");
$User_Email = (isset($_POST['User_Email'])  ? trim($_POST['User_Email']) : "");
$User_Firstname = (isset($_POST['User_Firstname'])  ? trim($_POST['User_Firstname']) : "");
$User_Lastname = (isset($_POST['User_Lastname'])  ? trim($_POST['User_Lastname']) : "");
$User_Birthdate = (isset($_POST['User_Birthdate'])  ? trim($_POST['User_Birthdate']) : "");
$PostCaptcha = (isset($_POST['Captcha'])  ? trim($_POST['Captcha']) : "");
if (isset($_POST['User_Username'])) {
	$CountUsers = $db->prepare("SELECT count(*) FROM hnw_users WHERE User_username = :Author");
    $CountUsers->execute(array(":Author"=>$User_Username));
    $UserCheck = $CountUsers->fetch(PDO::FETCH_NUM);
    
	if (ValInput($User_Username)==false) {
		$Errors[] = "Please type your wanted username correct";
	}
	if (ValInput($User_Password)==false) {
		$Errors[] = "Please ype your wanted pasword correct";
	}
	if (!filter_var($User_Email, FILTER_VALIDATE_EMAIL)) {
		$Errors[] = "Please type your e-mail correct";
	}
	if ($User_Password!=$User_Password_Comfirm) {
		$Errors[] = "Your passwords does not match";
	}
	if (ValInput($User_Firstname)==false) {
		$Errors[] = "Please type your first name correct";
	}
	if (ValInput($User_Lastname)==false) {
		$Errors[] = "Please type your last name correct";
	}
	if (ValInput($User_Birthdate)==false) {
		$Errors[] = "Please type your day of birth";
	}
	if (age($User_Birthdate)<=18) {
		$Errors[] = "You <u>must</u> be over 18 years old to sign up";
	}
	if (preg_match("/[^a-zæøåÆØÅ0-9-_]/i", $User_Username)) {
		$Errors[] = "Username contains invalid characters please use digits and letters";
	}
	if ($UserCheck[0]!=0) {
		$Errors[] = "The username <b>".$User_Username."</b> is not Available";	
	}
	if ($_SESSION["Captcha"]!=$PostCaptcha) {
		$Errors[] = "The Captcha code was wrong";		
	}

	//tjekker om der er fejl og hvis der er udskriver den det
	if (count($Errors)>0) {
	foreach ($Errors as $key => $Error):
		echo '<div class="alert alert-danger alert-dismissable">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		echo '<strong>Warning!</strong> '.$Error.'.</div>';
	endforeach;
	} 
	else 
	{
		// laver aktiverings kode
		$CreateCode = sha1('Safety'.$User_Username.'first');
		$CreateCode = substr($CreateCode,0,12);
		// Aktiverings mail set up
		$ActivatationURL = "http://localhost/T-community/";
		$WebsiteMail = "localhost@localhost.com";
		$subject = 'Activatation mail | T-Community'; 
		$message = 'Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
					------------------------
					Username: '.$User_Username.'
					Password: '.$User_Password.'
					------------------------
					Please click this link to activate your account: '.$ActivatationURL.'verify.php?email='.$User_Email.'&code='.$CreateCode; 
		$headers = 'From:'. $WebsiteMail . "\r\n"; 
		$DataToSql = array(
			"User_Username"=>$User_Username,
			"User_Password"=>TobiKrypt($User_Password), 
			"User_Email"=>$User_Email, 
			"User_Firstname"=>$User_Firstname,
			"User_Lastname"=>$User_Lastname,
			"User_Birthdate"=>$User_Birthdate,
			"User_ActivationCode"=>$CreateCode
		);


		// opret bruger i databasen
		$db->insert("hnw_users", $DataToSql);
		mail($User_Email, $subject, $message, $headers); // Send mail
		$Validated = true;


		// udskriver at bruger er oprettet
		echo '<div class="alert alert-success alert-dismissable">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		echo '<strong>Success!</strong><br />Your account has been created, an activation mail has been sendt to you.</div>';
	}
}

if ($Validated==false):
// opbygger et simpelt HTML form
$Form = new Form("join.php","post");
echo $Form->build;
echo $Form->addInput("User_Username","text","Username","form-group", "form-control","CheckUser");
echo "<div id='username_availability'></div>";
echo $Form->addInput("User_Firstname","text","First name");
echo $Form->addInput("User_Lastname","text","Last name");
echo $Form->addInput("User_Email","email","Email");
echo $Form->addInput("User_Birthdate","date","Birthdate");
echo $Form->addInput("User_Password","password","Password","form-group","form-control","Password");
echo $Form->addInput("User_Password_Comfirm","password","Password again","form-group","form-control","Password_comfirm");
echo "<div id='password_check'></div>";
?>

<div class="form-group row">
<div class="col-sm-6">
<label>Captcha check</label>
<?php
$CaptchaCode = substr(preg_replace('/[0-9]+/', '', md5(rand())),0,5);
$_SESSION["Captcha"] = $CaptchaCode;
?>
<p><img src="lib/captcha.php"></p>
</div>
<div class="col-sm-6">
<label>Write the code to the left</label>
<input type="captcha" id="captcha" class="form-control" name="Captcha">
</div>
</div>
<div id="Terms" class="collapse" style="height:500px;overflow-y: scroll;">

</div>
<?php
echo "<small>By clicking Sign Up, you agree to our <a data-toggle='modal' href='lib/modals/terms.html' data-target='#RemoteModal'>Terms & Conditions</a> and that you have read our Data Policy.</small><br />";
echo $Form->submitBtn("Sign Up");
echo $Form->end;
endif;
?>
</div>
<div class="col-md-6">
	<h3>Member benefits</h3>
<div class="well">
	<p>You will get <u>all</u> theese benefits as a member.</p>
	<ul class="nav list">
		<li><a>Personal Tagwall</a></li>
		<li><a>Personal Profile</a></li>
		<li><a>Free VIP Membership</a></li>
	</ul>
</div>
</div>
</div>
<?php include "lib/template/footer.php";?>

<script src="assets/javascript/join-validation.js" type="text/javascript"></script>
<script>

$('#CheckUser').keyup(function(){
			if($('#CheckUser').val().length < 3){
			}else{			
				check_availability();
			}
});	
function check_availability(){
		var username = $('#CheckUser').val();
		$.post("actions/check-username.php", { username: username },
			function(result){
				if(result < 1){
					$('#username_availability').html('<div class="is_available">The username <b>' +username + '</b> is Available</div>');
				}else{
					$('#username_availability').html('<div class="is_not_available">The username <b>' +username + '</b> is not Available</div>');
				}
		});

}  
$('input.form-control').keyup(function()
{
    if( $(this).val().length <= 2 ) {
        $(this).addClass('input-warning');
        $(this).removeClass('input-success');
    }
     if( $(this).val().length >= 2 ) {
        $(this).removeClass('input-warning');
        $(this).addClass('input-success');
    }
});
$('#captcha').keyup(function()
{
    if( $(this).val()!=="<?php echo $_SESSION["Captcha"];?>") {
        $(this).addClass('input-warning');
        $(this).removeClass('input-success');
    } else {
        $(this).removeClass('input-warning'); 	
        $(this).addClass('input-success');
    }
});
$('#Password_comfirm').keyup(function()
{
    if( $(this).val()!==$('#Password').val()) {
        $(this).addClass('input-warning');
        $(this).removeClass('input-success');
        $('#password_check').html("<div class='is_not_available'>The passwords does not match.</div>");
    } else {
        $(this).removeClass('input-warning'); 	
        $(this).addClass('input-success');
        $('#password_check').empty();
    }
});

</script>
</body>
</html>
