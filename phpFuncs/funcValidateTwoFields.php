<?php

/*
** the fucntion checks whether the fields are empty or not
** the validity of the data is checked in the next file
*/

function areTwoFieldsEmpty(&$errorArray, $field1, $field2) {
	if ($field1 != "" && $field2 != "") {
		return 1;
	}
	$errorArray['errorValue'] = "fill in both fields";
	$errorArray['inputClass'] = "field invalid-field";
	$errorArray['errorClass'] = "error active-error";
	return 0;
}

?>