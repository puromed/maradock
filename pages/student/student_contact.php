<?php
session_start();
require_once '../../includes/config/db_connection.php';

//check if student is logged in
if (!isset($_SESSION['id']) || $_SESSION["id"]=== false) {
    header('Location: ../auth/login.php');
    exit();
}

// get student data
$student_id = $_SESSION['id'];
$query = "SELECT * FROM students WHERE user_id = ?" ;
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Fetch subjects from the database
$stmt = $conn->prepare("SELECT id, subject_name FROM subjects");
$stmt->execute();
$subjects = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Get current page for active state
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
    <link rel="stylesheet" href="../../assets/css/pages/student_contact2.css">
</head>
<body>
     <!--Navigation-->
        <?php include '../../includes/components/student_navbar.php'; ?>
<!-- student navbar ends here -->

 <!-- Sidebar -->
<div class="wrapper">
<!--include sidebar.php-->
<?php include '../../includes/components/sidebar.php'; ?>
<!-- main content -->
<div id="content">


    <!-- Hero Section -->
    
 <!-- <div class="student-contact-hero">
    <div class="hero-overlay">
        <div class="container-fluid py-5">
            <div class="hero-content text-center">
                <h1 class="display-4 fw-bold text-white mb-4">How Can We Help You?</h1>
                <p class="lead text-white mb-4">Our support team is here to assist you with any questions or concerns</p>
                <div class="support-stats d-flex justify-content-center gap-4 mb-4">
                    <div class="stat-item">
                        <div class="stat-value">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">1hr</div>
                        <div class="stat-label">Response Time</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">95%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
 


    <!-- Support Options -->
    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Quick Support -->
            <div class="col-lg-4">
                <div class="support-card h-100 p-4 rounded-4">
                    <div class="icon-box mb-3">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h5>Live Chat Support</h5>
                    <p>Get instant help from our support team</p>
                    <button class="btn btn-primary mt-3" onclick="openLiveChat()">Start Chat</button>
                </div>
            </div>

            <!-- Ticket System -->
            <div class="col-lg-8">
                <div class="contact-form-wrapper support-form-container p-4 rounded-4">
                    <h3 class="mb-4">Submit Support Ticket</h3>
                    <form id="studentSupportForm" action="../../includes/config/process_ticket.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <!-- Pre-filled student info -->
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student['full_name'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="course" class="form-control" value="<?php echo htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <!-- Support categories -->
                        <div class="col-12">
                            <select class="form-select" name="category" required>
                                <option value="">Select Support Category</option>
                                <option value="technical">Technical Support</option>
                                <option value="academic">Academic Support</option>
                                <option value="billing">Billing Support</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" name="description" rows="5" placeholder="Describe your issue..." required></textarea>
                        </div>
                        <!-- File attachment -->
                        <div class="col-12">
                            <input type="file" class="form-control" name="attachment" accept=".jpg,.png,.pdf,.doc,.docx">
                            <small class="text-muted">Attach screenshots or relevant documents</small>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit Ticket</button>
                        </div>
                    </div>
                </form>
                    <!-- Display success or error message -->
                    <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php 
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php 
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Support History -->
        <div class="support-history mt-5">
            <h3 class="mb-4">Your Support History</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Category</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
// Fetch tickets for current student
$ticket_query = "SELECT * FROM tickets WHERE student_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($ticket_query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$tickets = $stmt->get_result();

// Display tickets
if ($tickets->num_rows > 0) {
    while ($ticket = $tickets->fetch_assoc()) {
        // Define status colors
        $status_class = match(strtolower($ticket['status'])) {
            'open' => 'text-primary',
            'in progress' => 'text-warning',
            'resolved' => 'text-success',
            'closed' => 'text-secondary',
            default => ''
        };
        
        // Format date
        $date = date('M d, Y', strtotime($ticket['created_at']));
        
        echo "<tr>
                <td>#" . htmlspecialchars($ticket['ticket_id']) . "</td>
                <td>" . htmlspecialchars($ticket['category']) . "</td>
                <td>" . htmlspecialchars($ticket['subject']) . "</td>
                <td><span class='{$status_class}'>" . htmlspecialchars($ticket['status']) . "</span></td>
                <td>{$date}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No support tickets found</td></tr>";
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>



    <!-- Include dashboard footer -->
    <?php include '../../includes/components/student_footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openLiveChat() {
            // Implement live chat functionality
            alert('Live chat feature coming soon!');
        }

        //dark mode toggle
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