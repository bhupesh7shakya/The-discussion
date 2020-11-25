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



    <!-- slider start from here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://source.unsplash.com/2400x800/?coding,programming,hacking,python,code,tech" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://source.unsplash.com/2400x800/?coding,programming,hacking,java,microsoft,tesla" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://source.unsplash.com/2400x800/?coding,programming,hacking,php,js,security,fullstack,hacker" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- category start form here -->
    <!-- it shows the category by looping all of them -->
    <h1 class="mt-3 text-center">Welcome to iDiscuss:- Category</h1>

    <div class="container  d-flex justify-content-center" id="category">
        <br>
        <div class="row mt-4 ">
            <?php
            $sql = "SELECT * FROM `categories`";
            $resul = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($resul)) {
                $id = $row['category_id'];
                $cateName = $row['category_name'];
                $cateDescription = $row['category_description'];
                echo '  <div class="col-md-4 mb-4 ">
                <div class="card" style="width: 21rem;">
                    <img class="card-img-top" src="https://source.unsplash.com/500x400/?coding,'.$cateName.'" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?cateid='.$id.'">'.$cateName.'</h5>
                        <p class="card-text">'.substr($cateDescription,0,90).'</p>
                        <a href="threadlist.php?cateid='.$id.'" class="btn btn-primary mt-3">View threads</a>
                    </div>
                </div>
            </div> ';
            }

            ?>
           
        </div>
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