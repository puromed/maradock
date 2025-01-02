<!-- login page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/pages/login.css">
   
</head>

<body class="login-body">


    
    <!-- Login Wrapper -->
    <div class="container">
        <div class="row justify-content-center no-gutters">
            <!-- Login Card -->
            <div class="col-md-6 col-lg-5">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <img src="../../assets/img/logo.png" alt="Logo" class="logo">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="../../includes/config/validation.php" method="post">
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="username">Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                    <!--register-->
                    <div class="card-footer">
                        <p>Don't have an account? <a href="registration.html">Register here</a></p>
                     </div>
                     
            </div>
           
           
        </div>
       
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>