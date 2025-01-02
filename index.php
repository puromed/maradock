<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

<!-- font awesome -->
<script src="https://kit.fontawesome.com/3df8276c8a.js" crossorigin="anonymous"></script>

    <!-- external css -->
    <link rel = "stylesheet" href = "assets/css/style.css">
    <title>Maraboard: The hub for students</title>
</head>
<body>
    <!--header-->
    <!-- <div class="container my-4">
        <div class="title">Maradock</div>
    </div> -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
  <!-- Container wrapper -->
  <div class="container-fluid px-4">
    <!-- Navbar brand -->
    <img src="assets/img/home/logo.png" alt="Maradock logo" width = "130"> 

    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-bars text-light"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="credit.php">Credits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
     
      <!-- Left links -->

      </ul>
      <!-- Right links -->
       
      <ul class="navbar-nav ms-auto d-flex flex-row mt-3 mt-lg-0">
        <li class="nav-item text-center mx-2 mx-lg-1">
          <a class="nav-link" href="pages/student/profile_selection.php">
            <button type="button" class="btn btn-outline-light btn-rounded">Login</button>
          </a>
        </li>
        <li class="nav-item text-center mx-2 mx-lg-1">
          <a class="nav-link" href="pages/auth/registration.html">
            <button type="button" class="btn btn-light btn-rounded">Sign up</button>
          </a>
        </li>
      </ul>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="darkModeToggle" />
        <label class="form-check-label" for="darkModeToggle" id = "themeLabel">Dark Mode</label>
       </div>
      <!-- Right links -->

      <!-- Search form -->
      <form class="d-flex input-group w-auto ms-lg-3 my-3 my-lg-0">
        <input type="search" class="form-control" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-light" type="button">
          Search
        </button>
      </form>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>

  <!-- Navbar -->

  <!--main content-->
 <!--hero section -->
 <div class="hero-section">
    <!-- Video Background Container -->
    <div class="hero-video-container">
        <video 
            autoplay 
            loop 
            muted 
            playsinline
            class="hero-background-video"
        >
            <!-- Video file -->
            <source src="assets/img/herovid.mp4" type="video/mp4">
           
            <!-- Fallback message if video doesn't load -->
            Your browser does not support the video tag.
        </video>
        <div class="hero-video-overlay"></div>
    </div>

    <!-- content -->
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="display-4 text-white fw-bold mb-4">Learning Made Easy.</h1>
                <p class="lead text-white mb-4">Your one-stop student hub for managing courses, assignments, and academic progress.</p>
                <!-- Search Box -->
                <div class="search-box-lg mb-4">
                    <div class="input-group">
                        <input id="searchBox" type="search" class="form-control form-control-lg" placeholder="What do you want to learn?">
                        <button class="btn btn-primary btn-lg" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="hero-buttons d-flex gap-3">
                    <button class="btn btn-primary btn-lg px-4">Get Started</button>
                    <button class="btn btn-outline-light btn-lg px-4">Learn More</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--popular categories -->
<div class="container my-5">
    <h2 class="mb-4">Available Courses</h2>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="category-card">
                <i class="fas fa-laptop-code fa-2x mb-3"></i>
                <h5>Computer Science</h5>
                <p>12 Courses</p>
            </div>
           
        </div>

        <div class="col-md-3">
        <div class="category-card">
                <i class="fa-solid fa-book-open fa-2x mb-3"></i>
                <h5>Information Science</h5>
                <p>5 Courses</p>
            </div>

          </div>
        <div class="col-md-3">
        <div class="category-card">
        <i class="fa-solid fa-microchip fa-2x mb-3"></i>
                <h5>Information Technology</h5>
                <p>8 Courses</p>
            </div>
          </div>

          <div class="col-md-3">
        <div class="category-card">
        <i class="fa-solid fa-microchip fa-2x mb-3"></i>
                <h5>Information Technology</h5>
                <p>8 Courses</p>
        </div>
        </div>
</div>
</div>

</div>

<!-- Carousel Section -->
<div class="container-fluid carousel-section my-5">
    <div class="container">
        <h2 class="mb-4">Featured Courses</h2>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/home/slide1.jpg" class="d-block w-100" alt="Course 1">
                    <div class="carousel-caption">
                        <h5>Computer Science</h5>
                        <p>Learn programming fundamentals and advanced concepts.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/home/slide2.jpg" class="d-block w-100" alt="Course 2">
                    <div class="carousel-caption">
                        <h5>Data Science</h5>
                        <p>Master data analysis and machine learning.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/home/slide3.jpg" class="d-block w-100" alt="Course 3">
                    <div class="carousel-caption">
                        <h5>Web Development</h5>
                        <p>Build modern websites and web applications.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<!-- about section -->
