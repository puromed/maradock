<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../../pages/auth/login.php");
    exit();
}

// Include database connection (only once)
require_once("db_connection.php");

// Retrieve data from the form submission
$full_name = $_POST['full_name'];
$student_id = $_POST['student_id'];
$email = $_POST['email'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$date_of_birth = $_POST['date_of_birth'];
$address = $_POST['address'];
$city = $_POST['city'];
$course = $_POST['course'];
$year = $_POST['year'];
$profile_picture = ''; // Initialize the profile picture variable

// Handle profile picture upload
$profile_picture = null; // Initialize the profile picture variable

// Handle profile picture upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['profile_picture']['tmp_name'];
    $name = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
    $destination = '../../public/uploads/' . $name;
    if (move_uploaded_file($tmp_name, $destination)) {
        $profile_picture = $destination;
    } else {
        // Handle file upload error and redirect
        $_SESSION['error'] = "Error in uploading the profile picture";
        header("Location: ../../pages/student/edit_profile.php?error=fileuploadfailed");
        exit();
    }
}

// Validate input data
if (empty($full_name) || empty($student_id) || empty($email) || empty($username) || empty($phone) || empty($date_of_birth) || empty($address) || empty($city) || empty($course) || empty($year)) {
    $_SESSION['error'] = "All fields are required";
    header("Location: ../../pages/student/edit_profile.php?error=emptyfields");
    // tell the user that the fields are empty
    echo "All fields are required";
    exit();
}

// Update the record in the students table
if ($profile_picture !== null) {
    $stmt = $conn->prepare("UPDATE students SET full_name = ?, student_id = ?, phone = ?, date_of_birth = ?, address = ?, city = ?, course = ?, year = ?, profile_picture = ? WHERE user_id = ?");
    $stmt->bind_param("sssssssssi", $full_name, $student_id, $phone, $date_of_birth, $address, $city, $course, $year, $profile_picture, $_SESSION['id']);
} else {
    $stmt = $conn->prepare("UPDATE students SET full_name = ?, student_id = ?, phone = ?, date_of_birth = ?, address = ?, city = ?, course = ?, year = ? WHERE user_id = ?");
    $stmt->bind_param("ssssssssi", $full_name, $student_id, $phone, $date_of_birth, $address, $city, $course, $year, $_SESSION['id']);
}
$stmt->execute();

// Update the record in the users table
$stmt2 = $conn->prepare("UPDATE users SET email = ?, username = ? WHERE id = ?");
$stmt2->bind_param("ssi", $email, $username, $_SESSION['id']);
$stmt2->execute();

// Check if the updates were successful
if ($stmt->affected_rows > 0 || $stmt2->affected_rows > 0) {
    // Redirect to the profile page with a success message
    $_SESSION['success'] = "Profile updated successfully";
    header("Location: ../../pages/student/profile.php?update=success");
    exit();
} else {
    // Handle update error (redirect back with an error message)
    $_SESSION['error'] = "Update failed or no changes made";
    header("Location: ../../pages/student/edit_profile.php?error=updatefailed");
    exit();
}

// Close the database connection
$stmt->close();
$stmt2->close();
$conn->close();
?>