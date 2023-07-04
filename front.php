<?php 
 include 'authenticate.php';
?>

<?php 

$u_id = $_SESSION['user_id'];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <link rel="stylesheet" href="./css/front.css">
    <title>FirstPage</title>
</head>
<body>



<?php

if(isset($_POST['submit'])){


    // Get values from AJAX request
	$firstDropDownVal = $_POST["dd1"];
	$secondDropDownVal = $_POST["dd2"];

    $time_stamp_val = $_POST['time_stamp'];

    echo $time_stamp_val;

    echo $firstDropDownVal;
	
	// Assign values based on selection
	if ($firstDropDownVal == "Importance") {
		$value1 = 0.5;
		if ($secondDropDownVal == "Urgency") {
			$value2 = 0.3;
			$value3 = 0.2;
		} else {
			$value2 = 0.2;
			$value3 = 0.3;
		}
	} else if ($firstDropDownVal == "Urgency") {
		$value2 = 0.5;
		if ($secondDropDownVal == "Importance") {
			$value1 = 0.3;
			$value3 = 0.2;
		} else {
			$value1 = 0.2;
			$value3 = 0.3;
		}
	} else {
		$value3 = 0.5;
		if ($secondDropDownVal == "Importance") {
			$value1 = 0.3;
			$value2 = 0.2;
		} else {
			$value1 = 0.2;
			$value2 = 0.3;
		}
	}

	// Insert values into database

    date_default_timezone_set("Asia/Kolkata");

    $current_timestamp = time();

    $user_end_time = strtotime($time_stamp_val);

    if($user_end_time <= $current_timestamp){
         ?>
         <script>
            alert("please select the time in today's time range");
         </script>
         <?php
    }else{
        $sql = "INSERT INTO myTable (userid, importance, urgency, effort, user_time) VALUES ($u_id, $value1, $value2, $value3, '$time_stamp_val')";
        
    $iquery = mysqli_query($conn,$sql);
    // $iquery2 = mysqli_query($conn,$sql2);

  if($iquery){
    header("location:i2.php");
  } 

    }
	
    // $sql2 = "INSERT INTO user_time (duration) VALUES ('$time_stamp_val')";
    
}

	
?>


<?php 

$sql_name = "SELECT username FROM registration WHERE userid=$u_id";

$sql_name_query = mysqli_query($conn,$sql_name);

$res_name = mysqli_fetch_assoc($sql_name_query);

?>
    <section class="first_section">
    <div class="first_container">
        <div class="first_heading" style="text-transform: uppercase;">
        <h3>WELCOME</h3>
        <h1 style="padding-left: 50px;text-transform: uppercase;"></h1></h1> <?php echo $res_name['username']; ?></h1>
        <h2>Organize your tasks and lead to <br> a productive day.</h2>
        <div class="button-container">
            <a class="navigation-button" href="#second-section">Features</a>
        <!-- </div>
        <div class="button-container"> -->
            <a class="navigation-button" href="#third-section">Get Started</a>
        </div>
        </div>
        <div class="image">
        <div class=" img_back_color"></div>
        <img src="./assets/firstimg3.png" alt="Image">
        </div>
    </div>

</section>
<hr>
<section id = "second-section" class="second_section">
    <h1>Features</h1>
    
    <div class="sticky-note-container">
        <div class="sticky-note">
            <div class="image-container">
                <img src="./assets/tasks.png" alt="Image 1">
            </div>
            <h2>Be Organized</h2>
            <p style="padding-top: 15px;">Get prioritized list of tasks</p>
        </div>
        
        <div class="sticky-note">
            <div class="image-container">
                <img src="./assets/icons8-tags-64.png" alt="Image 1">
            </div>
            <h2>Categorize</h2>
            <p style="padding-top: 15px;">Add tags according to the type of task.</p>
        </div>
        
        <div class="sticky-note">
            <div class="image-container">
                <img src="./assets/efficiency (1).png" alt="Image 1">
            </div>
            <h2>Increase Efficiency</h2>
            <p>Helps you plan your day to day activities to maximize productivity!</p>
        </div>
        
        <div class="sticky-note">
            <div class="image-container">
                <img src="./assets/timer.png" alt="Image 1">
            </div>
            <h2>Set Timer</h2>
            <p style="padding-top: 15px;">A countdown timer for every task.</p>
        </div>
    </div>