<div class="container about-section py-5">
    <div class="row align-items-center">
        <!-- Image Column -->
        <div class="col-lg-6 position-relative mb-4 mb-lg-0">
            <div class="about-image-wrapper">
                <img src="assets/img/home/about-image.jpg" alt="Students learning" class="img-fluid rounded-4 main-image">
                <div class="experience-badge">
                    <span class="h2 mb-0">10+</span>
                    <span class="small">Years of Excellence</span>
                </div>
            </div>
        </div>
        <!-- Content Column -->
        <div class="col-lg-6">
            <div class="about-content ps-lg-4">
                <h6 class="text-primary">ABOUT MARADOCK</h6>
                <h2 class="mb-4">Empowering Students Through Modern Education Technology</h2>
                <p class="lead mb-4">We're dedicated to making education accessible, engaging, and effective for students worldwide through our innovative learning platform.</p>
                
                <!-- Key Features -->
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="feature-item">
                            <i class="fas fa-graduation-cap mb-3"></i>
                            <h5>Expert Teachers</h5>
                            <p>Learn from industry professionals</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item">
                            <i class="fas fa-laptop-code mb-3"></i>
                            <h5>Online Learning</h5>
                            <p>Study anytime, anywhere</p>
                        </div>
                    </div>
                </div>
                
                <!-- Statistics -->
                <div class="row g-4 stats-container mb-4">
                    <div class="col-4">
                        <div class="stat-item">
                            <h3>50K+</h3>
                            <p>Active Students</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <h3>300+</h3>
                            <p>Total Courses</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <h3>95%</h3>
                            <p>Success Rate</p>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-3">
                    <a href="#courses" class="btn btn-primary">Explore Courses</a>
                    <a href="contact.php" class="btn btn-outline-primary">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>


 <!-- trusted by section -->
<div class="container-fluid trusted-section py-5">
    <div class="container text-center">
        <h4 class="mb-4">Trusted By Leading Institutions</h4>
        <div class="row g-4 justify-content-center align-items-center">
            <div class="col-4 col-md-2">
                <img src="assets/img/home/company1.png" alt="University Logo" class="img-fluid partner-logo">
            </div>
            <div class="col-4 col-md-2">
                <img src="assets/img/home/company2.png" alt="University Logo" class="img-fluid partner-logo">
            </div>
            <div class="col-4 col-md-2">
                <img src="assets/img/home/company3.png" alt="University Logo" class="img-fluid partner-logo">
            </div>
            <div class="col-4 col-md-2">
                <img src="assets/img/home/company4.png" alt="University Logo" class="img-fluid partner-logo">
            </div>
            <div class="col-4 col-md-2">
                <img src="assets/img/home/company5.png" alt="University Logo" class="img-fluid partner-logo">
            </div>
        </div>
    </div>
</div>

<!-- contact section -->

<!-- contact section -->
<div class="container contact-section py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h6 class="text-primary">CONTACT US</h6>
            <h2 class="display-5 mb-4">Need Help? Let's Talk</h2>
            <p class="lead mb-4">Get in touch with our support team for any questions or assistance you need.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Contact Us Now</a>
        </div>
        <div class="col-lg-6">
            <div class="contact-image-wrapper position-relative">
                <img src="assets/img/home/contact-illustration.jpg" alt="Contact Us" class="img-fluid rounded-4">
                
            </div>
        </div>
    </div>
</div>

 <!-- Footer -->
 <footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Maradock</h5>
                <p>Your one-stop student hub for managing courses, assignments, and academic progress.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-light">Home</a></li>
                    <li><a href="credit.php" class="text-light">Credits</a></li>
                    <li><a href="contact.php" class="text-light">Contact</a></li>
                </ul>
            </div>
            <!-- Social Media Icons -->
            <div class="col-md-4">
                <h5>Social Media</h5>
                <div class="d-flex justify-content-start">
                    <a href="https://www.facebook.com/maradock" class="text-light me-3"><i class="fab fa-facebook fa-1x"></i></a>
                    <a href="https://www.twitter.com/maradock" class="text-light me-3"><i class="fab fa-twitter fa-1x"></i></a>
                    <a href="https://www.instagram.com/maradock" class="text-light"><i class="fab fa-instagram fa-1x"></i></a>
                </div>
            </div>
            <!-- Contact Us -->
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>123 Education Street, Learning City, 12345</p>
                <p>
                    <i class="fas fa-envelope me-2"></i>
                    contact@maradock.com
                </p>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Maradock. All rights reserved.</p>
        </div>
    </div>
</footer>




    

  <!--popper.js-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    <!--dark mode script-->
    <script>
      function setTheme(theme){
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        document.getElementById('themeLabel').innerText = theme === 'dark' ? 'Dark Mode On' : 'Dark Mode Off';
      }

      document.getElementById('darkModeToggle').addEventListener('change', function(event){
        if(event.target.checked){
          setTheme('dark');
        }else{
          setTheme('');
        }
      });

      document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme');  // Fixed variable name
        if(savedTheme) {
            setTheme(savedTheme);
            if(savedTheme === 'dark') {
                document.getElementById('darkModeToggle').checked = true;
            }
        }
    });

    // Ensure video playback on mobile devices
    document.addEventListener('DOMContentLoaded', function (){
        const video = document.querySelector('.hero-background-video');

        // Ensure video plays on mobile devices
        video.play().catch(function(error){
            console.log('Error playing video:', error);
        });

        //Reload video when it ended
        video.addEventListener('ended', function(){
            video.play();
        });
    });

    // Search box text changing
    const placeholders = ["Database", "Web Programming", "Machine Learning", "Data Science", "Cloud computing"];
    let idx = 0;

    setInterval(() => {
        const searchBox = document.getElementById('searchBox');
        if (searchBox) {
            searchBox.placeholder = placeholders[idx];
            idx = (idx + 1) % placeholders.length;
        }
    },3000);

    </script>
</body>
</html>
