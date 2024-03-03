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
    if (isset($_SESSION["deletionSuccess"])) {
        if ($_SESSION["deletionSuccess"] == true) {
            echo "<script>
                alert('Deletion Successfully')
            </script>";
    
            $_SESSION["deletionSuccess"] = null;
        } else if ($_SESSION["deletionSuccess"] === false) {
            echo "<script>
                alert('Error deleting')
            </script>";
        }
    }  
?>

<?php 
    if (isset($_SESSION["addRowSucess"])) {
        if ($_SESSION["addRowSucess"] == true) {
            echo "<script>
                alert('Added Row Successfully')
            </script>";
    
            $_SESSION["addRowSucess"] = null;
        } else if ($_SESSION["addRowSucess"] === false) {
            echo "<script>
                alert('Error adding row')
            </script>";
        }
    }  
?>

<?php 
    if (isset($_SESSION["updateStatus"])) {
        if ($_SESSION["updateStatus"] == true) {
            echo "<script>
                alert('Update Row Successfully')
            </script>";
    
            $_SESSION["updateStatus"] = null;
        } else if ($_SESSION["updateStatus"] === false) {
            echo "<script>
                alert('Error Updating row!')
            </script>";
        }
    }  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracking System | Dashboard</title>
    <link rel="stylesheet" href="../css/default-style.css">
    <link rel="stylesheet" href="../css/dashboard-style.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
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

    <section class="control-section">
        <div class="control-container">
            <div class="control-list">
                <div class="course-container">
                    <h4>Course</h4>
                    <select name="" id="">
                        <option value="">BSIT</option>
                        <option value="">BSCS</option>
                    </select>
                </div>
                <div class="year-container">
                    <h4>Year</h4>
                    <select name="" id="">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                    </select>
                </div>
                <div class="block-container">
                    <h4>Block</h4>
                    <select name="" id="">
                        <option value="">A</option>
                        <option value="">B</option>
                        <option value="">C</option>
                        <option value="">D</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <section class="attendance-sheet-section">
        <div class="attendance-sheet-container">
            <h3>Attendance Sheet</h3>
                <table class="js-table" id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Course and Year</td>
                            <td>Block</td>
                            <td>Attendance</td>
                            <td>Controls</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td class='name-td'>" . $row['name'] . "</td>";
                            echo "<td><input type='text' name='course[]' value='" . $row['course'] . "'></td>";
                            echo "<td><input type='text' name='block[]' value='" . $row['block'] . "' maxlength='1'></td>";
                            echo "<td><input type='checkbox' name='attendance[]' " . ($row['attendance'] == 1 ? 'checked' : '') . "></td>";
                            echo "<td>";

                            echo "<form method='post' action='view.php'>";
                            echo "<input type='hidden' name='row_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' class='view-button'>View</button>";
                            echo "</form>";

                            echo "<form method='post' action='edit_page.php'>";
                            echo "<input type='hidden' name='row_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' class='edit-button'>Edit</button>";
                            echo "</form>";

                            echo "<form method='post' action='delete_row.php'>";
                            echo "<input type='hidden' name='row_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' class='delete-button'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                ?>
                    </tbody>
                </table>

            <button class="add-member-button" id="addRowBtn">Add Row</button> <br>
            <button class="export-table-button" id="print-all">Export Attendance</button>
        </div>

        <div class="add-popup">
            <form action="add-list.php" method="post">
                <div class="profile-icon">
                </div>

                <div class="info-section">
                    <div class="container">
                        <p class="label">Name:</p>
                        <input type="text" name="name">
                    </div>

                    <div class="container">
                        <p class="label">Course:</p>
                        <input type="text" name="course">
                    </div>

                    <div class="container">
                        <p class="label">Block:</p>
                        <input type="text" name="block" maxlength="1">
                    </div>
                </div>

                <button type="submit" class="update-button">Add Row</button>
            </form>
            
        </div>

        <div class="edit-popup">
            <form action="edit-list.php" method="post">
                <div class="profile-icon">
                </div>

                <div class="info-section">
                    <div class="container">
                        <p class="label">Name:</p>
                        <input type="text" name="name">
                    </div>

                    <div class="container">
                        <p class="label">Course:</p>
                        <input type="text" name="course">
                    </div>

                    <div class="container">
                        <p class="label">Year:</p>
                        <input type="text" name="year" maxlength="1">
                    </div>
                </div>

                <button type="submit" class="edit-add-button">update</button>
            </form>
            
        </div>

        <div class="view-popup">
        <div class="profile-icon">
                <h3>J</h3>
            </div>

            <div class="info-section">
                <div class="container">
                    <p class="label">Name:</p>
                    <p class="value">James Mickel C. Ricarte</p>
                </div>

                <div class="container">
                    <p class="label">Course:</p>
                    <p class="value">BSIT</p>
                </div>

                <div class="container">
                    <p class="label">Year:</p>
                    <p class="value">1</p>
                </div>

                <div class="container">
                    <p class="label">Attendance:</p>
                    <p class="value">Present</p>
                </div>
            </div>

            <button class="back-button">Back</button>
        </div>
    </section>


    <script src="../scripts/dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );
    </script>
</body>
</html>