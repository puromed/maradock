<?php
session_start();
include('db_connection.php'); // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE email = ? AND username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result-> fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            //if the password is correct, set the session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ../../pages/student/dashboard.php'); // Redirect to the dashboard page
            exit();
        } else {
            // If the password is incorrect, show an error message
            echo 'Invalid password';
        }
    } else {
        // If the user does not exist, show an error message
        echo 'User not found';
    }
}
?>