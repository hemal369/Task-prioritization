<?php 
 include 'authenticate.php';
?>


<?php 

$u_id = $_SESSION['user_id'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart to do Notes</title>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <script src="https://kit.fontawesome.com/6f3103b13c.js" crossorigin="anonymous"></script>

    <!--BOOTSTRAP CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        :root {
    font-size: 62.5%; /* 1rem = 10px */

    --color-primary: hsl(235, 35%, 19%);
    --color-secondary: hsl(358, 78%, 69%);
    --color-font: hsla(0, 0%, 100%, 0.902);

    --color-shadow: hsl(235, 36%, 35%);
}

html, body {
    height: 100%;
    background-color: var(--color-primary);
    font-size: 1.6rem;
    font-family: 'Open sans', sans-serif;
}

p,
i,
h1 {
    color: var(--color-font);
}

i {
    font-size: 3.2rem;
}

h1 {
    font-size: 3.2rem;
}

/* ==== CONTENT ==== */

section {
    display: flex;
    align-items: center;
    height: 100%;
}

.container {
    width: min(42.5rem, 100%);
    margin-inline: auto;
    padding-inline: 2rem;
    display: flex;
    justify-content: start;
    align-items: center;
    flex-direction: column;
}

.timer {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30rem;
    height: 30rem;
    border-radius: 50%;
    -webkit-box-shadow: 0px 0px 15px 10px var(--color-shadow); 
    box-shadow: 0px 0px 15px 10px var(--color-shadow);
}

.circle {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 26rem;
    height: 26rem;
    border-radius: 50%;
    background-color: var(--color-secondary);
    position: relative;
}

.circle::before {
    content: '';
    position: absolute;
    width: 95%;
    height: 95%;
    border-radius: 50%;
    background-color: var(--color-primary);
}

.time {
    position: relative;
    display: flex;
    flex-direction: row;
}

.time p {
    font-size: 5.6rem;
}

.time p:nth-of-type(2) {
    position: relative;
    top: -.5rem;
    margin-inline: 1rem;
}

.controls {
    margin-top: 3rem;
}

.controls button {
    border: none;
    background-color: transparent;
    cursor: pointer;
}
    
    </style>


</head>
<body>

<?php 

// $query = "SELECT hours,minutes FROM xyz WHERE id = 58"; // replace 1 with the actual user ID
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);

// $total_time = ($row['hours']*60) + $row['minutes'];

 

?>

    <nav class="flex justify-content-center align-items-center navbar bg-body-tertiary" >
        <h1 style="color:black;font-weight:bold;">Priority Pro</h1>
    </nav>
    <section>
        <div class="container">
            <div class="timer">
                <div class="circle">
                    <div class="time" id="timer">
                        <p id="minutes">0</p>
                        <p>:</p>
                        <p id="seconds" >00</p>
                         
                        
                    </div>  
                </div>
            </div>

            <div class="controls">
                
                <button id="start-btn" class="btn" onclick="start()"><i class="fa-solid fa-play"></i></button>
                <button id="pause-btn" class="btn" onclick="pause()"><i class="fa-solid fa-pause"></i></button>
                <button id="resume-btn" class="btn" onclick="resume()"><i class="fa-solid fa-arrow-rotate-left"></i></button>
            </div>
            <div>

                <?php   
                
                     // Fetch task data from the database
                       $iquery = "SELECT * FROM prior WHERE userid=$u_id";
                       $row = mysqli_query($conn ,$iquery);  


                        


                
                ?>
                <table class="table table-bordered border-danger" style="width: 64rem; margin-top: 3rem;">
                    <!--<thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>-->
                    </thead>
                    <tbody style="color: red;">
                    <?php 
                    $i = -1;
                    while ($row2 = mysqli_fetch_assoc($row)) {
                        $i++;
                        ?> 
                      <tr>

 77                       <td id="T<?php echo $i; ?>"><?php echo $row2['title'] ?></td>
                        <td id="t<?php echo $i; ?>"><?php echo $row2['minutes'] ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                      
                      
                    </tbody>
                  </table>

                  
            </div>
            <a href="Last.php"><button class="btn btn-outline-light btn-lg">Exit</button></a>
        </div>
    </section>

    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>

$(document).ready(function() {
            $.ajax({
                url: 'fetch_tasks.php',
                dataType: 'json',
                success: function(data) {
                    // Task data retrieved successfully
                    startTimer(data);
                },
                error: function() {
                    // Error occurred while fetching task data
                    console.log('Failed to fetch task data.');
                }
            });
        });

        

        // variables
        let timerInterval;
// let remainingTime = document.getElementById('minutes').innerHTML;
const minutesLabel = document.getElementById('minutes');
const secondsLabel = document.getElementById('seconds');
let currentTaskIndex = -1;
let isTimerRunning = false;
let i = -1;
let tasksData;

function startTimer(tasks) {
    

    currentTaskIndex++;
    document.querySelector('#start-btn').disabled = true;
  remainingTime = tasks[currentTaskIndex].duration * 60;// set the timer to 25 minutes
//   let timerInterval = null;
     
   tasksData=tasks;
   timerInterval = setInterval(function() {
    updateTimer(tasksData);
   },1000); 
  
}

function updateTimer(tasks) {
  
  if (remainingTime <= 0) {
    

    i++;
    
    document.getElementById('T' + i).style.textDecoration = 'line-through';
    console.log('T' + i);
    document.getElementById('t' + i).style.textDecoration = 'line-through';
    document.getElementById('t' + i).innerHTML = 0;
    console.log('t' + i);
    
    clearInterval(timerInterval);

    if(currentTaskIndex < tasks.length-1){
       let countdown=30;
       const countdownInterval =setInterval(function(){
        document.getElementById('minutes').innerHTML ='Break';
        document.getElementById('seconds').innerHTML =countdown < 10 ? '0' + countdown : countdown;
        countdown--;

        if(countdown<0){
            clearInterval(countdownInterval);
            startTimer(tasks);
        }
       }, 1000);
    }else{
        windows.location.href= "Last.php";
    }
    
    
    
  }else{
    const minutes = Math.floor(remainingTime / 60);
  const seconds = remainingTime % 60;
  
  minutesLabel.innerHTML = minutes < 10 ? '0' + minutes : minutes;
  secondsLabel.innerHTML = seconds < 10 ? '0' + seconds : seconds;
  remainingTime--;
  }
  
}


function resume() {
  timerInterval = setInterval(function() {
    updateTimer(tasksData);
  }, 1000);
}  


function pause() {
  clearInterval(timerInterval);
}

    </script>
    
</body>
</html>