<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>iDiscuss!</title>
    <style>
        #footer {
            min-height: 400px;
        }
    </style>
</head>

<body>
    <?php include "partials/_nav.php"; ?>
    <?php include "partials/_dbconnect.php" ?>
    <?php
    $threadsid = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $threadsid";
    $resul = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($resul)) {
        $threadid = $row['thread_id'];
        $threadtitle = $row['thread_title'];
        $threadDescription = $row['thread_desc'];
    }
    ?>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $currentuser = $_SESSION['username'];
        $queryemailid = "SELECT * FROM users WHERE user_email = '$currentuser'";
        $insertemailid = mysqli_query($conn, $queryemailid);
        $rowemailid = mysqli_fetch_assoc($insertemailid);
        $emailid = $rowemailid['sno'];
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $comment = $_POST['comments'];
            $query = "INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_time`, `user_id`) VALUES (NULL, '$comment', '$threadsid', current_timestamp(), '$emailid');";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Comment has been posted</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                    </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Comment has been posted</strong> Something went wrong!!!!!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
        </div>';
            }
        }
    }


    ?>
    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $threadtitle; ?></h1>
            <p class="lead"><?php echo $threadDescription; ?></p>
            <hr class="my-4">
            <p> <b>RULES OF FORUM.</b>
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.
            </p>
            <p class="lead">
                <h3 class="text-right"><b>Posted by : Bhupesh</b></h3>
            </p>
        </div>
    </div>
    <div class="container">
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<h1 class="py-3">Post a comment</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . ' " .$id method="POST">""
            <div class="form-group">
                <p class="lead">Comment</p>                
                <p>Type a comment</p>
                <textarea class="form-control" id="describe" name="comments" placeholder="Please be polite and dont use offesive word" rows="3" cols=130%></textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Post</button>
        </form>';
        } else {
            echo '<p class="lead">You must login to post comment.Please kindly login</p>';
        }
        ?>
        <h1 class="py-3">Post a comment</h1>
        <?php

        $sql = "SELECT * FROM `comments` WHERE thread_id = $threadid";
        $resul = mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($resul)) {
            $noresult = false;
            $commentDescription = $row['comment_content'];
            $userid = $row['user_id'];
            $date = $row['comment_time'];
            $sqlemail = "SELECT user_email FROM users WHERE sno = '$userid'";
            $emailquery = mysqli_query($conn, $sqlemail);
            $emailrow = mysqli_fetch_assoc($emailquery);
            $email = $emailrow['user_email'];
            
            echo '
            <div class="media mb-3">
                <img class="mr-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdagfNlkCXKS54rDkgY6CjGNtPECsI_SZlKQ&usqp=CAU" width="54px" alt="Generic placeholder image">
                <div class="media-body">
                <p class="font-weight-bold my-0">'.$email.' at ' . $date . '</p>
                ' . $commentDescription . '
                </div>
            </div>';
        }
        if ($noresult) {
            echo '
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><b>No comment yet!!!!!!!!</b></h1>
                <p class="lead">Be first person to comment</p>
        </div>
    </div>
    ';
        }
        ?>
    </div>




    <!-- footer start from here -->
    <?php include "partials/_footer.php";  ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>