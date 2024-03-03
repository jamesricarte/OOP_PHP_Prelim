<?php 
    require_once('database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $validUsername = '';
        $validPassword = '';

        session_start();

        if ($username != "" || !empty($username)) {
            $validUsername = true;
            $_SESSION["validUsername"] = $validUsername;
        } else {
            $validUsername = false;
            $_SESSION["validUsername"] = $validUsername;
        }

        if ($password != "" || !empty($password)) {
            $validPassword = true;
            $_SESSION["validPassword"] = $validPassword;
        } else {
            $validPassword = false;
            $_SESSION["validPassword"] = $validPassword;
        }

        if ($validUsername && $validPassword) {
            $query = "SELECT name, username, email, password, datetime FROM users WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($name, $usernameResult, $email, $stored_hashed_password, $datetime);
    
            if ($stmt->fetch()) {
                if (password_verify($password, $stored_hashed_password)) {
                    echo "Login successful!";
    
                    $_SESSION["query"] = true;

                    $_SESSION["name"] = $name;
                    $_SESSION["username"] = $usernameResult;
                    $_SESSION["email"] = $email;
                    $_SESSION["datetime"] = $datetime;
    
                } else {
                    echo "Invalid password!";
    
                    $_SESSION["query"] = false;
    
                }
            } else {
                echo "User not found!";
    
                $_SESSION["query"] = false;
            }
        } else {
            $_SESSION["query"] = false;
        }
       
    }

    $conn->close();
    header('Location: ../index.php');
    exit;
?>