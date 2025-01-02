<?php
session_start();
require_once 'db_connection.php';

// Check if student is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    if (!isset($_POST['category']) || !isset($_POST['subject']) || !isset($_POST['description'])) {
        $_SESSION['error_message'] = 'Please fill in all required fields';
        header('Location: student_contact.php');
        exit();
    }

    $student_id = $_SESSION['id'];
    $category = trim($_POST['category']);
    $subject = trim($_POST['subject']);
    $description = trim($_POST['description']);

    // Validate required fields are not empty
    if (empty($category) || empty($subject) || empty($description)) {
        $_SESSION['error_message'] = 'All fields are required';
        header('Location: student_contact.php');
        exit();
    }

    // Handle file upload
    $attachment_path = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/tickets/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
        $file_name = uniqid() . '.' . $file_extension;
        $attachment_path = $upload_dir . $file_name;
        
        move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment_path);
    }

    // Insert ticket into database
    $query = "INSERT INTO tickets (student_id, category, subject, description, attachment) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issss', $student_id, $category, $subject, $description, $attachment_path);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Ticket submitted successfully';
        header('Location: student_contact.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Failed to submit ticket: ' . $conn->error;
        header('Location: student_contact.php');
        exit();
    }
} else {
    // If not POST request
    $_SESSION['error_message'] = 'Invalid request method';
    header('Location: student_contact.php');
    exit();
}
?>