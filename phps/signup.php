<?php 
    session_start();

    if (isset($_SESSION["validName"]) && $_SESSION["validName"] == false) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {

                        setTimeout(function() {
                            document.querySelector('.name').style.border = '2px solid #E08F8F';
                            document.querySelector('.required-prompt.name').style.opacity = '1';
                        }, 300);
                        

                    });
                </script>";
    }

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

    if (isset($_SESSION["validEmail"]) && $_SESSION["validEmail"] == false) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(function() {
                            document.querySelector('.email').style.border = '2px solid #E08F8F';
                            document.querySelector('.required-prompt.email').style.opacity = '1';
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
    
    session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracking System | Sign Up</title>
    <link rel="stylesheet" href="../css/default-style.css">
    <link rel="stylesheet" href="../css/signup-style.css">
</head>
<body>
    <nav>
        <h2 class="logo">Attendance Tracking System</h2>
        <div class="login-signup-section">
            <a href="../index.php"><h5 class="login-button">Log in</h5></a>
            <a href="signup.php"><button class="signup-button">Sign Up</button></a>
        </div>
    </nav>

    <section class="login-form-section">
        <div class="login-form">
            <h4>Attendance Tracking System</h4>
            <p>Sign Up Account to use Attendance Tracking System</p>

            <form action="insert.php" method="post">
                <input class="name" type="name" placeholder="Name" name="name">
                <p class="required-prompt name">Required Fields</p>
                <input class="username" type="username" placeholder="Username" name="username">
                <p class="required-prompt username">Required Fields</p>
                <input class="email" type="email" placeholder="Email" name="email">
                <p class="required-prompt email">Required Fields</p>
                <input class="password" type="password" placeholder="Password" name="password">
                <p class="required-prompt password">Required Fields</p>
                <input type="submit" name="signup" value="Sign Up">
            </form>

            <a href="../index.php">Log in Account</a>
        </div>
    </section>

    <div class="successfull-prompt">
        <h5 class="registration-successful">Successfully created your account.</h5>
        <p class="status-info">Log in now</p>
    </div>

    <div class="invalid-prompt">
        <h5 class="invalid-input">Invalid Credentials.</h5>
        <p class="status-info">There something wrong with your inputs</p>
    </div>

</body>
</html>