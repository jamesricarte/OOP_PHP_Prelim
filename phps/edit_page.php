<?php 
    require_once('database.php');

    session_start();

    $name = $_SESSION["name"];
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];
    $datetime = $_SESSION["datetime"];

    $formattedDate = date('Y-m-d', strtotime($datetime));

    $tableSearch = $formattedDate . "_". $username . "_table";

    $_SESSION["table_name"] = $tableSearch;
    $tableName = $_SESSION["table_name"];

    $userTable = "SELECT * FROM `$tableName`";
        $result = mysqli_query($conn,  $userTable);
        $row = $result->fetch_assoc();

    if ($row == true) {
        $id = $row["id"];
        $nameTable = $row["name"];
        $course = $row["course"];
        $block = $row["block"];
        $date = $row["datetime"];
        $formattedDateFromDateTable = date('Y-m-d', strtotime($date));
    } else {
        $formattedDateFromDateTable = $formattedDate;
    };
?>

<?php 
        $editRowId = $_POST["row_id"];
    
        $selectQuery = "SELECT * FROM `$tableName` WHERE id = $editRowId";
        $result2 = $conn->query($selectQuery);
        $row2 = $result2->fetch_assoc();
        
        $nameedit = $row2["name"];
        $courseedit = $row2["course"];
        $blockedit = $row2["block"];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracking System | Dashboard</title>
    <link rel="stylesheet" href="../css/default-style.css">
    <link rel="stylesheet" href="../css/edit-page-style.css">
</head>
<body>
    <nav>
        <div class="left-section">
            <h2 class="logo">Attendance Tracking System</h2>
            <p class="date"><?php echo $formattedDateFromDateTable; ?></p>
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
        
    <section class="edit-pop-section">
    <div class="edit-popup">
            <form action="edit_row.php" method="post">
                <div class="profile-icon">

                </div>

                <div class="info-section">
                    <div class="container">
                        <p class="label">Name:</p>
                        <input type="hidden" name="row_id" value="<?php echo $editRowId;?>">
                        <input type="text" name="name" value="<?php echo $nameedit;?>">
                    </div>

                    <div class="container">
                        <p class="label">Course:</p>
                        <input type="text" name="course" value="<?php echo $courseedit;?>">
                    </div>

                    <div class="container">
                        <p class="label">Block:</p>
                        <input type="text" name="block" maxlength="1" value="<?php echo $blockedit;?>">
                    </div>
                </div>

                <button type="submit" class="update-button">update</button>
            </form>
            
        </div>
    </section>
<script src="../scripts/edit-page.js"></script>
</body>
</html>