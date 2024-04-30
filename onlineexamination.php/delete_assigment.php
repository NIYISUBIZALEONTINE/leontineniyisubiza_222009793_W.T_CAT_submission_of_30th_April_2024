<?php
include('db.php');

// Check if Assignment_Id is set
if(isset($_REQUEST['Assignment_Id'])) {
    $Assignment_Id = $_REQUEST['Assignment_Id'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM assignment WHERE Assignment_id=?");
    $gms->bind_param("i", $Assignment_id);
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
            <input type="hidden" name="assignment_id" value="<?php echo $Assignment_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='assignment.php'>ok</a>";
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
    echo "Assignment_Id is not set.";
}

$connection->close();
?>
