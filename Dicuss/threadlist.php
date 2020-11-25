<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>iDiscuss!</title>

</head>

<body>
    <?php include "partials/_nav.php"; ?>
    <?php include "partials/_dbconnect.php" ?>
    <?php
    $catid = $_GET['cateid'];
    $sql = "SELECT * FROM `categories` WHERE category_id =$catid";
    $resul = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($resul)) {
        $cateName = $row['category_name'];
        $cateDescription = $row['category_description'];
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
            $title = $_POST['questiontitle'];
            $describe = $_POST['describe'];
            $query = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cate_id`, `thread_user_id`, `timestamp`) VALUES (NULL, '$title', '$describe', '$catid', '$emailid', current_timestamp());";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Question has been added</strong> Please wait community to respond your post
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                               </button>
                            </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sorry comment did not added</strong> Something went wrong!!!!!!!
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
            <h1 class="display-4">Welcome to <?php echo $cateName; ?></h1>
            <p class="lead"><?php echo $cateDescription; ?></p>
            <hr class="my-4">
            <p> <b>RULES OF FORUM.</b></p>
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums.</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not post “offensive” posts, links or images.</li>
                <li>Do not cross post questions.</li>
                <li>Do not PM users asking for help.</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <div class="container">

        <?php

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '
         <h1 class="py-3"><b>Ask a question</b></h1>
            <h1 class="py-3">Post</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . '" .$catid method="POST">
        <div class="form-group">
            <label for="Comment">Question title</label>
            <input type="text" class="form-control" name=" questiontitle" id="comment" aria-describedby="commnet" placeholder="Enter the Question title">
        </div>
        <div class="form-group">
            <label for="describe">Description</labe>
                <textarea class="form-control" id="describe" name="describe" placeholder="Please elaborate your query in detail and keep it short and sweet" rows="3" cols=130%></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Add question</button>
    </form>';
        } else {
            echo '<p class="lead">You must login to ask the Question.Please kindly login</p>';
        }
        ?>
        <h1 class="py-3"><b>Browse question</b></h1>

        <?php
        $catid = $_GET['cateid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cate_id = $catid";
        $resul = mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($resul)) {
            $noresult = false;
            $threadid = $row['thread_id'];
            $threaduserid = $row['thread_user_id'];
            $threadName = $row['thread_title'];
            $threadDescription = $row['thread_desc'];
            $threaddate = $row['timestamp'];
            $sqlemail = "SELECT user_email FROM users WHERE sno = '$threaduserid'";
            $emailquery = mysqli_query($conn, $sqlemail);
            $emailrow = mysqli_fetch_assoc($emailquery);
            $email = $emailrow['user_email'];
            echo '
             <div class="media mb-3">
            <img class="mr-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdagfNlkCXKS54rDkgY6CjGNtPECsI_SZlKQ&usqp=CAU" width="54px" alt="Generic placeholder image">
            <div class="media-body">
            <p class="font-weight-bold my-0">' . $email . ' at ' . $threaddate . '</p>
                <h5 class="mt-0"><a href="thread.php?threadid=' . $threadid . '">' . $threadName . '</a></h5>
                ' . $threadDescription . '
            </div>
        </div>';
        }
        if ($noresult) {
            echo '
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4"><b>No result found!!!!!!!!</b></h1>
                        <p class="lead">Be first person to ask question</p>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>