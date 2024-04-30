<?php
include('db.php');

// Check if Exam_Id set
if(isset($_REQUEST['Exam_Id'])) {
    $Exam_Id = $_REQUEST['Exam_Id'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM exam WHERE Exam_id=?");
    $gms->bind_param("i", $Exam_id);
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
            <input type="hidden" name="exam_id" value="<?php echo $Exam_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='exam.php'>ok</a>";
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
    echo "Exam_Id is not set.";
}

$connection->close();
?>
