<?php
session_start();


echo '
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand mt-1 " href="/phpt/project/online%20Forum/">iForum </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item ">
            <a class="nav-link active mt-2 " href="/phpt/project/online%20Forum/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  mt-2 " href="https://mrinmoy03.github.io/portfolio/">Contact</a>
          </li>
          <li class="nav-item dropdown mt-2 ">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top 5 Categories
          </a>
          <ul class="dropdown-menu">';
          $sql= "SELECT category_name, category_id FROM `categories` LIMIT 5" ;
          $result = mysqli_query($conn, $sql);
       
        while ($row = mysqli_fetch_assoc($result)) {

         echo'
            <li><a class= "text-danger   link-underline-light" href="/phpt/project/online%20Forum/threadlist.php?catid='.$row['category_id'].'" ><button class="dropdown-item  btn btn-light-emphasis text-danger"> '. $row['category_name'] .'</button></a></li>';
            }
            
       echo '</ul>
        </li>';
         

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
        echo ' <li class="nav-item"> <button type="button" class="btn nav-link  mt-2  my-0" data-bs-toggle="modal" data-bs-target="#categoryModal">
         
        Create Category 
        </button>
        </li>
        
        </ul> ';
        }else{
          echo '<li class="nav-item invisible"> <button type="button" class="btn nav-link invisible my-0" >
         
          
          </button>
          </li>
          
          </ul>  ';
          
        }
        
        
        
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
        
       

     echo'  <form method="get" action="search.php" class="d-flex" role="search">
            <input class="form-control me-2 mt-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-danger mx-2 mt-2"  type="submit">Search</button>
          </form>
            <p class= "text-light fs-5 mt-3"> <strong class = "text-warning">' .$_SESSION['username'] . '</strong></p>
          
          <button class="btn btn-success mx-2 mt-2"><a class= "text-white link-underline-success" href="logout.php">Log Out</a></button>
        ';
       }else{
        echo' <form method="get" action="search.php" class="d-flex" role="search">
            <input class="form-control me-2 mt-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-danger mt-2 mx-2"  type="submit">Search</button>
          </form>
          
          <button class="btn btn-danger ml-3 mt-2 "><a class= "text-white link-underline-danger" href="logIn.php">Login</a></button>
        <button class="btn btn-danger mx-2 mt-2"><a class= "text-white link-underline-danger" href="signup.php">SignUp</a></button>';
       }
       
     
         
          
        
        
    
    
        echo' </div>
    
  </div>
</nav>  ';



?>
<?php include 'partials/_createcategory.php'; ?>
<?php include 'partials/_dbconnect.php'; ?>

<?php
        $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       if($method== 'POST'){
        $c_title = $_POST['ctitle'];
        $c_desc = $_POST['cdesc'];
        $sql = "INSERT INTO `categories` (`category_name`, `category_descriptions`, `created`) VALUES ( '$c_title', '$c_desc', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
          echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!!</strong> You have created a new Category! now start a new thread
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          ';}
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Cannot add the Category
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      ';  
                    }
       }
       
    ?>




