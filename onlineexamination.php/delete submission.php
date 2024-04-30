<?php
include('database_connection.php');

// Check if submission_Id is set
if(isset($_REQUEST['Submission_Id'])) {
    $Submission_id = $_REQUEST['Submission_Id'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM submission WHERE Submission_Id=?");
    $gms->bind_param("i", $Submission_id);

    // Execute the DELETE statement
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($gms->execute()) {
            echo "Record deleted successfully.<br><br>
            <a href='Submission.php'>OK</a>";
        } else {
            echo "Error deleting data: " . $gms->error;
        }
        $gms->close();
        exit(); // Ensure no other content is sent after redirection
    }
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
        <input type="hidden" name="Submission_Id" value="<?php echo $Submission_id; ?>">
        <input type="submit" value="Submission_id">
    </form>
</body>
</html>

<?php
} else {
    echo "Submission_Id is not set.";
}

$connection->close();
?>