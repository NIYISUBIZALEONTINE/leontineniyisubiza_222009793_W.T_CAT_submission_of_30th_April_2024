<?php
include('db.php');

// Check if  Enrollment_Id is set
if(isset($_REQUEST['Enrollment_Id'])) {
    $Enrollment_Id = $_REQUEST['Enrollment_Id'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM enrollment WHERE Enrollment_id=?");
    $gms->bind_param("i", $Enrollment_id);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="enrollment_id" value="<?php echo $Enrollment_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='enrollment.php'>ok</a>";
    } else {
        echo "Error deleting data: " . $gms->error;
    }
    }
?>
</body>
</html>
<?php

    $gms->close();
} else {
    echo "Enrollment_Id is not set.";
}

$connection->close();
?>
