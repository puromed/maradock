<?php 
session_start();

//Check if the user is logged in
if(!isset($_SESSION['id'])){
    header("Location: ../auth/login.php");
    exit();
}

//include database connection
require_once("../../includes/config/db_connection.php");

//fetch student data
$_user_id = $_SESSION['id'];
$query = "SELECT s.*, u.email, u.username FROM students s
JOIN users u ON s.user_id  = u.id
WHERE s.user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Fetch subjects from the database
$stmt = $conn->prepare("SELECT id, subject_name FROM subjects");
$stmt->execute();
$subjects = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

//get current page for active state
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Support - Maradock</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/3df8276c8a.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/pages/student_profile.css">
</head>

<body>
    <!--Navigation-->
    <?php include '../../includes/components/student_navbar.php'; ?>
<!-- student navbar ends here -->
  
<div class="wrapper">
   <!-- Sidebar -->
    <?php include '../../includes/components/sidebar.php'; ?>

    <!--main content-->
    <div id="content">
            <div class="container-fluid">
                <div class="profile-container">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="<?php echo !empty($student['profile_picture']) ? '../../' . $student['profile_picture'] : '../../assets/img/default-avatar.png'; ?>" 
                                alt="profile picture" 
                                class="profile-picture mb-3">
                            <h4><?php echo htmlspecialchars($student['full_name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="text-muted">
                                <?php echo htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8'); ?> - 
                                Year <?php echo htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <button class="btn btn-primary mt-3" onclick="location.href='edit_profile.php'">
                                <i class="fas fa-edit"></i> Edit Profile
                            </button>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="profile-info">
                                <div class="info-card">
                                    <h5><i class="fas fa-user"></i> Personal Information</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 student-info">
                                            <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p><strong>Username:</strong> <?php echo htmlspecialchars($student['username'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php if(isset($student['phone'])) { ?>
                                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($student['phone'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 student-info">
                                            <?php if(isset($student['date_of_birth'])) { ?>
                                                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($student['date_of_birth'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php } ?>
                                            <?php if(isset($student['address'])) { ?>
                                                <p><strong>Address:</strong> <?php echo htmlspecialchars($student['address'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php } ?>
                                            <?php if(isset($student['city'])) { ?>
                                                <p><strong>City:</strong> <?php echo htmlspecialchars($student['city'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <h5><i class="fas fa-graduation-cap"></i> Academic Information</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 student-info">
                                            <p><strong>Course:</strong> <?php echo htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p><strong>Year Level:</strong> <?php echo htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        </div>
                                        <div class="col-md-6 student-info">
                                            <?php if(isset($student['enrollment_date'])) { ?>
                                                <p><strong>Enrollment Date:</strong> <?php echo htmlspecialchars($student['enrollment_date'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php } ?>
                                            <?php if(isset($student['student_id'])) { ?>
                                                <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--footer-->
<?php include '../../includes/components/student_footer.php'; ?>

 <!--popper.js-->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<!--bootstrap.js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

 <!-- Custom JS -->
 <script src="../../assets/js/main.js"></script>

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



