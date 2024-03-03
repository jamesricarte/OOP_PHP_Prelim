<?php
require_once('database.php');

session_start();

$rowId = $_POST["row_id"];
$tableName = $_SESSION["table_name"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['row_id'])) {
        $rowId = $_POST['row_id'];
    
        $sql = "DELETE FROM `$tableName` WHERE id = '$rowId'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION["deletionSuccess"] = true;
            echo "Record deleted successfully";
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

?>