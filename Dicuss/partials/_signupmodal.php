<?php
    $exitsuser = false;
    $method = $_SERVER["REQUEST_METHOD"];
    if($method=="POST"){
        echo 'post';
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        if($pass == $cpass){
            $encrypt_pass = password_hash($pass, PASSWORD_DEFAULT);
            include '_dbconnect.php';
            //checking if the user email alreay exist or not
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                $check_user = $row['user_email'];
                if($email==$check_user){
                    $exitsuser = true;
                }
            }
            if($exitsuser){
                header('location: /php/Dicuss/iDiscuss.php?useralredyexits=true');

            }
            else{
                $insert="INSERT INTO `users` (`sno`, `user_email`, `user_password`, `created_user_datetime`) VALUES (NULL, '$email', '$encrypt_pass', current_timestamp());";
                $insert_result = mysqli_query($conn, $insert);
                if($insert_result){
                    echo 'account have been created';
                    header('location: /php/Dicuss/iDiscuss.php?signupsuccess=true');
                }
                else{
                    echo 'something went wrong please try again later';
                    header('location: /php/Dicuss/iDiscuss.php?signupnotsuccess=true');

                }
            }
        }
        else{
            $eror='password wrong in cpassword';
            header('location: /php/Dicuss/iDiscuss.php?signupsucess=false');

        }
    }
  
?>