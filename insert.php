<?php 
 include 'authenticate.php';
?>


<?php

	// Get values from AJAX request
	$firstDropDownVal = $_POST["firstDropDownVal"];
	$secondDropDownVal = $_POST["secondDropDownVal"];
	
	// Assign values based on selection
	if ($firstDropDownVal == "importance") {
		$value1 = 0.5;
		if ($secondDropDownVal == "urgency") {
			$value2 = 0.3;
			$value3 = 0.2;
		} else {
			$value2 = 0.2;
			$value3 = 0.3;
		}
	} else if ($firstDropDownVal == "urgency") {
		$value2 = 0.5;
		if ($secondDropDownVal == "importance") {
			$value1 = 0.3;
			$value3 = 0.2;
		} else {
			$value1 = 0.2;
			$value3 = 0.3;
		}
	} else {
		$value3 = 0.5;
		if ($secondDropDownVal == "importance") {
			$value1 = 0.3;
			$value2 = 0.2;
		} else {
			$value1 = 0.2;
			$value2 = 0.3;
		}
	}

	// Insert values into database
	$sql = "INSERT INTO myTable (importance, urgency, effort) VALUES ($value1, $value2, $value3)";
    
?>