<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>iForums</title>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@200&family=Gulzar&family=Nunito:wght@200&family=Poppins:ital,wght@0,200;0,300;0,400;0,600;0,700;1,100&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body >
    <!--                              nav bar                 -->
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav2.php'; ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_descriptions'];
    }



    ?>

    <?php
        $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       if($method== 'POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 
        $sno = $_POST['sno'];
       
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> Your thread has been added! Please wait community to respond
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          ';}
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Cannot add your thread!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      ';  
                    }
       }
       
    ?>

    <div class="container my-4">

        <div class="jumbotron text-white wc1 p-4 ">
            <h1 class="display-4  text-center"><strong>Welcome to <em> <?php echo $catname ?></em> forums</strong></h1>
            <h3><p class="lead"><?php echo $catdesc ?></p></h3>
            <hr class="my-4">
            <p><small>This is a peer to peer forum for sharing knowledge with each other.Please treat this discussion forum with the same respect you would a public park.
                Improve the Discussion.
                Be Agreeable, Even When You Disagree.
                Always Be Civil.
                Keep It Tidy.</small>
            </p>

        </div>
    </div>

    <!-- collapse -->
  <?php  
       if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
   echo' <p class="text-center">
  <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
  <h2 class="py-2 text-success text-center">Click to Start Discussion</h2>
  </button>
</p>
<div>
  <div class="collapse collapse-horizontal" id="collapseWidthExample">
    <div class="card card-body" >

    <div class="container my-3">
   
   <form action="'.$_SERVER['REQUEST_URI'].'"  method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Keep your title as crisp and short as possible</div>
            </div>
            <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
            <div class="form-group">
                <label for="desc">Ellaborate your problem</label>
                <textarea class="form-control" placeholder="Leave a comment here" name="desc" id="desc" style="height: 100px" required></textarea>
            </div>

            <button type="submit" class="btn btn-danger my-3">Submit</button>
        </form>
   </div>
    </div>
  </div>
</div>';}
else{
   echo'<h2 class="py-2 text-success text-center">Login to Start Discussion</h2>';
}

?>


    <!-- end of collapse -->
   

    <div class="container "  style="min-height: 490px;">
        <h3 class="py-2 text-dark text-center">Browse Questions</h3>

        <?php
        
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $id = $row['thread_id'];
            $time = $row['timestamp'];
            $uid = $row['thread_user_id'];
            $sql2 = "SELECT username FROM `users` WHERE sno =  '$uid' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $datetime = new DateTime($time);
            $formatted_date = $datetime->format('F j, Y, g:i a');
        
            

               echo '<div class="media d-flex my-3">
                <img class="mr-3 img " src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" height="54px" alt="Generic placeholder image">
                <div class="media-body">
                <p class="fw-bold text-danger fs-5 my-0">Asked by: '. $row2['username'] .'<p class="fs-6 text-primary">  ('. $formatted_date .')</p></p>
                    <h5 class="mt-2"> <a class="link-underline-light text-dark" href = "thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                    ' . $desc . '
                </div>
            </div> ';}
         
        if ($noResult) {
            echo '<div class="jumbotron text-white  wc2 p-4 ">
            <div class="container">
              <p class="display-5 text-center text-white">! No <strong>Threads</strong> Found !</p>
              <p class="lead text-center">Be the 1st person to ask a question</p>
            </div>
          </div>';
        }
    

        ?>
        




    </div>







    <footer  >
        <?php include 'partials/_footer.php'; ?>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

</body>

</html>