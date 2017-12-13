<?php
function delete($d_table, $d_id) {}
function isAdmin($rank) {
	if ($rank>2) {
	return true;
	} else {
	return false;
	}
}
?>
