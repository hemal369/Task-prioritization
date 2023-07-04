<?php 
 include 'authenticate.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dropdown Demo</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <!-- Load required CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>


<?php

if(isset($_POST['submit'])){


    // Get values from AJAX request
	$firstDropDownVal = $_POST["dd1"];
	$secondDropDownVal = $_POST["dd2"];

    echo $firstDropDownVal;
	
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

    $iquery = mysqli_query($conn,$sql);

  if($iquery){
    echo "worked";
  }else{
    echo "invalid";
  }
   
 
    
}

	
?>


<form method="POST">

<h2>Choose Two Values:</h2>
	<select name="dd1" id="dropdown1" onchange="updateDropdown2()">
		<option selected hidden>--Select--</option>
		<option value="importance">importance</option>
		<option value="urgency">urgency</option>
		<option value="effort">effort</option>
	</select>
	<select name="dd2" id="dropdown2">
		<option selected hidden>--Select--</option>
	</select>

        <label for="timestamp">Timestamp:</label>
		<input type="text" name="datetimepicker" id="datetimepicker" />

    <button type="submit" name="submit">Submit</button>
</form>
	<script>
		function updateDropdown2() {
			var dropdown1 = document.getElementById("dropdown1");
			var dropdown2 = document.getElementById("dropdown2");

			// Clear dropdown2 options
			dropdown2.innerHTML = "<option selected hidden>--Select--</option>";

			// Add options to dropdown2 based on dropdown1 selection
			if (dropdown1.value === "importance") {
				dropdown2.innerHTML += "<option value=\"urgency\">urgency</option>";
				dropdown2.innerHTML += "<option value=\"effort\">effort</option>";
			} else if (dropdown1.value === "urgency") {
				dropdown2.innerHTML += "<option value=\"importance\">importance</option>";
				dropdown2.innerHTML += "<option value=\"effort\">effort</option>";
			} else if (dropdown1.value === "effort") {
				dropdown2.innerHTML += "<option value=\"importance\">importance</option>";
				dropdown2.innerHTML += "<option value=\"urgency\">urgency</option>";
			}
		}
	</script>


    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include jQuery and Bootstrap JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Load jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Load moment.js -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<!-- Load date range picker -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
		// Initialize date time picker
		$(function() {
			$('#datetimepicker').daterangepicker({
				timePicker: true,
				singleDatePicker: true,
				timePicker24Hour: true,
				locale: {
					format: 'YYYY-MM-DD HH:mm:ss'
				}
			});
		});
	</script>


	<script>
		$(document).ready(function(){
			$("#submitBtn").click(function(){
				var firstDropDownVal = $("#firstDropDown").val();
				var secondDropDownVal = $("#secondDropDown").val();
				
				$.ajax({
					type: "POST",
					url: "insert.php",
					data: { firstDropDownVal: firstDropDownVal, secondDropDownVal: secondDropDownVal },
					success: function(response){
						alert(response);
					}
				});
			});
		});
	</script>
</body>
</html>

