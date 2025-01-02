<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Maradock</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/3df8276c8a.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
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
          <a class="nav-link" href="pages/auth/login.php">
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

    <!-- Hero Section -->
    <div class="contact-hero py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Get in Touch</h1>
                    <p class="lead mb-4">We'd love to hear from you. Our team is always here to help.</p>
                    <div class="social-links mb-4">
                        <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="assets/img/contact/contact-hero.jpg" alt="Contact Us" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container py-5">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-wrapper p-4 rounded-4">
                    <h3 class="mb-4">Send us a Message</h3>
                    <form id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Subject" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="contact-info-wrapper">
                    <div class="contact-card mb-4 p-4 rounded-4">
                        <div class="icon-box mb-3">
                            <i class="fas fa-location-dot"></i>
                        </div>
                        <h5>Visit Us</h5>
                        <p>123 Education Street<br>Learning City, 12345<br>Country</p>
                    </div>

                    <div class="contact-card mb-4 p-4 rounded-4">
                        <div class="icon-box mb-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Email Us</h5>
                        <p>info@maradock.com<br>support@maradock.com</p>
                    </div>

                    <div class="contact-card p-4 rounded-4">
                        <div class="icon-box mb-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Call Us</h5>
                        <p>+1 234 567 8900<br>+1 234 567 8901</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
    <iframe 
        width="100%" 
        height="450" 
        class="rounded-4"
        frameborder="0" 
        scrolling="no" 
        marginheight="0" 
        marginwidth="0"
        src="https://www.openstreetmap.org/export/embed.html?bbox=101.484341,3.123657,101.504341,3.143657&amp;layer=mapnik&amp;marker=3.133657,101.494341">
    </iframe>
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

    <!--scripts-->
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

    </script>
    
</body>
</html>