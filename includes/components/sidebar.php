<?php 
if(!isset($_current_page)) {
   $_current_page = basename($_SERVER['PHP_SELF']);
}

// Fetch classes from the database
$stmt = $conn->prepare("SELECT id, subject_name FROM subjects");
$stmt->execute();
$result = $stmt->get_result();
$classes = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!-- desktop sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h5>Menu</h5>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="fas fa-home me-2"></i>
                <span class="ms-2">Home</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle <?php echo ($current_page == 'profile.php' || $current_page == 'add_profile.php') ? 'active' : ''; ?>" data-bs-toggle="dropdown">
                <i class="fas fa-user me-2"></i>
                <span class="ms-2">Profile</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php" class="dropdown-item">
                        <i class="fas fa-eye me-2"></i>View Profile
                    </a>
                </li>
                <li>
                    <a href="edit_profile.php" class="dropdown-item">
                        <i class="fas fa-plus me-2"></i>edit Profile
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="student_contact.php" class="nav-link <?php echo ($current_page == 'student_contact.php') ? 'active' : ''; ?>">
                <i class="fas fa-envelope me-2"></i>
                <span class="ms-2">Contact</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-book me-2"></i>
                <span class="ms-2">Subjects</span>
            </a>
            <ul class="dropdown-menu">
                <?php foreach ($subjects as $subject): ?>
                    <li>
                        <a href="class_selection.php?class_id=<?php echo $subject['id']; ?>" class="dropdown-item">
                            <?php echo htmlspecialchars($subject['subject_name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li>
            <a href="../auth/logout.php" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt me-2"></i>
                <span class="ms-2">Logout</span>
            </a>
        </li>
    </ul>
</nav>

<!-- mobile sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar-mobile">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <i class="fas fa-home me-2"></i>
                    <span class="ms-2">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
                    <i class="fas fa-user me-2"></i>
                    <span class="ms-2">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="student_contact.php" class="nav-link <?php echo ($current_page == 'student_contact.php') ? 'active' : ''; ?>">
                    <i class="fas fa-envelope me-2"></i>
                    <span class="ms-2">Contact</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../auth/logout.php" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    <span class="ms-2">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
