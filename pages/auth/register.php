<?php

session_start();
require_once '../../includes/config/db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $student_id = $_POST['student_id'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $enrollment_date = date('Y-m-d');

    //basic validation
    if(empty ($email) || empty($username) || empty($password)){
        echo 'Please fill in all the fields';
        exit();
    }

    //check if the email already exists in the database
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param('s', $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if($result->num_rows > 0){
        echo 'Email already exists';
        exit();
    }

    //hash the password
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    //insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $email, $username, $hashedpassword);

    if($stmt->execute()){
        $user_id = $conn->insert_id;
        //insert the student details into the students table
        $stmt = $conn->prepare("INSERT INTO students (user_id, full_name, student_id, phone, date_of_birth, address, city, course, year, enrollment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param('isssssssss', $user_id, $fullname, $student_id, $phone, $date_of_birth, $address, $city, $course, $year, $enrollment_date);
        
        if($stmt->execute()){
            echo 'User registered successfully';
            header('Location: login.php');
            exit();
        } else {
            echo 'Error registering user';
        }
    } else {
        echo 'Error registering user';
    }  
    
    $stmt->close();

}

$conn->close();

?>