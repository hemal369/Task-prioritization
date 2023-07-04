<?php 
 include 'authenticate.php';
?>

<?php 

$u_id = 43;

?>

<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/i333.css">

    <!--- Tailwind CSS & Daisy UI CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.18.0/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  
    <!-- Favicon -->
    <link rel="icon" href="res/favicon.svg">
    <title>Todo List</title>

     
</head>
<body>


<?php 

 if(isset($_POST['submit'])){

  $name = mysqli_real_escape_string($conn, $_POST['tname']);
  $imp = mysqli_real_escape_string($conn, $_POST['imp']);
  $urgency = mysqli_real_escape_string($conn, $_POST['urgency']);
  $effort = mysqli_real_escape_string($conn, $_POST['effort']);
//   $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
  $hours = mysqli_real_escape_string($conn, $_POST['hours']);
  $minutes = mysqli_real_escape_string($conn, $_POST['minutes']);

if($hours==0 && $minutes==0){
    ?>

    <script>
        alert("Either hours or minutes must be non-zero.");
    </script>
    <?php
}else{
      

    
  $hours_minutes = (($hours*60)+$minutes);

  //   $total_time = ($hours*60)+$minutes;
    $tag_name = mysqli_real_escape_string($conn, $_POST['tag-name']);
     
    $insertQuery = "insert into xyz(userid,title,importance,urgency,effort,minutes,tag_name) values ('$u_id','$name','$imp','$urgency','$effort','$hours_minutes','$tag_name' ) ";
    
    $iquery = mysqli_query($conn,$insertQuery);
  
    if($iquery){
      echo "worked";
    }else{
      echo "invalid";
    }
     
   }
  
}

?>
    <section>
        <nav class="navbar">
            <div>
                <h1 class="font-bold text-5xl">Priority Pro</h1>
            </div>
        </nav>
    </section>
