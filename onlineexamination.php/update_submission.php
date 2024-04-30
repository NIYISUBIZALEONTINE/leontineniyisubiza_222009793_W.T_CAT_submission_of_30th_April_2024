<?php
include('database_connection.php');

// Check if Submission_Id is set
if (isset($_REQUEST['Submission_Id'])) {
    $Exam_Id = $_REQUEST['Submission_Id'];

    $gms = $connection->prepare("SELECT * FROM submission WHERE Submission_Id=?");
    $gms->bind_param("i", $Submission_Id);
    $gms->execute();
    $result = $gms->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['Id'];
        $b = $row['User'];
        $c = $row['Assignment']; // Corrected field name
        $d = $row['Exam'];
        $e = $row['Time'];
        $f = $row['Score']; // Corrected variable name
    } else {
        echo "Submission not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Submission</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Submission form -->
    <h2><u>Update Form of Submission</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

<html>
<body>
    <form method="POST">
        <!-- Corrected field names and added missing input type -->
        <label for="Id">Id:</label>
        <input type="number" name="Id" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="user">User:</label>
        <input type="text" name="User" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="assignment">Assignment:</label> <!-- Corrected label -->
        <input type="text" name="Assignment" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="exam">Exam:</label> <!-- Corrected label -->
        <input type="text" name="Exam" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="time">Time:</label>
        <input type="text" name="Time" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="score">Score:</label>
        <input type="text" name="Score" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="Submission_Id" value="<?php echo isset($Submission_Id) ? $Submission_Id : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $Submission_Id = $_POST['Submission_Id'];
    $Submission_User = $_POST['Submission_User']; // Corrected variable name
    $Submissiion_Assignment = $_POST['Submission_Assignment']; // Corrected variable name
    $Submission_Exam = $_POST['Submission_Exam']; // Corrected variable name
    $Submission_Time = $_POST['Submission_Time'];
    $Submission_Score = $_POST['Submission_Score'];

    // Update the Submission in the database
    $gms = $connection->prepare("UPDATE submission SET User=?, Assignment=?, Exam=?, Time=?, Score=? WHERE Submission_Id=?");
    $gms->bind_param("ssdssi", $User, $Assignment, $Exam, $Time, $Score, $Submission_Id);
    $gms->execute();

    // Redirect to Submission.php
    header('Location: Submission.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>