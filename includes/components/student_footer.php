<?php
//ensure session is started
if(session_status () === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- student footer -->
<footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Maradock</h5>
                <p>Your one-stop student hub for managing courses, assignments, and academic progress.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="../../index.php" class="text-light">Home</a></li>
                    <li><a href="../../credit.php" class="text-light">Credits</a></li>
                    <li><a href="../../contact.php" class="text-light">Contact</a></li>
                </ul>
            </div>

            <!--contact us-->
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>123 Education Street, Learning City, 12345</p>
                <p>
                    <i class="fas fa-envelope me-2"></i>
                    support@maradock.edu
                </p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-center">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Maradock. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
