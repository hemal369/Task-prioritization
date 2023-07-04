<?php 
 include 'authenticate.php';
?>

<?php 

$u_id = $_SESSION['user_id'];

?>

<?php
date_default_timezone_set("Asia/Kolkata");
// assume the total duration of tasks is 2 hours (in seconds)
$res2 = mysqli_query($conn , "select * from xyz where userid=$u_id");
 
$total_minutes=0;
$j=0;

while ($row2 = mysqli_fetch_assoc($res2)) {

     
    $total_minutes = $total_minutes+$row2['minutes'];
    $j++;
}

$j = ($j*30)/60;
// echo $j; 

$total_minutes = $total_minutes+$j;
 
// $total_minutes= $total_minutes*60;
 
// echo $total_minutes;

//  echo $total_minutes;


// get the user end time from the database
// replace the connection details with your own
 
$query = "SELECT user_time FROM mytable WHERE userid=$u_id";


 // replace 1 with the actual user ID
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // Query failed or returned no rows, redirect to another page
    header("Location: login.php");
    exit;
}

$row = mysqli_fetch_assoc($result);
$user_end_time = strtotime($row["user_time"]);

// echo $user_end_time;

// calculate the time duration in seconds (same as before)
$current_timestamp = time();

// echo $current_timestamp;


// echo date("Y-m-d H:i:s", $current_timestamp);
// echo $user_end_time;
// echo $current_timestamp;

$duration = ($user_end_time - $current_timestamp)/60;

// echo $duration;
 
 
  

// compare the time duration with the total duration of tasks
if ($duration < $total_minutes) {
    
	$response = array(
		"status" => "error",
		"message" => "There is overhead in time.Please shift some task for tomorrow"
	);
} else {
	$response = array(
		"status" => "success",
		"message" => "There is no overhead in time."
	);
    
}

// return the response as JSON

echo json_encode($response);


?>
