<?php
include('database_connection.php');

// Check if Grade_Id is set
if (isset($_REQUEST['Grade_Id'])) {
    $Grade_Id = $_REQUEST['Grade_Id'];

    $gms = $connection->prepare("SELECT * FROM grade WHERE Grade_Id=?");
    $gms->bind_param("i", $Grade_Id);
    $gms->execute();
    $result = $gms->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['Id'];
        $b = $row['User'];
        $c = $row['Assignment']; // Corrected field name
        $d = $row['Exam'];
    } else {
        echo "Grade not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Grade</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Grade form -->
    <h2><u>Update Form of Grade</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

<html>
<body>
    <form method="POST">
        <!-- Corrected field names and added missing input type -->
        <label for="id">Id:</label>
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
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="Grade_Id" value="<?php echo isset($Grade_Id) ? $Grade_Id : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $Grade_Id = $_POST['Grade_Id'];
    $Grade_User = $_POST['Grade_User']; // Corrected variable name
    $Grdae_Assignment = $_POST['Grdae_Assignment']; // Corrected variable name
    $Grade_Exam = $_POST['Grade_Exam']; // Corrected variable name

    // Update the grade in the database
    $gms = $connection->prepare("UPDATE grade SET User=?, Assignment=?, Exam=?, WHERE Grade_Id=?");
    $gms->bind_param("ssdssi", $User, $Assignment, $Exam, $Grade_Id);
    $gms->execute();

    // Redirect to Grade.php
    header('Location: Grade.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>