<?php 
     session_start();

     if (isset($_SESSION["validUsername"]) && $_SESSION["validUsername"] == false) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {

                        setTimeout(function() {
                            document.querySelector('.username').style.border = '2px solid #E08F8F';
                            document.querySelector('.required-prompt.username').style.opacity = '1';
                        }, 300);
                    });
                </script>";
    }

    if (isset($_SESSION["validPassword"]) && $_SESSION["validPassword"] == false) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {

                        setTimeout(function() {
                            document.querySelector('.password').style.border = '2px solid #E08F8F';
                            document.querySelector('.required-prompt.password').style.opacity = '1';
                        }, 300);
                    });
                </script>";
    }

     if (isset($_SESSION["query"]) && $_SESSION["query"]) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(function() {
                            document.querySelector('.successfull-prompt').style.top = '10%';
                        }, 200);
                    });
                </script>";
    } else if (isset($_SESSION["query"]) && !$_SESSION["query"]) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {

                        setTimeout(function() {
                            document.querySelector('.invalid-prompt').style.top = '10%';
                        }, 200);
                    });
                </script>";
    }
    
    if (isset($_SESSION["name"]) && isset($_SESSION["username"]) && isset($_SESSION["email"]) && isset($_SESSION["datetime"])) {
        $name = $_SESSION["name"];
        $username = $_SESSION["username"];
        $email = $_SESSION["email"];
        $datetime = $_SESSION["datetime"];
    }
   
    if(isset($_SESSION["query"])) {
        $queryStatus = $_SESSION["query"];
    };
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracking System | Log In</title>
    <link rel="stylesheet" href="css/default-style.css">
    <link rel="stylesheet" href="css/index-style.css">
</head>
<body>
    <nav>
        <h2 class="logo">Attendance Tracking System</h2>
        <div class="login-signup-section">
            <a href="index.php"><h5 class="login-button">Log in</h5></a>
            <a href="phps/signup.php"><button class="signup-button">Sign Up</button></a>
        </div>
    </nav>

    <section class="login-form-section">
        <div class="login-form">
            <h4>Attendance Tracking System</h4>
            <p>Log in to use Attendance Tracking System</p>

            <form action="phps/authentication.php" method="post">
                <input class="username" type="username" placeholder="Username" name="username">
                <p class="required-prompt username">Required Fields</p>
                <input class="password" type="password" placeholder="Password" name="password">
                <p class="required-prompt password">Required Fields</p>
                <input type="submit" name="login" value="Log in">
            </form>

            <a href="phps/signup.php">Sign Up Account</a>
        </div>
    </section>

    <div class="successfull-prompt">
        <h5 class="login-successful">Log in successful!</h5>
        <p class="status-info">Redirecting now to your dashboard...</p>
    </div>

    <div class="invalid-prompt">
        <h5 class="invalid-input">Invalid username and password.</h5>
        <p class="status-info">Please check your inputs carefully</p>
    </div>

    <?php 
        if (isset($queryStatus) && $queryStatus == true) {
            
            session_start();
            
            $_SESSION["name"] = $name;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["datetime"] = $datetime;

            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'phps/dashboard.php';
                     }, 1000);
                </script>";
        }
    ?>
</body>
</html>