</section>
<hr>
<section id = "third-section" class="third_section">
    <h1>Get Started</h1>
    
    <div class="container">
        <div class="left-part">
            <div class="sticky-notes-container">
            <div class="sticky-notes">
                <h3>Importance</h3>
                <p>Importance refers to the significance or priority of a task, considering its long-term impact or alignment with goals.</p>
                
            </div>
            
            <div class="sticky-notes">
                <h3>Urgency</h3>
                <p>Urgency represents the time sensitivity or immediate need for completing a task.</p>
                
            </div>
            
            <div class="sticky-notes" >
                <h3>Effort</h3>
                <p>Effort refers to the level of time, energy, or resources required to accomplish a task.</p>
                <!-- <div class="tooltip">Additional text for Importance</div> -->
            </div>
        </div>
        </div>
        
        <div class="right-part">
            <!-- Add content for the right part here -->
            <form method="POST">
        <div class = "dropdown-container">
            <h2 style="margin-top: 1px;">Choose Priorities:</h2>
	<select name="dd1" id="dropdown1" onchange="updateDropdown2()" required>
		<option selected hidden>--Select First Priority--</option>
		<option value="Importance">Importance</option>
		<option value="Urgency">Urgency</option>
		<option value="Effort">Effort</option>
	</select>
   
	<select name="dd2" id="dropdown2" required>
		<option selected hidden>--Select Second Priority--</option>
	</select>
    </div>
    <h2>Clock Out Time?</h2>
	<!-- <form method="post" action="">
		<label for="timestamp">Timestamp:</label>
		<input type="text" name="timestamp" id="timestamp">
		<input type="submit" name="submit" value="Submit">
	</form> -->
     
    
    <label for="timestamp">Timestamp:</label>
    
      <input type="text" name="time_stamp" id="timestamp" placeholder="Select a timestamp" required>
    
        <div class="button-container" style="margin-top: 170px; margin-left: 580px; font-weight: bold;">
            <button type="submit" name="submit" class="navigation-button2"><b>PROCEED</b></button>
        </div>
        </form>
        </div> 
    </div>
    
</section>

    
       
<script>
     const currentDate = new Date();
const year = currentDate.getFullYear();
const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
const day = currentDate.getDate().toString().padStart(2, '0');
const today = `${year}-${month}-${day}`;

document.getElementById('timestamp').setAttribute('min', today);
     document.getElementById('timestamp').setAttribute('min', currentDate);
</script>
<script>
    function updateDropdown2() {
        var dropdown1 = document.getElementById("dropdown1");
        var dropdown2 = document.getElementById("dropdown2");

        // Clear dropdown2 options
        dropdown2.innerHTML = "<option selected hidden>--Select--</option>";

        // Add options to dropdown2 based on dropdown1 selection
        if (dropdown1.value === "Importance") {
            dropdown2.innerHTML += "<option value=\"Urgency\">Urgency</option>";
            dropdown2.innerHTML += "<option value=\"Effort\">Effort</option>";
        } else if (dropdown1.value === "Urgency") {
            dropdown2.innerHTML += "<option value=\"Importance\">Importance</option>";
            dropdown2.innerHTML += "<option value=\"Effort\">Effort</option>";
        } else if (dropdown1.value === "Effort") {
            dropdown2.innerHTML += "<option value=\"Importance\">Importance</option>";
            dropdown2.innerHTML += "<option value=\"Urgency\">Urgency</option>";
        }
    }

    $(function() {
      $("#timestamp").datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "HH:mm:ss",
        showOn: "button",
        buttonImage: "./assets/icons8-calendar-48.png", // Replace with your own calendar icon image
        buttonImageOnly: true,
        buttonText: "Select a timestamp",
        beforeShow: function(input, inst) {
          inst.dpDiv.css({
            top: "auto",
            bottom: $(input).outerHeight() + "px"
          });
        }
      });
    });
	</script>



</body>
</html>