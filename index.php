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
  <!--                              nav bar                 -->
  <?php include 'partials/_dbconnect.php'; ?>
  <?php include 'partials/_nav.php'; ?>

  <!-- slider start -->
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://picsum.photos/id/180/1600/600" class="d-block w-100"  alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/id/20/1600/600"   class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/id/5/1600/600"   class="d-block w-100" alt="...">
     
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- end of slider  -->




  <!-- category container start -->

  <div class="container my-3"  style="min-height: 490px;">
    <h2 class="text-center my-3 text-danger">iForums- Browse Categories</h2>
    <div class="row">
      <!-- fetch all the categories  -->
       <?php 
          $sql = "SELECT * FROM `categories`"; 
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
          //  echo $row['category_id'];
          //  echo $row['category_name'];
          $id = $row['category_id'];
          $cat = $row['category_name'];
          $desc = $row['category_descriptions'];
          
          echo ' <div class="col-md-4 my-3">
           <div class="card " style="width: 18rem;">
             <img src="https://sphero.com/cdn/shop/articles/coding_languages_1000x.png?v=1619126283" class="card-img-top" alt="...">
             <div class="card-body">
               <h5 class="card-title"><a class="link-underline-light text-danger" href="threadlist.php?catid=' . $id .' ">' . $cat .'</a> </h5>

               <p class="card-text">' . substr($desc, 0 ,146) .  '....'  . '</p>
               <a href="threadlist.php?catid=' . $id .' " class="btn btn-danger">View Threads</a>
             </div>
           </div>
         </div> ';
          
          
          
          
          }
       ?>

      
     



    </div>
  </div>


  <footer  >
    <?php include 'partials/_footer.php'; ?>
  </footer>










  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

</body>

</html>