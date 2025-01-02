<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Include database connection
require_once("../../includes/config/db_connection.php");

// Get and validate the class ID
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
if ($class_id <= 0) {
    header("Location: dashboard.php");
    exit();
}

// Fetch subject information
$stmt = $conn->prepare("SELECT subject_name FROM subjects WHERE id = ?");
$stmt->bind_param("i", $class_id);
$stmt->execute();
$result = $stmt->get_result();
$subject = $result->fetch_assoc();
$stmt->close();

// Fetch groups for the selected subject
$stmt = $conn->prepare("SELECT id, group_name FROM subject_groups WHERE subject_id = ?");
$stmt->bind_param("i", $class_id);
$stmt->execute();
$groups = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch placeholder student profiles
$stmt = $conn->prepare("SELECT id, full_name, profile_picture FROM students ORDER BY RAND() LIMIT 5");
$stmt->execute();
$placeholder_students = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch groups for the selected subject with student count
$stmt = $conn->prepare("SELECT sg.id, sg.group_name, (SELECT COUNT(*) FROM student_groups WHERE subject_group_id = sg.id) AS student_count
FROM subject_groups sg
WHERE sg.subject_id = ?"
);
$stmt->bind_param("i", $class_id);
$stmt->execute();
$groups = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch subjects from the database
$stmt = $conn->prepare("SELECT id, subject_name FROM subjects");
$stmt->execute();
$subjects = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Handle group selection form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject_group_id'])) {
    $student_id = $_SESSION['id'];
    $subject_group_id = intval($_POST['subject_group_id']);

    // Check existing enrollment
    $stmt = $conn->prepare("SELECT * FROM student_groups WHERE student_id = ? AND subject_group_id IN (SELECT id FROM subject_groups WHERE subject_id = ?)");
    $stmt->bind_param("ii", $student_id, $class_id);
    $stmt->execute();
    $existing_enrollment = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($existing_enrollment) {
        $error_message = "You are already enrolled in a group for this subject.";
    } else {
        // Insert new enrollment
        $stmt = $conn->prepare("INSERT INTO student_groups (student_id, subject_group_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $student_id, $subject_group_id);
        if ($stmt->execute()) {
            $success_message = "You have successfully joined the group.";
        } else {
            $error_message = "An error occurred while joining the group.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Selection - Maradock</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/pages/student_edit.css">
</head>
<body>
    <!-- Navigation -->
    <?php include '../../includes/components/student_navbar.php'; ?>

    <!-- include sidebar -->
    <?php include '../../includes/components/sidebar.php'; ?>
    <!-- Main Content -->
     <div id = "content">

     
    <div class="container mt-5">
        <h1>Class Selection</h1>
        <?php if ($subject): ?>
            <h2>Subject: <?php echo htmlspecialchars($subject['subject_name']); ?></h2>
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <h3>Enrolled Students:</h3>
            <div class="row">
                <?php foreach ($placeholder_students as $student): ?>
                    <div class="col-md-2 text-center mb-3">
                        <img src="<?php echo !empty($student['profile_picture']) ? $student['profile_picture'] : '../../assets/img/default-avatar.png'; ?>" alt="Profile" class="rounded-circle" style="width: 60px; height: 60px;">
                        <p><?php echo htmlspecialchars($student['full_name']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Hint Button -->
            <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#hintModal">
                Show Hint
            </button>

            <!-- Available Groups -->
            <h3>Available Groups:</h3>
            <div class="row">
                <!-- Static Placeholder Cards -->
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">JIM1103A</h5>
                            <p class="card-text">Students: 21/21</p>
                            <button class="btn btn-secondary" disabled>Join Group</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">JIM1103B</h5>
                            <p class="card-text">Students: 21/21</p>
                            <button class="btn btn-secondary" disabled>Join Group</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">JIM1103C</h5>
                            <p class="card-text">Students: 21/21</p>
                            <button class="btn btn-secondary" disabled>Join Group</button>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Group from Database -->
                <?php if (!empty($groups)): ?>
                    <?php foreach ($groups as $group): ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($group['group_name']); ?></h5>
                                    <p class="card-text">
                                        Students: <?php echo $group['student_count']; ?>/21
                                    </p>
                                    <form method="POST">
                                        <input type="hidden" name="subject_group_id" value="<?php echo $group['id']; ?>">
                                        <button type="submit" class="btn btn-primary">Join Group</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Subject not found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- hint modal -->
 <div class="modal fade" id="hintModal" tabindex="-1" aria-labelledby="hintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="hintModalLabel">Important Note</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                The dynamic cards will only appear based on what is available in the database. Should there be no available groups to join,
                please insert a new group in the table subject_groups.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
 </div>
    <!-- Include Footer -->
    <?php include '../../includes/components/student_footer.php'; ?>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark mode script
        function setTheme(theme) {
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            document.getElementById('themeLabel').innerText = theme === 'dark' ? 'Dark Mode On' : 'Dark Mode Off';
        }

        document.getElementById('darkModeToggle').addEventListener('change', function(event) {
            setTheme(event.target.checked ? 'dark' : '');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                setTheme(savedTheme);
                document.getElementById('darkModeToggle').checked = savedTheme === 'dark';
            }
        });
    </script>
</body>
</html>