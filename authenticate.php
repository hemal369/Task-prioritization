<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'fyp';

$conn = mysqli_connect($servername,$username,$password,$database) or die(mysqli_error());
session_start();
?>