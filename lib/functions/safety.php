<?php
function TobiKrypt($String) {
$safeString = "EtSikkerhedsord";
$safeNumber = 420;
$Xtrakrypteret = sha1(($safeNumber-60).md5($String)."' + '".$safeString.":D0NTCR@CKTHIS$"."_Cause_U_Wont");
return $Xtrakrypteret;
}
?>