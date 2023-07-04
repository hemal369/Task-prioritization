<?php 
 include 'authenticate.php';
?>

<?php 

$u_id = $_SESSION['user_id'];

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
  $sql2 = "SELECT importance, urgency, effort FROM  mytable WHERE userid=$u_id";
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

  // Sort the tasks by value in descending order

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
<!DOCTYPE html>
<html>
<head>
  <title>Prioritized List</title>
</head>
<body>
  <!-- <h1>Final Prioritized List</h1>
  <table>
    <thead>
      <tr>
        <th>Task</th>
        <th>Importance</th>
        <th>Urgency</th>
        <th>Effort</th>
        <th>WSJF</th>
        <th>Category</th>
      </tr>
    </thead>
    <tbody>
      
       
      </tbody>
  </table> -->
      <?php  

for($i=0;$i<count($tasks);$i++) {
  $taskk= $tasks[$i]['Task'];
  $value=$tasks[$i]['Value'];
  $urg = $tasks[$i]['Urgency'];
  $size = $tasks[$i]['Size'];
  $wsjff = $tasks[$i]['WSJF'];
  $category= $tasks[$i]['Category'];
  $mins= $tasks[$i]['Minutes'];

   

  $insertQuery = "INSERT INTO prior (userid,title, value, urgency, effort, wsjf, category, minutes) VALUES ('$u_id', '$taskk', '$value', '$urg', '$size', '$wsjff', '$category', '$mins')";

          $j = mysqli_query($conn, $insertQuery);

          if($j){
            header("location:timer.php");
          }else{
            echo "bc";
          }
      }
         ?>
   
</body>
</html>
