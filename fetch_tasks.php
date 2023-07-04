<?php 
 include 'authenticate.php';
?>


<?php 

$u_id = $_SESSION['user_id'];

?>

<?php
 
// Fetch task data from the database
$sql = "SELECT title,minutes FROM prior WHERE userid=$u_id";
$result = $conn->query($sql);

$tasks = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tasks[] = array(
            'name' => $row['title'],
            'duration' => $row['minutes']
        );
    }
}

$delete_all = "DELETE FROM prior WHERE userid=$u_id";
$result_delete_all = $conn->query($delete_all);
// Close the database connection
$conn->close();

// Return the task data as JSON
echo json_encode($tasks);
?>
