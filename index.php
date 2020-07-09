<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
  <title>Oaks Cafe Deli</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Custom fonts for this template -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <!-- <link href="css/grayscale.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="styles.css"/>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Oaks Café Deli</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#menu">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead" id="home">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <img id="logo" class="logo img-fluid" src="resources/header.png" alt="Oaks Cafe Deli">
        <!-- <h2 class="text-white-50 mx-auto mt-2 mb-5">A free, responsive, one page Bootstrap theme created by Start Bootstrap.</h2> -->
        <!-- <a href="#about" class="btn btn-primary js-scroll-trigger">Welcome!</a> -->
      </div>
    </div>
  </header>

  <!-- About Section -->
  <section id="about" class="about-section text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-white mb-4">About</h2>
          <p class="text-white">Welcome to <strong>Oaks Cafe Deli</strong> that is owned and run by Alain and Debbie and based in Swanley Kent.</p>
          <p class="text-white">We pride ourselves on serving freshly cooked quality produce and offer a friendly homely environment.</p>
          <p class="text-white">We offer traditional favourites ranging from a Full English Breakfast to Sausage Baguette, Scampi and Chips to Eggs Royale, as well as freshly made Salads, Sandwiches, Paninis and Baguettes.</p>
          <p class="text-white">We also have a range of gifts to sell together with Marmalades, Jams, Chutneys, Free Range Eggs, Biscuits, Cakes and Infused Olive Oils.</p>
          <p class="text-white">We can also cater for buffets / functions / business meetings, with delivery to business premises in the local area.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Menu Section -->
  <section id="menu" class="menu-section text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-black mb-4">Menu</h2>
          <p class="text-black-50">Our menu below lists our traditional dishes; we frequently post special offers and seasonal produce on our social media.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="nav-menu-section text-center" role="group" aria-label="Menu">
            <button type="button" id="selector-food" class="btn btn-secondary menuCategoryButton">Cafe Menu</button>
            <button type="button" id="selector-drinks" class="btn btn-secondary menuCategoryButton">Drinks</button>
            <button type="button" id="selector-takeaway" class="btn btn-secondary menuCategoryButton">Takeaway / Delivery Menu</button>
          </div>
          
          <div id="menu-content">
              <?php
                $host_name = 'db5000153551.hosting-data.io';
                $database = 'dbs148622';
                $user_name = 'dbu150596';
                $password = '7jdlh46vYtjmApLuRWT0!';
                $connect = mysqli_connect($host_name, $user_name, $password, $database);
                if (!mysqli_connect_errno()) {
                  // Connection successful
                  // Food
                  echo "<div id='food' class='menuCategory visible'>";
                  $sql = "SELECT `ID` FROM `Menu` WHERE `ItemType` = 'Food'";
                  $result = mysqli_query($connect, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    // Breakfast
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Food' AND `ItemSubType` = 'Breakfast'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Breakfast</h4>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                        
                      }
                      echo "</ul>";
                    }
                    // Lunch
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Food' AND `ItemSubType` = 'Lunch'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Lunch</h4>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                      }
                      echo "</ul>";
                    }
                    // Extras
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Food' AND `ItemSubType` = 'Extras'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Extras</h4>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                      }
                      echo "</ul>";
                    }
                    
                    // Toasted Sandwiches, Baguettes and Paninis
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Food' AND `ItemSubType` = 'Paninis'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Toasted Sandwiches, Baguettes and Paninis</h4>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                      }
                      echo "</ul>";
                    }
                  } else {
                    echo "<p class='center'>For more information, please <a href='tel:+441322666655'>call us</a>!</p>";
                  }					
                  echo "</div>";
                  // Drinks
                  echo "<div id='drinks' class='menuCategory hidden'>";
                  $sql = "SELECT `ID` FROM `Menu` WHERE `ItemType` = 'Drinks'";
                  $result = mysqli_query($connect, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    // Drinks
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Drinks' AND `ItemSubType` = 'Drinks'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Hot and Cold Drinks</h4>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                      }
                      echo "</ul>";
                    }
                  } else {
                    echo "<p class='center'>For more information, please <a href='tel:+441322666655'>call us</a>!</p>";
                  }					
                  echo "</div>";
  
                  // Takeaway
                  echo "<div id='takeaway' class='menuCategory hidden'>";
                  $sql = "SELECT `ID` FROM `Menu` WHERE `ItemType` = 'Takeaway'";
                  $result = mysqli_query($connect, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    // Takeaway - Breakfast
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Takeaway' AND `ItemSubType` = 'Breakfast'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Breakfast</h4>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                      }
                      echo "</ul>";
                    }
                    // Lunch
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Takeaway' AND `ItemSubType` = 'Lunch'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Lunch</h4>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                      }
                      echo "</ul>";
                    }
                    // Toasted Sandwiches, Baguettes and Paninis
                    $sql = "SELECT `ID`, `ItemName`, `ItemType`, `ItemDescription`, `ItemPrice` FROM `Menu` WHERE `ItemType` = 'Takeaway' AND `ItemSubType` = 'Paninis'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      echo "<h4>Toasted Sandwiches, Baguettes and Paninis</h4>";
                      echo "<p class='center'>Prices are for toasted sandwiches; +£0.65 extra for paninis.</p>";
                      echo "<ul>";
                      while($row = mysqli_fetch_assoc($result)) {
                        $price = number_format($row["ItemPrice"], 2, '.', '');
                        // if ($price>0)
                        // {
                        //   echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. " | <strong>£" .$price. "</strong></p></li>";
                        // } else {
                          echo "<li><h5>" .$row["ItemName"]. "</h5><p>" .$row["ItemDescription"]. "</p></li>";
                        // }
                      }
                      echo "</ul>";
                    }
                  } else {
                    echo "<p class='center'>For more information, please <a href='tel:+441322666655'>call us</a>!</p>";
                  }					
                  echo "</div>";
                }
                mysqli_close($connect);
              ?>
              </div>
            </div>

        </div>
      </div>
    </div>
  </section>
  
  <!-- Gallery Section -->
  <section id="gallery" class="gallery-section text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-white mb-4">Gallery</h2>
          <!-- Carousel -->
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <!-- Carousel content -->
              <?php
                $files = array_diff(scandir('resources/uploads/'), array('..', '.'));
                $fileIndex = 0;
								foreach($files as $file) {
									if ($fileIndex > 0) {
										echo "<div class='carousel-item img-thumbnail img-fluid'>";
										echo "<img src='resources/uploads/" .$file. "' class='d-block w-100'/>";
										echo "</div>";
									} else {
										echo "<div class='carousel-item img-thumbnail img-fluid active'>";
										echo "<img src='resources/uploads/" .$file. "' class='d-block w-100'/>";
										echo "</div>";
									}
									$fileIndex++;
								}
              ?>
              <!-- End of carousel content -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <!-- End of carousel -->
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact-section text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-black mb-4">Contact</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <h4 class="m-0">Address</h4>
              <hr class="my-4">
              <div class="medium">
                <p>7 Manse Parade, London Road</p>
                <p>Swanley, BR8 8DA</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <h4 class="m-0">Socials</h4>
              <hr class="my-4">
              <div class="medium">
                <a href="https://facebook.com/OaksCafeDeli" class="fab fa-facebook"></a>
                <a href="https://twitter.com/OaksCafeDeli" class="fab fa-twitter"></a>
                <a href="https://www.instagram.com/oakscafedeliswanley" class="fab fa-instagram"></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <h4 class="m-0">Phone</h4>
              <hr class="my-4">
              <div class="medium">
                <a href='tel:+441322666655'>+44 1322 666 655</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="small text-center">
    <div class="container">
      Copyright &copy; Oaks Café Deli
      <?php
        echo " " . date("Y") . " ";
      ?>
      | Michael Robert Thurlow
    </div>
  </footer>

  <!-- Scripts -->
  <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="js/grayscale.js"></script>

</body>

</html>
