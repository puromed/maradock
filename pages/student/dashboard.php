<?php
// filename: dashboard.php

session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["id"]) || $_SESSION["id"] === false) {
    header("location: ../auth/login.php");
    exit;
}

// Include database connection
require_once '../../includes/config/db_connection.php';

// Fetch student-specific data from the database
$user_id = $_SESSION['id'];
$query = "SELECT * FROM students WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Fetch subject information for the upcoming classes
$stmt = $conn->prepare("SELECT id, subject_name FROM subjects");
$stmt->execute();
$result = $stmt->get_result();
$subjects = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Initialize database connection if not already done
$query = "SELECT * FROM subjects LIMIT 1";  // Or specific subject ID as needed
$result = $conn->query($query);
$subject = $result->fetch_assoc();

// Get current page for active state
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <script src="https://kit.fontawesome.com/3df8276c8a.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/pages/dashboard.css">
    
</head>
<body>

<?php include '../../includes/components/student_navbar.php'; ?>
  
<div class="wrapper">
   <!-- Sidebar -->
    <?php include '../../includes/components/sidebar.php'; ?>

    <!-- main content -->
    <div id="content">
        <div class="container-fluid">
            <h5 class="mb-3">
                Welcome, <?php echo htmlspecialchars($student['full_name'], ENT_QUOTES, 'UTF-8'); ?>
            </h5>
            
            <!-- Dashboard Widgets -->
               <!-- Hint Button -->
            <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#hintModal">
                Show Hint
            </button>

            <div class="mt-1 mb-3 button-container">
                <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                  <div class="bg-white border shadow">
                    <div class="media p-4">
                      <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                      <i class="fa-solid fa-user"></i>
                      </div>
                      <div class="media-body pl-2">
                        <h5 class="m-0">Student Id</h5>
                        <?php if ($student['user_id'] === null) : ?>
                            <p class="text-muted m-0">No Student ID</p>
                        <?php else : ?> 
                            <p class="text-muted m-0"><?php echo htmlspecialchars($student['student_id'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                  <div class="bg-white border shadow">
                    <div class="media p-4">
                      <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                      <i class="fa-solid fa-calendar-week"></i>
                      </div>
                      <div class="media-body pl-2">
                        <h5 class="m-0">Semester</h5>
                        <?php if ($student['year'] === null) : ?>
                            <p class="text-muted m-0">No semester assigned</p>
                        <?php else : ?> 
                            <p class="text-muted m-0"><?php echo htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                  <div class="bg-white border shadow">
                    <div class="media p-4">
                      <div class="align-self-center mr-3 rounded-circle notify-icon">
                      <i class="fa-solid fa-database"></i>
                      </div>
                      <div class="media-body pl-2">
                        <h5 class="m-0">Course</h5>
                        <?php if ($student['course'] === null) : ?>
                            <p class="text-muted m-0">No course assigned</p>
                        <?php else : ?> 
                            <p class="text-muted m-0"><?php echo htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
             
             <!-- widget ends here -->
            
            <!-- Upcoming Classes -->
            <div class="upcoming-classes-container">
                <h5 class="mb-3">Upcoming Classes</h5>
                <div class="row">
                    <?php foreach ($subjects as $subject): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="class-card">
                                <img src="../../assets/img/class1.jpg" alt="Class Image" class="class-image">
                                <div class="class-info">
                                    <h6><?php echo htmlspecialchars($subject['subject_name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                    <a href="class_selection.php?class_id=<?php echo $subject['id']; ?>" class="btn btn-primary">Join Class</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Assignment List -->
            <div class="mt-4">
                <div class="row">
                    <!-- Assignments Box -->
                    <div class="col-lg-6 mb-4">
                        <div class="assignments-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0">Assignments</h5>
                                <span class="badge bg-primary">4 Pending</span>
                            </div>
                            <div class="assignment-list">
                                <div class="assignment-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Mathematics Assignment</h6>
                                            <p class="text-muted mb-0">Due: March 25, 2024</p>
                                        </div>
                                        <div class="dropdown">
                                            <span class="badge priority-badge bg-danger" 
                                                  data-assignment-id="1" 
                                                  data-bs-toggle="dropdown" 
                                                  aria-expanded="false"
                                                  role="button">High Priority</span>
                                            <ul class="dropdown-menu">
                                                <li><button class="dropdown-item priority-option" data-priority="high">High Priority</button></li>
                                                <li><button class="dropdown-item priority-option" data-priority="medium">Medium Priority</button></li>
                                                <li><button class="dropdown-item priority-option" data-priority="low">Low Priority</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="assignment-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Physics Lab Report</h6>
                                            <p class="text-muted mb-0">Due: March 28, 2024</p>
                                        </div>
                                        <div class="dropdown">
                                            <span class="badge priority-badge bg-warning" 
                                                  data-assignment-id="1" 
                                                  data-bs-toggle="dropdown" 
                                                  aria-expanded="false"
                                                  role="button">Medium Priority</span>
                                            <ul class="dropdown-menu">
                                                <li><button class="dropdown-item priority-option" data-priority="high">High Priority</button></li>
                                                <li><button class="dropdown-item priority-option" data-priority="medium">Medium Priority</button></li>
                                                <li><button class="dropdown-item priority-option" data-priority="low">Low Priority</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Exams Box -->
                    <div class="col-lg-6 mb-4">
                        <div class="exams-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0">Upcoming Exams</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">View Schedule</a>
                            </div>
                            <div class="exam-list">
                                <div class="exam-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Midterm Examination</h6>
                                            <p class="text-muted mb-0">Date: April 1, 2024</p>
                                        </div>
                                        <div class="countdown">5 days left</div>
                                    </div>
                                </div>
                                <div class="exam-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Quiz - Chapter 5</h6>
                                            <p class="text-muted mb-0">Date: March 27, 2024</p>
                                        </div>
                                        <div class="countdown">2 days left</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="my-4">
                <div class="row">
                    <!-- Assignment Chart -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Assignments</h5>
                            </div>
                            <div class="card-body">
                                <div id="assignmentChart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Attendance Chart -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Attendance</h5>
                            </div>
                            <div class="card-body">
                                <div id="attendanceChart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Participation Chart -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Participation</h5>
                            </div>
                            <div class="card-body">
                                <div id="participationChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- gpa Chart -->
           <div class="my-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">GPA Chart</div>
                        </div>
                        <div class="card-body">
                            <input type="number" id="subjectCount" placeholder="Enter number of subjects" min="1" class="form-control mb-3">
                            <div id="marksContainer"></div>
                            <button id="gpaSubmit" class="btn btn-primary mt-3">Calculate GPA</button>
                            <div id="gpaChart" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
            
        </div>
    </div>
</div>
<!-- end wrapper -->

<!-- Hint Modal -->
<div class="modal fade" id="hintModal" tabindex="-1" aria-labelledby="hintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hintModalLabel">Important Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                To display the dynamic class information and upcoming classes, please ensure that the class data is inserted into the database first.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../../includes/components/student_footer.php'; ?>


      

   
 
    <!--popper.js-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <!--bootstrap.js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!--apexcharts.js-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Custom JS -->
    <script src="../../assets/js/dashboard.js"></script>

    

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
