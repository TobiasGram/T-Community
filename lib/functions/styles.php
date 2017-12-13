<?php
function add_styles($styleOutput = "", $folder="assets/css/")
{
	global $website_styles;
	foreach ($website_styles as $key => $CssStyle):
	$styleOutput .=  "<link href='".$folder.$CssStyle."' rel='stylesheet' type='text/css'>\n";
	endforeach;
	return $styleOutput;
}
?>
