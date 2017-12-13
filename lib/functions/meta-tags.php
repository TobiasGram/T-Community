<?php
function add_metatags($MetaOutput = "")
{
	global $website_meta_data;
	foreach ($website_meta_data as $key => $meta):
	$MetaOutput .=  "<meta name='".$meta["name"]."' content='".$meta["content"]."'>\n";
	endforeach;
	return $MetaOutput;
}
?>