<?php
require_once('database.php');

session_start();

$primaryKey = $_POST["row_id"];
$name = $_POST["name"];
$course = $_POST["course"];
$block = $_POST["block"];
$tableName = $_SESSION["table_name"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateQuery = "UPDATE `$tableName` SET name='$name', course='$course', block='$block' WHERE id=$primaryKey";
    $result = $conn->query($updateQuery);
    
    if ($result) {
        echo "success";
        $_SESSION["updateStatus"] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        echo "error";
    }
}
?>
