<?php 
 include 'authenticate.php';
?>
 
<?php 

$id = $_GET['ID'];

$query = "select * from xyz where t_id='$id'"; 
$row = mysqli_query($conn ,$query);  
$row = mysqli_fetch_assoc($row);
$row2 = $row;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style2.css">
</head>

 
<body>
<?php 


if (isset($_POST['submit'])) {

    // $id = $_POST['id'];

    if($_POST['hours']==0 && $_POST['minutes']==0){
        ?>
        <script>
            alert("nono");
        </script>
        <?php
    }else{

        
    $total_time= ($_POST['hours']*60)+$_POST['minutes'];
    
    $sql = "UPDATE xyz SET title='" . $_POST['tname'] . "', importance='" . $_POST['imp'] . "', urgency='" . $_POST['urgency'] . "', effort='" . $_POST['effort'] . "', minutes='" . $total_time . "', tag_name='" . $_POST['tag-name'] . "'  WHERE t_id='$id'";
    $insert = mysqli_query($conn, $sql); 


    if ($insert) {
    
    ?>
    
    <script>
        alert("insertion successful");
    </script>
    <?php
        header("location: i2.php");
    
        // echo "<script>window.location.href='profile.php';</script>";
    
    } else {
    
        ?>
        <script>
            alert("insertion failed");
        </script>
        // echo "Error updating record: " . mysqli_error($conn);
        <?php
    
    }

    }

    
    }
    
    
?>
    

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
                    
                    
        
                    <form action="" method="POST">
        
                    <div class="input-section gap-2">
                        <input type="text" value="<?php echo $row2['title']; ?>" name="tname" placeholder="Add a task . . ." class="input input-bordered input-secondary w-full max-w-xs" />
                    </div>
                        <label for="task-name">Importance</label>
                        <div class="input-section gap-2">
                            <select  name="imp" value="" class="input input-bordered input-secondary" style="width: 448.4px;">
                            <option selected hidden><?php echo $row2['Importance']; ?></option>
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
                            <select name="urgency" class="input input-bordered input-secondary" style="width: 448.4px;">
                            <option selected hidden><?php echo $row2['urgency']; ?></option>
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
                                <select name="effort" class="input input-bordered input-secondary" style="width: 448.4px;">
                                <option selected hidden><?php echo $row2['effort']; ?></option>
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
                            <div class="input-section col-12 mt-5">
                                  <div>
                                        <label for="task-name">Hh</label>
                                        <input type="number" name="hours" min="0" max="24" placeholder="Add Hours . . ." class="input input-bordered input-secondary w-full max-w-xs" style="width: 150px;" />
                                  </div>
                                  <div>
                                        <label for="task-name">Mm</label>
                                        <input type="number" name="minutes" min="0" max="59" placeholder="Add Minutes . . ." class="input input-bordered input-secondary w-full max-w-xs" style="width: 150px;" />
                                  </div>
                        
                        
                            </div>
                            <label for="task-name">Tag</label>
                            <div class="input-section gap-2">
                                <select name="tag-name" class="input input-bordered input-secondary" style="width: 448.4px;">
                                <option selected hidden><?php echo $row2['tag_name']; ?></option>
                                <option value="work">Work</option>
                                <option value="office">Office</option>
                                <option value="personel">Personel</option>
                                <option value="school">school</option>
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
        
                    <button type="submit" name="submit" value="update" type class="btn btn-secondary delete-all-btn">
                    submit
                    </button>
                    <!-- <button class="btn btn-secondary add-task-button" type="submit" value="sjdhshd" name="submit">
                        <i class="bx bx-plus bx-sm"></i>
                    </button> -->
                </div>
            </div>
            </form>
                 
        </div>
        
        
            <!--Theme switcher-->
             
            <!-- JS -->
            <!-- <script src="js/main.js"></script> -->
            <script src="js/theme_switcher.js"></script>
        </section>

</body>
</html>


