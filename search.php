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

<body class="bg">
  <!--                              nav bar                 -->
  <?php include 'partials/_dbconnect.php'; ?>
  <?php include 'partials/_nav2.php'; ?>
  <div class="container my-3" style="min-height: 100vh;">
  <h1 class="py-2 text-center">Search result for <strong> <em class="text-danger">"<?php echo $_GET['search'] ?>"</em></strong> </h1>


  <?php 
        $noresults = true;
        $query = $_GET["search"];
        $sql = "select * from threads where match (thread_title, thread_desc) against ('$query')"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc']; 
            $thread_id= $row['thread_id'];
            $url = "http://localhost/phpt/project/online%20Forum/thread.php?threadid=". $thread_id;
            $noresults = false;
            echo' <div class="result mt-5">
          <h3>Click to see the <a class="text-success link-underline-light"  href="'.$url.'">'.$title.'</a> </h3> 
          <p></p> 
    </div>';}
    if ($noresults){
        echo '<div class="jumbotron jumbotron-fluid p-4 wc2 text-white mt-5">
                <div class="container">
                    <p class="display-4 text-white text-center">No Results Found</p>
                    <p class="lead text-white"> Suggestions: <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords. </li></ul>
                    </p>
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