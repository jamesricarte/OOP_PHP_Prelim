<?php 
    require_once('database.php');

    $name = mysqli_real_escape_string($conn, $_POST["name"]) ;
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $validName = '';
    $validUsername = '';
    $validEmail = '';
    $validPassword = '';

    if (isset($_POST["signup"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

        session_start();

        if ($name != "" || !empty($name)) {
            $validName = true;
            $_SESSION["validName"] = $validName;
        } else {
            $validName = false;
            $_SESSION["validName"] = $validName;
        }

        if ($username != "" || !empty($username)) {
            $validUsername = true;
            $_SESSION["validUsername"] = $validUsername;

        } else {
            $validUserName = false;
            $_SESSION["validUsername"] = $validUsername;
        }
        
        if ($email != "" || !empty($email)) {
            $validEmail = true;
            $_SESSION["validEmail"] = $validEmail;
        } else {
            $validEmail = false;
            $_SESSION["validEmail"] = $validEmail;
        }

        if ($password != "" || !empty($password)) {
            $validPassword = true;
            $_SESSION["validPassword"] = $validPassword;
        } else {
            $validPassword = false;
            $_SESSION["validPassword"] = $validPassword;
        }

        if ($validName && $validUsername && $validEmail && $validPassword) {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (name, username, email, password, datetime)
                        VALUES (?, ?, ?, ?, NOW())";

            $stmt = $conn->prepare($query);

            $stmt->bind_param("ssss", $name, $username, $email, $hashed_password);
            $result = $stmt->execute();

            if ($result) {
                $_SESSION["query"] = true;

                //NOT PREPARED STATEMENT!
                $queryForTable = "SELECT * FROM users WHERE username='$username'";
                $created = $conn->query( $queryForTable);

                if($created) {
                    $row = $created->fetch_assoc();
                    $datetime = $row['datetime'];

                    $formattedDate = date('Y-m-d', strtotime($datetime));

                    $tableName = "`$formattedDate" . "_" . "$username" . "_table`";
                    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS $tableName (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(255),
                        course VARCHAR(255),
                        block VARCHAR(1),
                        attendance VARCHAR(1),
                        datetime DATETIME
                        
                        )";
                    $createTable = $conn->query($sqlCreateTable);

                    if (!$createTable) {
                        echo "Error adding table";
                    }
                }
            } else {
                $_SESSION["query"] = false;
            }   

            
        } else {
            $_SESSION["query"] = false;
        }

        $conn->close();
        header('Location: signup.php');
        exit;
    }
?>