<?php 
 include 'authenticate.php';
?>
<?php 

$u_id = $_SESSION['user_id'];

// global $u_id;

?>

<?php 

// $sql_random = "SELECT title, importance, urgency, effort, minutes FROM xyz WHERE userid=$u_id";
// $sql_random2 = $conn->query($sql_random);
// $sql_random3 = mysqli_fetch_assoc($sql_random2);

// $x = $sql_random3['importance'];
// $y = $sql_random3['urgency'];
// $z = $sql_random3['effort'];

// global $x;
// global $y;
// global $;

?>


<?php
// Retrieve tasks from the database
$sql = "SELECT title, importance, urgency, effort, minutes FROM xyz WHERE userid=$u_id";
$result = $conn->query($sql);




// Create a tasks array
$tasks = array();
while($row = $result->fetch_assoc()) {
  $task = array(
    'Task' => $row['title'],
    'Value' => $row['importance'],
    'Urgency' => $row['urgency'],
    'Size' => $row['effort'],
    'Minutes' => $row['minutes']
  );
  array_push($tasks, $task);
  
}



// Define the WSJF function
function wsjf($value, $urgency, $effort) {

   global $conn;
   $u_id = $_SESSION['user_id'];
  $sql2 = "SELECT importance, urgency, effort FROM mytable WHERE userid=$u_id";
$sql3 = $conn->query($sql2);
$sql3 = mysqli_fetch_assoc($sql3);

$value_weight = $sql3['importance'];
$urgency_weight = $sql3['urgency'];
$effort_weight = $sql3['effort'];

  $value_score = $value * $value_weight;
  $urgency_score = $urgency * $urgency_weight;
  $effort_score = $effort * $effort_weight;

  return $value_score + $urgency_score + $effort_score;
}

// Calculate the WSJF score for each task
foreach ($tasks as &$task) {
  $task['WSJF'] = wsjf($task['Value'], $task['Urgency'], $task['Size']);
}


