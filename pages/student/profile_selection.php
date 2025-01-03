<?php
session_start();
include('../../includes/config/db_connection.php');

$query = "SELECT id, username, email FROM users";
$result = $conn->query($query);

$profiles = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $profiles[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Selection</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/pages/profile_selection.css">
    
</head>
<body>
     <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark">
  <!-- Container wrapper -->
  <div class="container-fluid px-4">
    <!-- Navbar brand -->
    

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
          <a class="nav-link" href="../../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../credit.php">Credits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../contact.php">Contact</a>
        </li>
     
      <!-- Left links -->

      </ul>
      <!-- Right links -->
       
      <ul class="navbar-nav ms-auto d-flex flex-row mt-3 mt-lg-0">
        <li class="nav-item text-center mx-2 mx-lg-1">
          <a class="nav-link" href="#">
            <button type="button" class="btn btn-outline-light btn-rounded">Login</button>
          </a>
        </li>
        <li class="nav-item text-center mx-2 mx-lg-1">
          <a class="nav-link" href="../../pages/auth/registration.html">
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


    <div class="gradient"></div>
    <div class="container">
      <!--hint-->
    <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#hintModal">
                Show Hint
            </button>
        <h1>Select a Profile</h1>
         
        
        <div class="profiles">
            <!-- Static Placeholder Cards -->
            <div class="profile-card">
                <img src="../../assets/img/default-avatar.png" alt="Placeholder Profile 1" style="width: 100px; height: 100px; border-radius: 50%;">
                <h3>Placeholder Profile 1</h3>
                <p>@placeholder1@example.com</p>
                <button type="button" class="btn btn-secondary" disabled>Join Profile</button>
            </div>
            <div class="profile-card">
                <img src="../../assets/img/default-avatar.png" alt="Placeholder Profile 2" style="width: 100px; height: 100px; border-radius: 50%;">
                <h3>Placeholder Profile 2</h3>
                <p>@placeholder2@example.com</p>
                <button type="button" class="btn btn-secondary" disabled>Join Profile</button>
            </div>
            <div class="profile-card">
                <img src="../../assets/img/default-avatar.png" alt="Placeholder Profile 3" style="width: 100px; height: 100px; border-radius: 50%;">
                <h3>Placeholder Profile 3</h3>
                <p>@placeholder3@example.com</p>
                <button type="button" class="btn btn-secondary" disabled>Join Profile</button>
            </div>
            <div class="profile-card">
                <img src="../../assets/img/default-avatar.png" alt="Placeholder Profile 4" style="width: 100px; height: 100px; border-radius: 50%;">
                <h3>Placeholder Profile 4</h3>
                <p>@placeholder4@example.com</p>
                <button type="button" class="btn btn-secondary" disabled>Join Profile</button>
            </div>

            <!-- Dynamic Profile Card -->
            <?php if (!empty($profiles)): ?>
                <?php foreach ($profiles as $profile): ?>
                    <div class="profile-card">
                        <img src="../../assets/img/default-avatar.png" alt="<?php echo htmlspecialchars($profile['username']); ?>" style="width: 100px; height: 100px; border-radius: 50%;">
                        <h3><?php echo htmlspecialchars($profile['username']); ?></h3>
                        <p>@<?php echo htmlspecialchars($profile['email']); ?></p>
                        <a href="../../pages/auth/login.php" class="btn btn-primary">Select Profile</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Hint Modal -->
<div class="modal fade" id="hintModal" tabindex="-1" aria-labelledby="hintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hintModalLabel">Important Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               The profile selection page has a dynamic profile. To ensure the profile card is there, please register first.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
