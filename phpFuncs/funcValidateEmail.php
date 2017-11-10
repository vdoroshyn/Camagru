<?php

function validateEmail(&$errorArray, $email) {
	$pattern = '/^[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*@[a-zA-Z-]+\.([a-zA-Z]+){2,}(\.([a-zA-Z]+){2,})*$/';

	if ($email == "" || preg_match($pattern, $email) !== 1) {
		$errorArray['errorValue'] = "enter a valid email address";
  	    $errorArray['inputClass'] = "field invalid-field";
  	    $errorArray['errorClass'] = "error active-error";
  	    return false;
	}
	return true;
}
	
?>
