<?php
$login_sucess = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
include '_dbconnect.php';
$email = $_POST['email'];
$pass = $_POST['password'];
$login = "SELECT * FROM users WHERE user_email = '$email'";
$result = mysqli_query($conn, $login);
  $num = mysqli_num_rows($result);
if($num == 1){
    $row = mysqli_fetch_assoc($result);
    $login_email = $row['user_email'];
    $login_pass = $row['user_password'];
    if($email == $login_email && $pass == password_verify($pass,$login_pass)){
        echo 'welcome';
        $login_sucess = true;
    }
}    
else{
    echo "It seem you haven't signup yet";
}
   

if($login_sucess){
    echo 'welcome';
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $email;
    header('location: /php/Dicuss/iDiscuss.php');
}
else{
    echo 'access denied';
    header('location: /php/Dicuss/iDiscuss.php?login=false');

}

}

?>