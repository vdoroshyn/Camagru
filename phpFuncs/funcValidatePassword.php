<?php

function validatePassword(&$errorArray, $pswd) {
	$pattern = '/^(?=[a-zA-Z0-9_]{8,32}$)(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d)/';

	if ($pswd == "") {
		    $errorArray['errorValue'] = "enter a new password";
  	    $errorArray['inputClass'] = "field invalid-field";
  	    $errorArray['errorClass'] = "error active-error";
  	    return 0;
  	} elseif (preg_match($pattern, $pswd) !== 1) {
		    $errorArray['errorValue'] = "no special characters\nat least one uppercase letter\nat least one lowercase letter\nat least one digit\nfrom 8 to 32 characters";
  	    $errorArray['inputClass'] = "field invalid-field";
  	    $errorArray['errorClass'] = "error active-error";
  	    return 0;
	}
	return 1;
}

function validateRepeatPassword(&$errorArray, $pswd, $repeatPswd) {
  $pattern = '/^(?=[a-zA-Z0-9_]{8,32}$)(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d)/';

  if (($pswd == "" && $repeatPswd == "") || ($pswd != "" && $repeatPswd == "")) {
        $errorArray['errorValue'] = "re-enter your password";
        $errorArray['inputClass'] = "field invalid-field";
        $errorArray['errorClass'] = "error active-error";
        return 0;
    } elseif ($pswd == "" && $repeatPswd != "") {
        $errorArray['errorValue'] = "you have to enter a password first";
        $errorArray['inputClass'] = "field invalid-field";
        $errorArray['errorClass'] = "error active-error";
        return 0;
    } elseif (preg_match($pattern, $repeatPswd) !== 1) {
        $errorArray['errorValue'] = "no special characters\nat least one uppercase letter\nat least one lowercase letter\nat least one digit\nfrom 8 to 32 characters";
        $errorArray['inputClass'] = "field invalid-field";
        $errorArray['errorClass'] = "error active-error";
        return 0;
    } elseif ($pswd != $repeatPswd) {
        $errorArray['errorValue'] = "passwords do not match";
        $errorArray['inputClass'] = "field invalid-field";
        $errorArray['errorClass'] = "error active-error";
        return 0;
  }
  return 1;
}

?>