// Perform ABC analysis on the tasks
function abc_analysis($tasks) {
  global $conn;
  global $u_id;
  // Sort the tasks by value in descending order
  $sql2 = "SELECT importance, urgency, effort FROM mytable WHERE userid=$u_id";
  $sql3 = $conn->query($sql2);
  $sql3 = mysqli_fetch_assoc($sql3);
  
  $value_weight = $sql3['importance'];
  $urgency_weight = $sql3['urgency'];
  $effort_weight = $sql3['effort'];
 
  if($value_weight==0.5){
    usort($tasks, function ($a, $b) {
      return $b['Value'] - $a['Value'];
    });
  
   
  
   
  
    // Calculate the cumulative percentage of tasks by value
    $cumulative_value = 0;
    foreach ($tasks as &$task) {
      $cumulative_value += $task['Value'];
      $task['Cumulative % Value'] = ($cumulative_value / array_reduce($tasks, function ($carry, $task) {
        return $carry + $task['Value'];
      }, 0)) * 100;
    }
  
   
    // Categorize tasks into A, B, and C based on cumulative percentage of value
    $category_labels = array('A', 'B', 'C');
    $category_bins = array( 80, 95, 100);
    foreach ($tasks as &$task) {
      $task['Category'] = $category_labels[array_search(true, array_map(function ($bin) use ($task) {
        return $task['Cumulative % Value'] <= $bin;
      }, $category_bins))];
    }
  
   
   
  
    // Sort tasks within each category by WSJF score in descending order
    // Sort tasks within each category by WSJF score in descending order
    usort($tasks, function ($a, $b) {
      if ($a['Category'] !== $b['Category']) {
        return strcmp($a['Category'], $b['Category']);
      } else {
        if ($b['WSJF'] !== $a['WSJF']) {
          return $b['WSJF'] - $a['WSJF'];
        } else {
          return strcmp($a['Task'], $b['Task']);
        }
      }
    });
  
    return $tasks;
    
  }

  if($urgency_weight==0.5){
    usort($tasks, function ($a, $b) {
      return $b['Urgency'] - $a['Urgency'];
    });
  
   
  
   
  
    // Calculate the cumulative percentage of tasks by value
    $cumulative_value = 0;
    foreach ($tasks as &$task) {
      $cumulative_value += $task['Urgency'];
      $task['Cumulative % Urgency'] = ($cumulative_value / array_reduce($tasks, function ($carry, $task) {
        return $carry + $task['Urgency'];
      }, 0)) * 100;
    }
  
   
    // Categorize tasks into A, B, and C based on cumulative percentage of value
    $category_labels = array('A', 'B', 'C');
    $category_bins = array( 80, 95, 100);
    foreach ($tasks as &$task) {
      $task['Category'] = $category_labels[array_search(true, array_map(function ($bin) use ($task) {
        return $task['Cumulative % Urgency'] <= $bin;
      }, $category_bins))];
    }
  
   
   
  
    // Sort tasks within each category by WSJF score in descending order
    // Sort tasks within each category by WSJF score in descending order
    usort($tasks, function ($a, $b) {
      if ($a['Category'] !== $b['Category']) {
        return strcmp($a['Category'], $b['Category']);
      } else {
        if ($b['WSJF'] !== $a['WSJF']) {
          return $b['WSJF'] - $a['WSJF'];
        } else {
          return strcmp($a['Task'], $b['Task']);
        }
      }
    });
  
    return $tasks;
  }

  if($effort_weight==0.5){
    usort($tasks, function ($a, $b) {
      return $b['Size'] - $a['Size'];
    });
  
   
  
   
  
    // Calculate the cumulative percentage of tasks by value
    $cumulative_value = 0;
    foreach ($tasks as &$task) {
      $cumulative_value += $task['Size'];
      $task['Cumulative % Size'] = ($cumulative_value / array_reduce($tasks, function ($carry, $task) {
        return $carry + $task['Size'];
      }, 0)) * 100;
    }
  
   
    // Categorize tasks into A, B, and C based on cumulative percentage of value
    $category_labels = array('A', 'B', 'C');
    $category_bins = array( 80, 95, 100);
    foreach ($tasks as &$task) {
      $task['Category'] = $category_labels[array_search(true, array_map(function ($bin) use ($task) {
        return $task['Cumulative % Size'] <= $bin;
      }, $category_bins))];
    }
  
   
   
  
    // Sort tasks within each category by WSJF score in descending order
    // Sort tasks within each category by WSJF score in descending order
    usort($tasks, function ($a, $b) {
      if ($a['Category'] !== $b['Category']) {
        return strcmp($a['Category'], $b['Category']);
      } else {
        if ($b['WSJF'] !== $a['WSJF']) {
          return $b['WSJF'] - $a['WSJF'];
        } else {
          return strcmp($a['Task'], $b['Task']);
        }
      }
    });
  
    return $tasks;
  }
   
}



// Perform ABC analysis on the tasks
$tasks = abc_analysis($tasks);

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="./css/task_list.css">
    <script src="last.js"></script>
    <title>Document1</title>
</head>

<body>
    
    <header>
        <center><h1>Priority Pro</h1></center>
    </header>
    

    
	<div class="first_heading">
    <center>
        <br>
        <br>
    <h2>Our algorithm has prioritized your
        <br><h1>TASKS</h1>
    </h2>
    </center>
    
    </div>
        <div class="sticky-note-container">
        <div class="sticky-note purple">
	
    <ul class="task-list">
        <?php 
           for($i=0;$i<count($tasks);$i++) {
            ?>
            <li><?php echo $tasks[$i]['Task']; ?></li>
            <?php
           }
        ?>
         
      </ul>
     
    </div>
    </div>
    
    <footer>
        <a href="abc.php"><button class="bottom-right-button" style="font-family: 'Playfair Display', serif;">START</button></a>
     </footer>
	
</body>
</html>
