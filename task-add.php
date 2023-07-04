<?php 
 include 'authenticate.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Task Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Styles for the help menu */
    .help-menu {
      position: fixed;
      top: 10px;
      left: 10px;
      padding: 10px;
      background-color: #f9f9f9;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      z-index: 999;
    }

    /* Styles for the form */
    .task-form {
      width: 400px;
      margin: 70px auto 0;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .button{
            position: fixed;
            bottom:0;
            right:0;
            padding:10px;
            margin:10px
        }
    
    .dtask{
        border-radius: 5px;
        display: flex;
        align-items: stretch;
        justify-content: space-between;
        border:1px solid black;
        background-color: #fff;
        height: 50px;
        padding: 5px;
    }

    .container{
        display: flex;
        justify-content: center;
        align-content: center;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #444;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Styles for the task list */
    .task-list {
      width: 400px;
      margin: 20px auto 0;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .task-item {
      margin-bottom: 10px;
      padding: 10px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      color: #444;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .task-item span {
      font-weight: bold;
    }

    .delete-button {
      padding: 5px 10px;
      background-color: #f44336;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    h2 {
      color: #444;
      text-align: center;
    }

    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }
  </style>
</head>
<body>

<?php 

 if(isset($_POST['submit'])){

  $name = mysqli_real_escape_string($conn, $_POST['tname']);
  $imp = mysqli_real_escape_string($conn, $_POST['imp']);
  $urgency = mysqli_real_escape_string($conn, $_POST['urgency']);
  $effort = mysqli_real_escape_string($conn, $_POST['effort']);
  $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
  $tag_name = mysqli_real_escape_string($conn, $_POST['tag-name']);
   
  $insertQuery = "insert into xyz(title,importance,urgency,effort,deadline,tag_name) values ('$name','$imp','$urgency','$effort','$deadline','$tag_name' ) ";
  
  $iquery = mysqli_query($conn,$insertQuery);

  if($iquery){
    echo "worked";
  }else{
    echo "invalid";
  }
   
 }

?>
    <nav class="flex justify-content-center align-items-center navbar bg-body-tertiary">
        <h1>Smart to do Notes</h1>
    </nav>
  <div class="help-menu">
    <a href="#">Help</a>
  </div>
<section class="container">
  <div class="task-form">
    <h2>Add Task</h2>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="task-form">
      <div class="form-group">
        <label for="task-name">Task Name</label>
        <input type="text" name="tname" id="task-name" required>
      </div>
       <form action="">
        <label for="task-name">Importance</label>
        <div class="select form-group">
            <select name="imp" class="filter-todo">
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
        <div class="select form-group">
            <select name="urgency" class="filter-todo">
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
        <div class="select form-group">
            <select name="effort" class="filter-todo">
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
       <label for="task-name">DEAD LINE</label>
        <div class="select form-group">
            <input type="date" name="deadline">
       </div>
       <label for="task-name">Tag</label>
        <div class="select form-group">
            <select name="tag-name" class="filter-todo">
            <option value="" disabled selected hidden>1-10</option>
            <option value="work">Work</option>
            <option value="office">Office</option>
            <option value="personel">Personel</option>
            <option value="school">school</option>
           </select>
       </div>
      <button type="submit" name="submit" onclick="displayTask()">Add Task</button>
    </form>
  </div>

  <div class="task-list task__container">
    <h2>Task List</h2>
    <ul id="task-list"></ul>
  
</div>

</section>
<section class="button">
   <a href="index.php"><button type="button" class="btn btn-primary">Next</button></a> 
</section>

   

<!--<script>
    document.getElementById('task-form').addEventListener('submit', function(e) {
      e.preventDefault();

      var taskName = document.getElementById('task-name').value;
      var taskPriority = document.getElementById('task-priority').value;

      if (taskName && taskPriority) {
        var taskItem = document.createElement('li');
        taskItem.classList.add('task-item');
        taskItem.innerHTML = '<span>' + taskName + '</span> - Priority: ' + taskPriority;
        document.getElementById('task-list').appendChild(taskItem);

        document.getElementById('task-name').value = '';
        document.getElementById('task-priority').value = '';
      }
    });
  </script>-->
  <script>
    const taskContainer =document.querySelector(".task__container");;
        const generateNewTask = (taskData) =>  `
            <div class="form-group dtask">
            <p>${taskData.taskName}<p>
            <i class="fa-solid fa-x"></i>
            </div>
            `;


const displayTask = () => {
    const taskData = {
        taskName: document.getElementById("task-name").value
    }
    taskContainer.insertAdjacentHTML("beforeend" ,generateNewTask(taskData));
}

  </script>
</body>
</html>
