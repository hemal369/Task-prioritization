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
    <!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="./css/last.css">
     
    <title>Document1</title>
</head>

<body>

<?php 

if(isset($_POST['submit']) && isset($_POST["deleteId"])){

    foreach($_POST["deleteId"] as $deleteId){
        $delete = "DELETE FROM xyz WHERE t_id = $deleteId";
        $delete_all = "DELETE FROM prior WHERE userid=$u_id";
        $delete_all_time = "DELETE FROM mytable WHERE userid=$u_id";

        $query3 = mysqli_query($conn,$delete_all_time);

        $query2 = mysqli_query($conn,$delete_all);

        $query = mysqli_query($conn,$delete);

        if($query && $query2 && $query3){

            session_destroy();

            header("location:login.php");
        }else{
            echo "failed";
        }
    }
}


?>
    
    <header>
        <center><h1>Priority Pro</h1></center>
    </header>
    

    
	<center><h1 style="margin-top:150px  ;">TASKS</h1></center>
    <center>
        <br>
        <br>
    <h2>Tick mark all the tasks that you were able to complete.
        <br>Don't worry the remaining tasks will be shifted to the next time you visit us!
    </h2>
    </center>
    <form method="POST">
        <div class="sticky-note-container">
        <div class="sticky-note purple">
	<ul>
    <?php 
        
        $res = mysqli_query($conn , "select * from xyz where userid=$u_id");
        
        while ($row = mysqli_fetch_assoc($res)) {
         ?> 
		<li class="task">
			<input type="checkbox" name="deleteId[]" value="<?php echo $row['t_id'] ?>" onchange="handleCheckbox(this)">
			<span class="note-heading"> <?php echo $row['title'] ?></span>
		</li>
		 <?php 
        }

         ?>
	</ul>
    </div>
    </div>
    
    <footer>
        <button class="bottom-right-button" type="submit" name="submit" style="font-family: 'Playfair Display', serif;">END</button>
     </footer>

     </form>

     <script>
        function handleCheckbox(checkbox) {
    const task = checkbox.parentElement;
    if (checkbox.checked) {
        task.classList.add('completed');
    } else {
        task.classList.remove('completed');
    }
}
     </script>
	
</body>
</html>
