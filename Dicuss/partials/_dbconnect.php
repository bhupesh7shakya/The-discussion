<?php
$servername="localhost"; 
$serverusername = "root";
$serverpassword = "";
$dbname = "idiscuss";
// $conn = mysqli_connect($servername,$username,$password);
$conn = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
if(!$conn){
    // echo 'Could not connect to db' . mysqli_error($conn);
}
else{
    // echo 'connectd';
}
?>