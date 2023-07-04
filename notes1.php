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
    <link rel="stylesheet" href="./css/notes1.css">
    <script src="notes.js"></script>
    <title>Document</title>
</head>
<body>
     <header>
      <center><h1>Priority Pro</h1></center>
    </header>
    <br>
      <div class="sticky-note-container">

      <?php 
      
      $query = "SELECT * FROM xyz WHERE tag_name='school' AND userid=$u_id";
      $row = mysqli_query($conn, $query);

      
?>
      <div class="sticky-note blue" style = "margin-left:150px ;">
        <h2 class="note-heading">SCHOOL</h2>
        <div class="note-text" >
            <ul>
            <?php
               if(mysqli_num_rows($row) > 0){
                while ($roww = mysqli_fetch_assoc($row)) {
                  ?>
                    <li style="text-align:left;margin-left:5px;"></li><?php echo $roww['title'] ?></li>
                    
                    <?php
              } 
            }else{
               ?>
               <div style="display:flex;justify-content:center;align-items:center;">
                  <h3 style="text-align:center;margin-right:40px;margin-top:35px;">No Items available in this section</h3>
               </div>
               <?php
            }
                         
            ?>
            </ul>
        </div>
      </div>

      <?php 
      
      $query = "SELECT * FROM xyz WHERE tag_name='office' AND userid=$u_id";
      $row = mysqli_query($conn, $query);

?>
      <div class="sticky-note pink" >
        <h2 class="note-heading">OFFICE</h2>
        <div class="note-text" >
        <ul>
            <?php
            if(mysqli_num_rows($row) > 0){
              while ($roww = mysqli_fetch_assoc($row)) {
              ?>
                <li style="text-align:left;margin-left:5px;"><?php echo $roww['title'] ?></li>
                
                <?php
                        }
                      }else{
                        ?>
                          <div style="display:flex;justify-content:center;align-items:center;">
                             <h3 style="text-align:center;margin-right:40px;margin-top:35px;">No Items available in this section</h3>
                          </div>
                        <?php

                      }

                        ?>
            </ul>
        </div>
      </div>

      <?php 
      
      $query = "SELECT * FROM xyz WHERE tag_name='personal' AND userid=$u_id";
      $row = mysqli_query($conn, $query);

      
?>
      <div class="sticky-note green" >
        <h2 class="note-heading">PERSONAL</h2>
        <div class="note-text">
        <ul>
            <?php
            if(mysqli_num_rows($row) > 0){
              while ($roww = mysqli_fetch_assoc($row)) {
              ?>
                <li style="text-align:left;margin-left:5px;"><?php echo $roww['title'] ?></li>
                
                <?php
                        }
                      }else{
                        ?>
                          <div style="display:flex;justify-content:center;align-items:center;">
                             <h3 style="text-align:center;margin-right:40px;margin-top:35px;">No Items available in this section</h3>
                          </div>
                          <?php
                      }

                        ?>
            </ul>
        </div>
      </div>
      <br>
      
      <?php 
      
      $query = "SELECT * FROM xyz WHERE tag_name='work' AND userid=$u_id";
      $row = mysqli_query($conn, $query);

      
?>
      <div class="sticky-note purple" style = "margin-left:300px ;">
        <h2 class="note-heading">WORK</h2>
        <div class="note-text" >
        <ul>
            <?php
            if(mysqli_num_rows($row) > 0){
              while ($roww = mysqli_fetch_assoc($row)) {
              ?>
                <li style="text-align:left;margin-left:5px;"><?php echo $roww['title'] ?></li>
                
                <?php
                        }
                      }else{
                        ?>
                          <div style="display:flex;justify-content:center;align-items:center;">
                             <h3 style="text-align:center;margin-right:40px;margin-top:35px;">No Items available in this section</h3>
                          </div>
                          <?php
                      }

                        ?>
            </ul>
        </div>
      </div>

      <?php 
      
              $query = "SELECT * FROM xyz WHERE tag_name='other' AND userid=$u_id";
              $row = mysqli_query($conn, $query);

              
      ?>
      <div class="sticky-note yellow">
        <h2 class="note-heading">OTHER</h2>
        <div class="note-text">
        <ul>
            <?php
               if(mysqli_num_rows($row) > 0){
                while ($roww = mysqli_fetch_assoc($row)) {
                  ?>
                    <li style="text-align:left;margin-left:5px;"><?php echo $roww['title'] ?></li>
                    
                    <?php
              }
            }else{
              ?>
                          <div style="display:flex;justify-content:center;align-items:center;">
                             <h3 style="text-align:center;margin-right:40px;margin-top:35px;">No Items available in this section</h3>
                          </div>
                          <?php
            } 
              
                        ?>
            </ul>
        </div>
      </div>
      </div>
     <footer>
        <a href="task_list.php"><button class="bottom-right-button">Prioritize Tasks</button></a>
     </footer>
      
      
      
</body>
</html>