<section class="tempBody">
<div class="parent-container">   
    <div class="container" style="width: 400px;">
        <header>
            <h1>Add Task</h1>
            <!-- Error message -->
            <div class="alert-message">

            </div>

            <div>
                <label for="task-name">Task Name</label>
              </div>
            
            

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="input-section gap-2">
                <input type="text" name="tname" placeholder="Add a task . . ." class="input input-bordered input-secondary w-full max-w-xs" required />
            </div>
                <label for="task-name">Importance</label>
                <div class="input-section gap-2">
                    <select name="imp" class="input input-bordered input-secondary" style="width: 448.4px;" required title="Hover over me to see information">
                    <option value="" disabled selected hidden>1-10</option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                   </select>
                </div>
                <label for="task-name">Urgency</label>
                <div class="input-section gap-2">
                    <select name="urgency" class="input input-bordered input-secondary" style="width: 448.4px;" required>
                    <option value="" disabled selected hidden>1-10</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                </div>
                <label for="task-name">Effort</label>
                    <div class="input-section gap-2">
                        <select name="effort" class="input input-bordered input-secondary" style="width: 448.4px;" required>
                        <option value="" disabled selected hidden>1-10</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    </div>
                    
                    
                    <div class="input-section col-12 mt-5">
                        <div>
                            <label for="task-name">Hh</label>
                            <input type="number" name="hours" min="0" max="24" name="deadline" placeholder="Add Hours . . ." class="hours input input-bordered input-secondary w-full max-w-xs" style="width: 150px;" required/>
                        </div>
                        <div>
                            <label for="task-name">Mm</label>
                            <input type="number" name="minutes" min="0" max="59" name="deadline" placeholder="Add Minutes . . ." class="minutes input input-bordered input-secondary w-full max-w-xs" style="width: 150px;" required/>
                        </div>
                        
                        
                    </div>
                    <label for="task-name">Tag</label>
                    <div class="input-section gap-2">
                        <select name="tag-name" class="input input-bordered input-secondary" style="width: 448.4px;" required>
                        <option value="" disabled selected hidden></option>
                        <option value="work">Work</option>
                        <option value="office">Office</option>
                        <option value="personel">Personal</option>
                        <option value="school">school</option>
                        <option value="other">Others...</option>
                    </select>
                    </div>
            
        </header>

        <div class="todos-filter">
            <!-- <div class="dropdown">
                <label tabindex="0" class="btn m-1">Filter</label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>All</a></li>
                    <li><a>Pending</a></li>
                    <li><a>Completed</a></li>
                </ul>
            </div> -->

            <input type="reset" value="clear" class="btn btn-secondary delete-all-btn">
            
            </input>
            <button class="btn btn-secondary add-task-button" type="submit" name="submit">
                <i class="bx bx-plus bx-sm"></i>
            </button>
        </div>
    </div>
    </form>
        <div class="container" style="width: 400px;">
            <header>
            <h1>Task List</h1>
            <!-- Error message -->
            <div class="alert-message">`

            </div>
        <ul class="todos-list">

        <?php 
        
        $res = mysqli_query($conn , "select * from xyz where userid=$u_id");
        
        while ($row = mysqli_fetch_assoc($res)) {
         ?> 
         
         
            <li class="todo-item" data-id="${todo.id}">
                <div style="max-width: 200px;">
                <p class="task-body">
                <?php echo $row['title'] ?>
                </p>
            </div>
                 <p class="task-body ml-5">
                      Minutes:<?php echo $row['minutes'] ?>
                 </p>

                <div class="todo-actions">
                    <a href="update.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-success" onclick="editTodo('${todo.id}')">
                        <i class="bx bx-edit-alt bx-sm"></i>    
                    </button></a>
                    <a href="delete.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-error" onclick="deleteTodo('${todo.id}')">
                        <i class="bx bx-trash bx-sm"></i>
                    </button></a>
                </div>
            </li>
            <li class="todo-item todo-content" data-id="${todo.id}">
                <div style="max-width: 200px;">
                <p class="task-body">
                <!--<?php echo $row['title'] ?>-->task3
                </p>
            </div>
                 <p class="task-body ml-5">
                      Minutes:<!--<?php echo $row['minutes'] ?>-->25
                 </p>

                <div class="todo-actions">
                    <a href="update.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-success" onclick="editTodo('${todo.id}')">
                        <i class="bx bx-edit-alt bx-sm"></i>    
                    </button></a>
                    <a href="delete.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-error" onclick="deleteTodo('${todo.id}')">
                        <i class="bx bx-trash bx-sm"></i>
                    </button></a>
                </div>
            </li>
            <li class="todo-item todo-content" data-id="${todo.id}">
                <div style="max-width: 200px;">
                <p class="task-body">
                <!--<?php echo $row['title'] ?>-->football2
                </p>
            </div>
                 <p class="task-body ml-5">
                      Minutes:<!--<?php echo $row['minutes'] ?>-->25
                 </p>

                <div class="todo-actions">
                    <a href="update.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-success" onclick="editTodo('${todo.id}')">
                        <i class="bx bx-edit-alt bx-sm"></i>    
                    </button></a>
                    <a href="delete.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-error" onclick="deleteTodo('${todo.id}')">
                        <i class="bx bx-trash bx-sm"></i>
                    </button></a>
                </div>
            </li>
            <li class="todo-item todo-content" data-id="${todo.id}">
                <div style="max-width: 200vh;">
                <p class="task-body">
                <!--<?php echo $row['title'] ?>-->football255555555555555555555
                </p>
            </div>
                
                 <p class="task-body ml-5">
                      Minutes:<!--<?php echo $row['minutes'] ?>-->25
                 </p>

                <div class="todo-actions">
                    <a href="update.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-success" onclick="editTodo('${todo.id}')">
                        <i class="bx bx-edit-alt bx-sm"></i>    
                    </button></a>
                    <a href="delete.php? ID=<?php echo $row['t_id'] ?>"><button class="btn btn-error" onclick="deleteTodo('${todo.id}')">
                        <i class="bx bx-trash bx-sm"></i>
                    </button></a>
                </div>
            </li>
            <?php 
        }
        ?>
        
        </ul>
    </header>
    <button id="proceed-btn" class="btn btn-outline-success">Proceed >></button>
    </div>
    
</div>

<div class="help-button rounded">
    <button class="rounded-full ..." onclick="showAlert()">Help</button>
</div>


    <!--Theme switcher-->
    <div class="theme-switcher">
        <div class="dropdown dropdown-left">
            <label tabindex="0" class="btn m-1">
                <i class='bx bxs-palette bx-sm'></i>
            </label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                <li class="theme-item" theme="cupcake"><a>cupcake</a></li>
                <li class="theme-item" theme="fantasy"><a>fantasy</a></li>
                <li class="theme-item" theme="bumblebee"><a>bumblebee</a></li>
                <li class="theme-item" theme="halloween"><a>halloween</a></li>
                <li class="theme-item" theme="luxury"><a>luxury</a></li>
            </ul>
        </div>
    </div>

    
    <!-- JS -->
    <!-- <script src="js/main.js"></script> -->
    <script src="js/theme_switcher.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
		$(document).ready(function() {
			$("#proceed-btn").click(function() {
				$.ajax({
					url: "time-cal.php",
					type: "POST",
					dataType: "json",
					success: function(response) {
                        if (response.status === "success") {
                    window.location.href = "notes1.php"; // Replace "newpage.php" with the desired URL of the new webpage
                      } else {
                    alert(response.message);
                   }
					},
					error: function() {
						alert("Error");
					}
				});
			});
		});
	</script>
    <script>
        function showAlert() {
          alert("Importance:- Importance range 1-10 denotes 1 being the least important task for you and 10 being the most important task.\n Effort:- Effort range 1-10 where 1 represents the least amount of effort required to complete the task, while the number 10 represents the most amount of effort required.\n Urgency:- Urgency range 1-10 represents 1 is the task with the farthest deadline, and the task with the earliest deadline is represented by 10.");
        }
      </script>
 

 <!-- <script>
    
  function validateForm() {
    const hours = parseInt(document.getElementsByClass('hours')[0].value);
    const minutes = parseInt(document.getElementsByClass('minutes')[0].value);
    
    if (hours === 0 && minutes === 0) {
      alert('Either hours or minutes must be non-zero.');
      return false;
    }
    
    return true;
  }

  document.querySelector('form').addEventListener('submit', validateForm);

 </script> -->

     
    
</section>
</body>
</html>