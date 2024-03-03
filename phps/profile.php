<?php 
require_once('database.php');

session_start();

if (isset($_SESSION["name"]) && isset($_SESSION["username"]) && isset($_SESSION["email"]) && isset($_SESSION["datetime"])) {
    $name = $_SESSION["name"];
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];
    $datetime = $_SESSION["datetime"];
} else {
    header('Location: ../index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracking System | Dashboard</title>
    <link rel="stylesheet" href="../css/default-style.css">
    <link rel="stylesheet" href="../css/profile-style.css">
</head>
<body>
    <nav>
        <div class="left-section">
            <h2 class="logo">Attendance Tracking System</h2>
            <p class="date">Feb 27, 2024</p>
        </div>

        <div class="right-section">
            <p class="user-name"><?php echo $name; ?></p>
            <div class="profile-icon">
                <h3><?php echo substr($name, 0, 1) ?></h3>
            </div>

            <div class="profile-dropdown">
                <a href="profile.php">
                    <div class="profile-link">
                        <div class="profile-icon">
                            <h3><?php echo substr($name, 0, 1) ?></h3>
                        </div>
                        <p class="user-name"><?php echo $name; ?></p>
                    </div>
                </a>
                <a class="dashboard-link" href="dashboard.php"><h5 >Dashboard</h5></a>
                <form action="" method="post">
                    <input class="logout-button" type="submit" name="logout" value="logout" >
                </form>

                <?php 
                    if(isset($_POST["logout"])) {
                        session_destroy();

                        echo "<script>alert('Logout Successfully');
                            window.location.href = '../index.php';
                        </script>";
                    }
                ?>            
            </div>
        </div>
    </nav>

    <section class="profile-section">
        <div class="profile-container">
            <div class="profile-icon">
                <h3><?php echo substr($name, 0, 1) ?></h3>
            </div>

            <div class="info-section">
                <div class="container">
                    <p class="label">Name:</p>
                    <p class="value"><?php echo $name; ?></p>
                </div>

                <div class="container">
                    <p class="label">Username:</p>
                    <p class="value"><?php echo $username; ?></p>
                </div>

                <div class="container">
                    <p class="label">Email:</p>
                    <p class="value"><?php echo $email; ?></p>
                </div>

                <div class="container">
                    <p class="label">Bio:</p>
                    <p class="value bio">Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit, sed do eiusmod tempor incididunt ut labore 
                    et dolore magna aliqua.</p>
                </div>
            </div>

            <button class="edit-button">Edit Profile</button>
        </div>
    </section>

    <script src="../scripts/profile.js"></script>
</body>
</html>