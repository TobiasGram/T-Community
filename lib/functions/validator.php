<?php

function ValInput($string, $type="text", $minLength=3, $maxLength=30) {
	$check = false;

    if (!empty($string)) {
	$check =  true;
	} else { 
	$check = false;
	}
	
	if (strlen($string)>=$minLength && strlen($string)<$maxLength) {
	$check =  true;
	} else { 
	$check = false;
	}
	
	return $check;
	}
?>
