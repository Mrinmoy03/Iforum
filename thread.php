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

<body>
  <?php include 'partials/_dbconnect.php'; ?>
<?php include 'partials/_nav2.php'; ?>

<?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id;"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
         $title = $row['thread_title'];
         $desc = $row['thread_desc'];
         $uid = $row['thread_user_id'];
            $sql2 = "SELECT username FROM `users` WHERE sno =  '$uid' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

    }

    ?>

<?php
        $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       if($method== 'POST'){
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment); 
        $sno = $_POST['sno'];
      
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> Your comment has been added! 
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
 
 <div class="container my-3">
 <div class="jumbotron text-white  wc1 p-4">
  <h1 class="display-4 text-center "><strong><?php echo $title; ?></strong></h1>
 <h3> <p class="lead text-center"><?php echo $desc; ?></p></h3>
  <hr class="my-4">
  <p><small>This is a peer to peer forum for sharing knowledge with each other.Please treat this discussion forum with the same respect you would a public park.
Improve the Discussion.
Be Agreeable, Even When You Disagree.
Always Be Civil.
Keep It Tidy.</small></p>
  <p >
   Posted by: <strong class="text-white fs-5"><em><?php echo $row2['username']; ?></em></strong>
  </p>
</div>
</div>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
  echo'
<div class="container my-3"  >
<h2 class="py-2 text-dark">Post a Comment</h2>
  

   
   <form action="'.$_SERVER['REQUEST_URI'].'"  method="post">
            
            <div class="form-group">
                <label for="desc">Type your Comment </label>
                <textarea class="form-control my-2" placeholder="Leave a comment here" name="comment" id="comment" style="height: 100px" required></textarea>
                <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
            </div>

            <button type="submit" class="btn btn-danger my-3">Post Comment</button>
        </form>
   </div>';}else{
    echo'<h2 class="py-2 text-success text-center">Login to post Comment</h2>';
 }


   ?>






<div class="container"  style="min-height: 490px;">
<h3 class="py-2 text-dark text-center">Discuss</h3>


<?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $time = $row['comment_time'];
            $uid = $row['comment_by'];
            $sql2 = "SELECT * FROM `users` WHERE sno='$uid'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $datetime = new DateTime($time);
            $formatted_date = $datetime->format('F j, Y, g:i a');




            echo '<div class="media d-flex my-3">
                <img class="mr-3 " src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" height="54px" alt="Generic placeholder image">
                <div class="media-body p-2">
                 <p class="fw-bold text-danger fs-5 my-0">Commented by: '. $row2['username'] .'<p class="fs-6 text-primary">  ('.$formatted_date  .')</p></p>
                         '.$content.'
                </div>
            </div> ';
        }
        if ($noResult) {
            echo '<div class="jumbotron text-white  wc2 p-4 ">
  <div class="container">
    <p class="display-4 text-center text-white">! No <strong>Comments</strong> Found !</p>
    <p class="lead text-center">Be the 1st person to comment</p>
  </div>
</div>';
        }


        ?>



</div>




 









<footer >
    <?php include 'partials/_footer.php'; ?>
  </footer>










  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

</body>

</html>