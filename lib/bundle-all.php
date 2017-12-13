<?php
session_start();
$Subfolder = "/HashnWeed/";
$MyRoot = $_SERVER['DOCUMENT_ROOT'].$Subfolder;
/*
PHP ER LAVET AF TOBIAS T.R. GRAM OG MÅ IKKE BENYTTES UDEN SAMMENTYKKE
*/
include $MyRoot."/lib/connect.php";
/* laver global $vars til diverse funktioner,classer og til sider */
$website_title = "T-Community";
$website_meta_data = array(
array("name"=>"viewport", "content"=>"width=device-width, initial-scale=1"),
array("name"=>"description", "content"=>"Description goes here"),
array("name"=>"keywords", "content"=>"Key,lock,safety"),
array("name"=>"copyright", "content"=>"Tobias Gram"),
array("name"=>"author", "content"=>"Tobias Gram"),
array("name"=>"designer", "content"=>"Tobias Gram"),
array("name"=>"robots", "content"=>"index, follow")
);
$website_styles = array("bootstrap.css","font-awesome.css","frame.css");

/* Bruger dataer som ip m.m. */
$ip = $IP = $_SERVER['REMOTE_ADDR'];
$SystemData = explode(" ", $_SERVER['HTTP_USER_AGENT']);
$StyreSystem = $SystemData[2];
$Browser = $browser = $SystemData[6];

foreach (glob("lib/classes/*.php") as $filename)
{
    include $filename;
}
foreach (glob("lib/functions/*.php") as $filename)
{
    include $filename;
}

function createHead($website_sub_title="", $lang="en") {
echo "<!DOCTYPE html>\n";
echo "<html lang='".$lang."'>\n";
echo "<head>\n";
echo "<title>".$GLOBALS['website_title']." | ".$website_sub_title."</title>\n";
echo "<meta charset=\"UTF-8\">";
echo add_metatags();
echo add_styles();
echo "</head>\n";
echo "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>\n";
}
if (isset($_SESSION["User_ID"])) {
$MyID = $_SESSION["User_ID"];
}
?>