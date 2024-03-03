<?php 
    require_once('database.php');

    session_start();

    $name = $_SESSION["name"];
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];
    $datetime = $_SESSION["datetime"];
    $tableName = $_SESSION["table_name"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputName = $_POST['name'];
        $inputCourse = $_POST['course'];
        $inputYear = $_POST['block'];
    
        // Escape the data to prevent SQL injection
        $escapedName = $conn->real_escape_string($inputName);
        $escapedCourse = $conn->real_escape_string($inputCourse);
        $escapedYear = $conn->real_escape_string($inputYear);
    
        // Perform the database insertion
        $sql = "INSERT INTO `$tableName` (name, course, block) VALUES ('$escapedName', '$escapedCourse', '$escapedYear')";
    
        if ($conn->query($sql) === TRUE) {
            $_SESSION["addRowSucess"] = true;
            echo "Record inserted successfully<br>";
            header('Location: dashboard.php'); // Redirect to the dashboard or another page after successful insertion
            exit;
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    }
?>