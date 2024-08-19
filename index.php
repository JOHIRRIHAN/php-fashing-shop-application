<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display data from the database
$sql = "SELECT id, title, paragraph, image FROM your_table ORDER BY created_at DESC";
$result = $conn->query($sql);

$cards = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $edit_delete_links = '';
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            $edit_delete_links = '<a href="update.php?id=' . $row["id"] . '">Edit</a> | 
                                  <a href="delete.php?id=' . $row["id"] . '">Delete</a>';
        }
        
        $cards .= '<div class="content-item">
                        <img src="uploads/' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '" style="width: 300px;">
                        <div class="content-body">
                            <h3 class="content-title">' . htmlspecialchars($row["title"]) . '</h3>
                            <p class="content-paragraph">' . htmlspecialchars($row["paragraph"]) . '</p>
                            ' . $edit_delete_links . '
                        </div>
                    </div>';
    }
} else {
    echo "No records found.";
}

$conn->close();
?>







<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fashion Landing page</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- box icon link -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- swiper js cdn  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


  </head>
  <body>

    <header>
        <!-- navbar  -->
        <nav class="navbar navbar-expand-lg  p-3">
            <div class="container-fluid">
              <a class="navbar-brand" href="#"><img src="./assets/image/logo.svg" alt="logo"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                  <li class="nav-item">
                    <a class="nav-link mx-2 active" aria-current="page" href="#">CATALOGUE</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2" href="#">FASHION</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2" href="create.php">CREATE</a>
                  </li>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-2" href="#">LIFESTYLE</a>
                  </li>
                  </li>
                  <li class="nav-item">
                        <button type="button" class="btn btn-dark px-4"><a href="register.php">Register</a></button>

                  </li>
                  <li class="nav-item">
                        <button type="button" class="btn btn-dark px-4"><a href="signup.php">Sign in</a></button>

                  </li>

                </ul>
              </div>
            </div>
        </nav>
    </header>
    <main>
        <!-- hero  -->
        <div class="container container1 py-5">
            <div class="row mb-4 align-items-center flex-lg-row-reverse">
                <div class="col-md-6 col-xl-7 mb-4 mb-lg-0 " >
                    <div class="lc-block position-relative ">
                        <img src="./assets/image/hero-girl.png" alt="hero-girl" class="hero-img">
                    </div>
                </div>
                <div class="col-md-6 col-xl-5">
                    <div class="mb-3">
                        <div editable="rich">
                            <h1 class="fw-bolder display-2"><span class="bg-white px-4">LET’S</span>
                                EXPLORE
                                <span class="bg-warning px-4">UNIQUE</span>
                                CLOTHES.</h1>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div editable="rich">

                            <p class="lead">Live for Influential and Innovative fashion!.</p>

                        </div>
                    </div>
                    <div class="">
                      <a class="btn btn-dark btn-lg" href="#" role="button">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="handm-container container-mt">
            <div class="about-images">
                <img src="./assets/image/Rectangle_36-removebg-preview.png" alt="img-rectangle">
                <img src="./assets/image/Rectangle_44-removebg-preview.png" alt="img-rectangle">
                <img src="./assets/image/Rectangle 38_prev_ui.png" alt="img-rectangle">
                <img src="./assets/image/Rectangle 41_prev_ui.png" alt="img-rectangle">
                <img src="./assets/image/Rectangle 43_prev_ui.png" alt="img-rectangle">
                <img src="./assets/image/Rectangle 45_prev_ui.png" alt="img-rectangle">
            </div>
        </section>



       
        <section class="collection">
          <div class="swiper mySwiper">
              <div class="favarite-title ">
                  <h3 class="fs-1">New Arrivals</h3>
              </div>
              <div class="">
      
               
              <div class="swiper-wrapper gap-5">
              <?php echo $cards; ?>
              </div>
                
      
                  <!-- Add more slides as needed -->
      
              </div>
          </div>
      </section>

           <!-- PAYDAY  -->
           <section class=" payday-bg-color my-2">
            <div class="row container py-5 align-items-center">
              <div class="col-lg-5 col-md-6 col-sm-12 mb-4 mb-md-0">
                <div class="lc-block ratio ratio-1x1">
                  <img class="img-fluid" src="./assets/image/image-12.png" alt="Photo by Atikh Bana">
                </div>
              </div>
              <div class="col-lg-5 offset-lg-1 col-md-6 col-sm-12 text-center text-md-start">
                <div class="lc-block my-5">
                  <div editable="rich">
                    <h2 class="rfs-25 fs-1 fw-bold text-black fw-bolder">
                      <span class="bg-white  px-2">PAYDAY</span><br>
                      SALE NOW
                    </h2>
                  </div>
                </div>
                <div class="lc-block my-5">
                  <div editable="rich" class="text-black">
                    <p>Spend minimal $100 get 30% off
                      voucher code for your next purchase</p>
                    <h5 class="fw-bold">1 June - 10 June 2021</h5>
                    <p>*Terms & Conditions apply</p>
                  </div>
                </div>
                <div class="lc-block">
                  <a class="btn btn-dark btn-lg" href="#" role="button">Shop Now</a>
                </div>
              </div>
            </div>
          </section>
        
          <!-- youngs favorite -->
           <section class="mx-5">
            <div class="favarite-title my-5">
              <h3 class="fs-1">Young’s Favorite</h3>
            </div>
            <div class="d-block d-lg-flex gap-2">
              <div class="card border-0" >
                <img src="./assets/image/Rectangle 49.png" alt="">
                <div class="d-flex justify-content-between my-5 mx-lg-5">
                  <div class="">
                    <h3>Trending on instagram</h3>
                    <p>Explore Now!</p>
                  </div>
                  <p class="fs-1"><i class='bx bxs-right-arrow-alt'></i></p>
                </div>
              </div>

              <div class="card border-0">
                <img src="./assets/image/Rectangle 50.png" alt="">
                <div class="d-flex justify-content-between my-5 mx-lg-5">
                  <div>
                    <h3>All Under $40</h3>
                    <p>Explore Now!</p>
                  </div>
                  <p class="fs-1"><i class='bx bxs-right-arrow-alt'></i></p>
                </div>
              </div>
            </div>

           </section>

           <section>
                <div class="container py-6">
                  <div class="row flex-lg-row-reverse align-items-center  ">
                    <div class="col-10 mx-auto col-sm-8 col-lg-4">
                      <img src="./assets/image/Mobile-app.png" class="d-block mx-lg-auto img-fluid" alt="Mobile-app" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                      <div class="lc-block mb-3">
                        <div editable="rich">
                          <h2 class="fw-bold display-5 p-1">DOWNLOAD APP &
                            GET THE VOUCHER!</h2>
                        </div>
                      </div>

                      <div class="lc-block mb-3">
                        <div editable="rich">
                          <p class="lead p-1">Get 30% off for first transaction using
                            Rondovision mobile app for now.
                          </p>
                        </div>
                      </div>
                      <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start mb-3 ">
                          <img src="./assets/image/app-store.png" alt="app-store">
                          <img src="./assets/image/google-pay.png" alt="google-pay">
                      </div>

                    </div>
                  </div>
                </div>
           </section>

           <!-- join shopping -->
           <section class="bg-color">
            <div class="container text-center">
              <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                  <div class="p-5 mb-4 lc-block">
                    <div class="mb-4">
                      <h2 class="fs-1 fw-bolder">JOIN SHOPPING COMMUNITY TO <br> GET MONTHLY PROMO</h2>
                    </div>
                    <div class="lc-block mb-5">
                      <div editable="rich">
                        <p class="lead">Type your email down below and be young wild generation</p>
                      </div>
                      <div class="input-group w-100 w-md-75 mx-auto">
                        <input type="text" class="form-control" placeholder="Add your Email Here">
                        <button class="btn btn-dark">Send</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </section>
    </main>

    <footer class="bg-black text-white px-2 py-5">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
            <h5>FASHION</h5>
            <p>Complete your style with awesome clothes from us.</p>
            <img class="w-50" src="./assets/image/Frame 18.png" alt="frame">
          </div>
          <div class="col-md-2 col-sm-6 mb-4 mb-md-0">
            <h5>Company</h5>
            <ul class="list-unstyled">
              <li class="text-white my-3 fst-normal fw-lighter">About Us</a></li>
              <li class="text-white my-3 fst-normal fw-lighter">Careers</a></li>
              <li class="text-white my-3 fst-normal fw-lighter">Blog</a></li>
              <li class="text-white my-3 fst-normal fw-lighter">Contact Us</a></li>
            </ul>
          </div>
          <div class="col-md-2 col-sm-6 mb-4 mb-md-0">
            <h5>Quick Link</h5>
            <ul class="list-unstyled">
              <li class="text-white my-3 fst-normal fw-lighter">Share Location</a></li>
              <li class="text-white my-3 fst-normal fw-lighter">Orders Tracking</a></li>
              <li class="text-white my-3 fst-normal fw-lighter">Size Guide</a></li>
              <li class="text-white my-3 fst-normal fw-lighter">SEO</a></li>
            </ul>
          </div>
          <div class="col-md-2 col-sm-6 mb-4 mb-md-0">
            <h5>Legal</h5>
            <ul class="list-unstyled">
              <li class="text-white my-3 fst-normal fw-lighter">Terms & conditions</a></li>
              <li class="text-white my-3 fst-normal fw-lighter">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/assets/script.js"></script>
  </body>
</html>