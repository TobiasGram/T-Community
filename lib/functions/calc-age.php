<?php
function age($birthday){
 list($year, $day, $month, ) = explode("-", $birthday);
 $year_diff  = date("Y") - $year;
 $month_diff = date("m") - $month;
 $day_diff   = date("d") - $day;
 if ($day_diff < 0 && $month_diff==0) $year_diff--;
 if ($day_diff < 0 && $month_diff < 0) $year_diff--;
 return $year_diff;
}
?>
