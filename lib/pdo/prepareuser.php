<?

include('classes/pdo/class.sys.pdowrapper.php');
$config = array("host"=>"mysql29.unoeuro.com", 
	"dbname"=>'andersodgaard_dk_db',
	"username"=>'andersodgaa_dk', 
	"password"=>'xhdfcggyh7');
 $db = new PdoWrapper($config);
 $db->setErrorLog(true);


/*Date of Creation*/
$counter = time() - (259200); // 3 dage i sekunder
$oprettet  = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-3, date("Y"));

echo date("Y-m-d H:i:s", $oprettet) . '<br/>';

if($oprettet < $counter){
    echo 'SLET MIG NU';
}else{
    echo 'JEG ER OK :)';
}



/*Fetching IP Adress*/
$ip = $_SERVER['REMOTE_ADDR'];



/*Fetching UserData from Forms*/

$name  = $_POST['name'];

$lastname  = $_POST['lastname'];

$username  = $_POST['username'];

$password  = $_POST['password'];

$email  = $_POST['email'];

$confirmemail  = $_POST['confirmemail'];

$rescueemail  = $_POST['rescueemail'];

$profiletype  = $_POST['profiletype'];

$sex  = $_POST['sex'];

$age  = $_POST['age'];

$country  = $_POST['country'];
$active = 0;
$facebook = 0;
$skype = 0;
/*Optional*/

$steamusername  = $_POST['steamusername'];

$bnetusername  = $_POST['bnetusername'];

$wotusername  = $_POST['wotusername'];

$originusername  = $_POST['originusername'];

$dateofcreation = date("Y-m-d H:i:s", time());

/*Encrypt password sequence*/
$password = sha1($password);
$activationhash = sha1('42'.$email.'kager');

/*Table TA_Users*/

$db->insert("TA_Users", array(
"RealName"=>$name, 
"RealLastname"=>$lastname, 
"Username"=>$username, 
"Password"=>$password,
"Email"=>$email,
"Rescuemail"=>$rescueemail,
"ProfileType"=>$profiletype,
"Sex"=>$sex,
"Age"=>$age,
"Steam_Username"=>$steamusername,
"Battlenet_ID"=>$bnetusername,
"WOT_Username"=>$wotusername,
"Origin_Username"=>$originusername,
"Skype"=>$skype,
"Facebook"=>$facebook,
"ipadress"=>$ip,
"DateOfCreation"=>$dateofcreation,
"Active"=>$active,
"ActivationHash"=>$activationhash ));
/*Profile_id,RealName,RealLastname,Username,Password,Email,Rescuemail,ProfileType,Sex,Age,Steam_Username,Battlenet_ID,WOT_Username,Origin_Username,Skype,Facebook,ipadress,DateOfCreation,Active,ActivationHash*/



/*Output userdata*/
echo  $ip;
echo "<br>";
echo $name;
echo "<br>";
echo $lastname;
echo "<br>";
echo $username;
echo "<br>";
echo $password;
echo "<br>";
echo $email;
echo "<br>";
echo $confirmemail;
echo "<br>";
echo $rescueemail;
echo "<br>";
echo $profiletype;
echo "<br>";
echo $sex;
echo "<br>";
echo $age;
echo '<br>';
echo $country;
echo "<br>";
echo $steamusername;
echo "<br>";
echo $bnetusername;
echo '<br>';
echo $wotusername;
echo "<br>";
echo $originusername;

echo "<br>";
echo $originusername;
echo "<br>";
echo $activationhash;

$to      = $email; // Send email to our user
$subject = 'Activatation mail from TeamAgent'; // Give the email a subject
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$username.'

------------------------
 
Please click this link to activate your account:
http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$activationhash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@teamagent.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email




?>
