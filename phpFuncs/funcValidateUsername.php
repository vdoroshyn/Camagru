<?php

function validateUsername(&$errorArray, $username) {
	$pattern = '/^[a-zA-Z0-9_]+$/';

	if ($username == "" || strlen($username) < 4 || strlen($username) > 8) {
		$errorArray['errorValue'] = "enter a username (4-8 characters)";
  	    $errorArray['inputClass'] = "field invalid-field";
  	    $errorArray['errorClass'] = "error active-error";
  	    return 0;
  	} elseif (preg_match($pattern, $username) !== 1) {
		$errorArray['errorValue'] = "special characters are not allowed";
  	    $errorArray['inputClass'] = "field invalid-field";
  	    $errorArray['errorClass'] = "error active-error";
  	    return 0;
	}
	return 1;
}
	
?>
