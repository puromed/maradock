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
JOIN users u ON s.user_id = u.id
WHERE s.user_id = ?";

// Fetch subjects from the database
$stmt = $conn->prepare("SELECT id, subject_name FROM subjects");
$stmt->execute();
$subjects = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

//get current page for active state
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Maradock</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/pages/student_edit.css">
</head>
<body>
   <!-- student navbar -->
<?php include '../../includes/components/student_navbar.php'; ?>
<!-- student navbar ends here -->

    <div class="wrapper">
        <!-- Include Sidebar -->
        <?php include '../../includes/components/sidebar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="profile-container">
                    <form action="../../includes/config/update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 text-center">
                            <div class="profile-picture-container mb-3">
                                <img src="<?php echo !empty($student['profile_picture']) ?'../../' . $student['profile_picture'] : '../../assets/img/default-avatar.png'; ?>" 
                                    alt="profile picture" 
                                    class="profile-picture mb-3" 
                                    id="profilePreview">
                                <div class="mt-2">
                                    <a href="edit_profile_image.php" class="btn btn-outline-primary">
                                        <i class="fas fa-camera"></i> Change Photo
                                    </a>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Personal Information</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($student['full_name']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Student ID</label>
                                                <input type="text" class="form-control" name="student_id" value="<?php echo htmlspecialchars($student['student_id']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($student['email']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($student['username']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Phone</label>
                                                <input type="tel" class="form-control" name="phone" value="<?php echo htmlspecialchars($student['phone']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" name="date_of_birth" value="<?php echo htmlspecialchars($student['date_of_birth']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($student['address']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($student['city']?? ''); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Course</label>
                                                <select class="form-select" name="course">
                                                    <option value="systemIM" <?php echo $student['course'] == 'Information System' ? 'selected' : ''; ?>>Information System</option>
                                                    <option value="contentIM" <?php echo $student['course'] == 'Information Content' ? 'selected' : ''; ?>>Information Content</option>
                                                    <option value="recordIM" <?php echo $student['course'] == 'Information Record' ? 'selected' : ''; ?>>Information Record</option>
                                                    <option value="libraryIM" <?php echo $student['course'] == 'Library Management' ? 'selected' : ''; ?>>Library Management</option>
                                                    <option value="accounting" <?php echo $student['course'] == 'Computer Science' ? 'selected' : ''; ?>>Accounting</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Year</label>
                                                <select class="form-select" name="year">
                                                    <option value="1" <?php echo $student['year'] == '1' ? 'selected' : ''; ?>>First Year</option>
                                                    <option value="2" <?php echo $student['year'] == '2' ? 'selected' : ''; ?>>Second Year</option>
                                                    <option value="3" <?php echo $student['year'] == '3' ? 'selected' : ''; ?>>Third Year</option>
                                                    <option value="4" <?php echo $student['year'] == '4' ? 'selected' : ''; ?>>Fourth Year</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Enrollment Date</label>
                                                <input type="date" class="form-control" name="enrollment_date" value="<?php echo htmlspecialchars($student['enrollment_date']?? ''); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <a href="profile.php" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include '../../includes/components/student_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        // darkmode script
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
    
