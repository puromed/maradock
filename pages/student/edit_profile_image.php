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

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();


// form submission

//debug

// debug ends here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "../../public/uploads/";
    
    // Ensure the target directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    
    $target_file = $target_dir .basename($_FILES['profile_picture']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['profile_picture']['tmp_name']);
    if($check == false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['profile_picture']["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        $new_file_name = uniqid() . "_" . basename($_FILES['profile_picture']['name']);
        $target_file = $target_dir . $new_file_name;
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            $target_file = str_replace('../../', '', $target_file);
            //update database
            $update_query = "UPDATE students SET profile_picture = ? WHERE user_id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('si', $target_file, $_user_id);
            $stmt->execute();
            header("Location: profile.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

//fetch student data
$_user_id = $_SESSION['id'];
$query = "SELECT s.profile_picture FROM students s WHERE s.user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_user_id);
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
    <title>Edit Profile Picture - Maradock</title>
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
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="profile-picture-container mb-3">
                                    <img src="<?php echo !empty($student['profile_picture']) ? '../../' . $student['profile_picture'] : '../../assets/img/default-avatar.png'; ?>" 
                                         alt="profile picture" 
                                         class="profile-picture mb-3" 
                                         id="profilePreview">
                                    <div class="mt-2">
                                        <label for="profile_picture" class="btn btn-outline-primary">
                                            <i class="fas fa-camera"></i> Change Photo
                                        </label>
                                        <input type="file" name="profile_picture" id="profile_picture" class="d-none" accept="image/jpeg, image/png">
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <a href="profile.php" class="btn btn-secondary">Cancel</a>
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
        // Preview image before upload
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

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
