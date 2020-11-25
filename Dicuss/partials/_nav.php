<?php
session_start();

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="iDiscuss.php">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="iDiscuss.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#category" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact us</a>
                </li>
            </ul>';
            
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                   echo '<form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    <p class = "text-white mx-3 mt-3">Welome, '.$_SESSION['username'].'</p> </form>
                    <button class="btn btn-outline-success my-2 my-sm-0 text-decoration-none" type="submit"><a href="partials/logout.php" > Logout</a> </button>
        </div>
    </nav>';
                
                }else{
                echo '<form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
                <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#signupModal">Signup</button>
            </form>
        </div>
    </nav>';
}
    include '_login.php';
    include '_signup.php';
   
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']==true){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulation!</strong> Your account have been created successfully.Now you can login 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    
    if(isset($_GET['signupnotsuccess']) && $_GET['signupnotsuccess']==false){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Your account have been not created successfully.Something went wrong please try again later. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if(isset($_GET['signupsucess']) && $_GET['signupsucess']==true){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorrry!</strong> Your must type the same password in confirm password. Please try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }

   
?>