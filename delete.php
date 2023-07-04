<?php 
 include 'authenticate.php';
?>

<?php 

 $id = $_GET['ID'];

 $i = mysqli_query($conn, "DELETE FROM `xyz` WHERE t_id = $id");

//  if($i){
//     echo "work";
//  }else{
//     echo "no";
//  }

 header("location:i2.php");

?>
