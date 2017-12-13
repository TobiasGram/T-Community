<?php
class Form {
	public function __construct($action, $Formmethod) {
		$this->build = "<form action='".$action."' method='".$Formmethod."'>\n";
		$this->end = "</form>\n";
	}
	function addInput($name="feildname",$type="text",$label="",$divClass="form-group",$inputClass="form-control",$inputID="") {
		$result = "";
		if (!empty($divClass)) {	$result .= "<div class='".$divClass."'>";}
		if (!empty($label)) {	$result .= "<label>".$label."</label>";}		
		$result .= "<input type='".$type."' placeholder='".$label."' name='".$name."' class='".$inputClass."' id='".$inputID."' autocomplete='off' required>";
		
		if (!empty($divClass)) {	$result .= "</div>\n";}
		
		return $result;
	}
	function addSelect($name="feildname",$options = array(array("title"=>"Valgt","value"=>"")), $label="" ,$divClass="form-group",$inputClass="form-control") {
		$result = "";
		if (!empty($divClass)) {	$result .= "<div class='".$divClass."'>";}
		if (!empty($label)) {	$result .= "<label>".$label."</label>";}		
		$result .= "<select name='".$name."' class='".$inputClass."'>\n";
        foreach ($options as $key => $option):
	    $result .= "<option value='".$option["value"]."'>".$option["title"]."</option>\n";
        endforeach;
		$result .= "</select>\n";
		if (!empty($divClass)) {	$result .= "</div>\n";}
		
		return $result;
	}
    function submitBtn($Btntext="Send", $Btnclass="btn btn-success") {
    return "<input type='submit' class='".$Btnclass."' value='".$Btntext."'>\n";
    }
}
?>
