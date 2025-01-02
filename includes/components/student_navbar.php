

<!-- student navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
      <a href="#" class="navbar-brand text-light">
          <h3>Student Dashboard</h3>
      </a>
      
      <!-- Mobile Toggle Button -->
      <button class="navbar-toggler" 
              type="button" 
              data-bs-toggle="offcanvas" 
              data-bs-target="#sidebar-mobile"
              aria-controls="sidebar-mobile">
          <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Dark Mode Toggle -->
      <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="darkModeToggle" />
      <label class="form-check-label text-light" for="darkModeToggle" id = "themeLabel">Dark Mode</label>
     </div>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <!-- Notification Dropdown -->
              <li class="nav-item dropdown me-3">
                  <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                      <i class="fas fa-bell"></i>
                      <span class="position-absolute top-55 start-100 translate-middle badge rounded-pill bg-danger">
                          3
                      </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li><h6 class="dropdown-header">Notifications</h6></li>
                      <li><a class="dropdown-item" href="#">New assignment posted</a></li>
                      <li><a class="dropdown-item" href="#">Grade updated</a></li>
                      <li><a class="dropdown-item" href="#">Class schedule changed</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item text-primary" href="#">View all notifications</a></li>
                  </ul>
              </li>

              <!-- Profile Picture Dropdown -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                      <div class="avatar-wrapper">
                          <img src="<?php echo !empty($student['profile_picture']) ?'../../' . $student['profile_picture'] : '../../assets/img/default-avatar.png'; ?>"  
                               alt="Profile" 
                               class="avatar">
                      </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                      <li><a class="dropdown-item" href="student_contact.php"> <i class="fas fa-envelope me-2"></i>contact</a></li>
            
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="../../pages/auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                  </ul>
              </li>
          </ul>

          <!-- Search Box -->
          <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
      </div>
  </div>
</nav>
<!-- student navbar ends here -->