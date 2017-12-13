<?php 
include_once "lib/bundle-all.php";
createHead("Installation");
echo "<body>";
include "lib/template/navbar.php";
?>
<div class="container mainpage">    
	<style>
	.well {border:1.4px solid green;}
</style>
<h1>Installations guide</h1>
<p>
PHP og HTML koder findes her til set up af community
</p>
<h4>Boostrap Funktioner</h4>
<p>Du kan også teste nogle bootstrap funktioner blandt andet kan du <a data-toggle="modal" href="lib/modals/default.html" data-target="#RemoteModal">åbne</a> modals</p>
<hr>
<h3>Kode til en ny blank side</h3>
<pre>
&lt;?php
<span style="color:green">// Henter classes,scripts,functioner osv.</span>
include_once "lib/bundle-all.php";
<span style="color:green">// Opretter header med sub titlen "Sub titel her"</span>
createHead("Sub titel her");
echo "&lt;body&gt;";
<span style="color:green">// Henter top navigation</span>
include "lib/template/navbar.php";
?&gt;
<span style="color:#215693;">&lt;div class="container mainpage"&gt;</span>
<span style="color:green">&lt;!-- Sidens Indhold starter her --></span>
<span style="color:#33CCFF;font-weight: bolder;">&lt;h1&gt;BLANK SIDE&lt;/h1&gt;
&lt;p&gt;Med lidt tekst til hvis det var noget&lt;/p&gt;</span>
<span style="color:green">&lt;!-- Sidens Indhold slutter her --></span>
<span style="color:#215693;">&lt;/div&gt;</span>
&lt;/div&gt;
<span style="color:green">// Henter footer til siden</span>
&lt;?php include "lib/template/footer.php";?&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<iframe src="empty.php" class="well" frameborder="0" width="100%" height="600px" style="padding:0px;"></iframe>
<div class="row">
<div class="col-sm-6">
<h3>Display af community brugers oplysninger</h3>
<pre>
&lt;?php
<span style="color:green">// skab ny bruger og finder data'en udfra ID'en</span>
$FirstUser = new user(1); 
<span style="color:green">// udskriv bruger dataer således</span>
echo $FirstUser->data["Username"]."&lt;br />";
echo $FirstUser->data["Firstname"]."&lt;br />";
echo $FirstUser->data["Lastname"]."&lt;br />"; 
echo $FirstUser->data["Status"];
?&gt;
</pre>
<h5><b>Denne kode skulle gerne give dette output</b></h5>
<div class="well well-sm">
<?php
$FirstUser = new user(1);
echo $FirstUser->data["Username"]."<br />";
echo $FirstUser->data["Firstname"]."<br />";
echo $FirstUser->data["Lastname"]."<br />"; 
echo $FirstUser->data["Status"]; 
?>
</div>
<h3><b>GD billede funktioner (PHP art)</b></h3> 
<pre>
&lt;?php
header("Content-type: image/png"); 
$width = 200;
$height = 200;
$im = ImageCreateTrueColor($width, $height); 
$white = ImageColorAllocate($im, 255, 255, 255); 
ImageFillToBorder($im, 0, 0, $white, $white);
$black = ImageColorAllocate($im, 0, 0, 0);
$random = ImageColorAllocate($im, rand(0,255), rand(0,255), rand(0,255));
$red = ImageColorAllocate($im, 255, 0, 0);
ImageEllipse($im, 100, 100, 140, 80, $black);
ImageFilledEllipse($im, 100, 100, 50, 50, $random);
ImageFilledEllipse($im, 100, 100, 10, 10, $black);
imageline($im, 35,115, 70, 98, $red);
imageline($im, 55, 106,46,115, $red);
imageline($im, 49,93, 75, 98, $red);
imageline($im, 59,96, 65, 89, $red);
imageline($im, 126,98, 134,90, $red);
imageline($im, 127,98, 144,110, $red);
imageline($im, 145,111, 154,106, $red);
imageline($im, 145,111, 150,119, $red);
imageline($im, 93,125, 115,129, $red);
imageline($im, 93,125, 85,129, $red);
imagestring($im, 5, 10, 0, 'Look me ind the eye!', $black);
imagestring($im, 5, 10, 180, 'and say i am not high!', $black);
ImagePNG($im); 
ImageDestroy($im);
?>
</pre>
<h5><b>Denne kode skulle gerne give dette output</b></h5>
<div class="well well-sm">
	<div class="tip-trigger">
	<img src="image.php" class="tip-trigger">	<img src="image.php" class="tip-trigger">
	<p>0pdater og pupilen skifter farve automatisk</p>
</div>
</div>
</div>
<!-- new cell -->
<div class="col-sm-6">
<h3>Smart oprettelse af form og inputs</h3>
<pre>
&lt;?php
<span style="color:green">// Eksempel på valgmuligheder til select boxen</span>
$levels = array(
	array("title"=>"Valgt","value"=>""),
	array("title"=>"Level 1","value"=>"1"),
	array("title"=>"Level 2","value"=>"2"),
	array("title"=>"Level 3","value"=>"3"),
);
<span style="color:green">// Opret et form til logincheck.php </span>
$LoginForm = new Form("logincheck.php","post");
<span style="color:green">// Start opbygning af &lt;form&gt;</span>
echo $LoginForm->build;
<span style="color:green">// Opret Inputs og select felter således</span>
echo $LoginForm->addInput("User_username","text","Username");
echo $LoginForm->addInput("User_password","password","Password");
echo $LoginForm->addSelect("Levels", $levels, "Vælg Level");
<span style="color:green">// tilføj knap</span>
echo $LoginForm->submitBtn("Login");
<span style="color:green">// slut &lt;/form&gt;</span>
echo $LoginForm->end;
?&gt;
</pre>
<h5><b>Denne kode vil udskrive dette</b></h5>
<div class="well well-sm">
<?php
$levels = array(
	array("title"=>"Valgt","value"=>""),
	array("title"=>"Level 1","value"=>"1"),
	array("title"=>"Level 2","value"=>"2"),
	array("title"=>"Level 3","value"=>"3"),
);
$LoginForm = new Form("logincheck.php","post");
echo $LoginForm->build;
echo $LoginForm->addInput("User_username","text","Username");
echo $LoginForm->addInput("User_password","password","Password");
echo $LoginForm->addSelect("Levels", $levels, "Vælg Level");
echo $LoginForm->submitBtn("Login");
echo $LoginForm->end;
?>
</div>
</div>
<!-- cell end -->
</div>
</div>
<?php include "lib/template/footer.php";?>
</body>
</html>