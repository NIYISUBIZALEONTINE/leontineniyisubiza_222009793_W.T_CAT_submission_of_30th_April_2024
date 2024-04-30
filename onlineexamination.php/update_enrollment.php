<?php
include('database_connection.php');

// Check if enrollment_Id is set
if (isset($_REQUEST['Enrollment_Id'])) {
    $Course_Id = $_REQUEST['Enrollment_Id'];

    $gms = $connection->prepare("SELECT * FROM enrollment WHERE Enrollment_Id=?");
    $gms->bind_param("i", $Enrollment_Id);
    $gms->execute();
    $result = $gms->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['Id'];
        $c = $row['User']; // Corrected field name
        $d = $row['Course'];
    
    } else {
        echo "Enrollment not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Enrollment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Enrollment form -->
    <h2><u>Update Form of Enrollment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

<html>
<body>
    <form method="POST">
        <!-- Corrected field names and added missing input type -->
        <label for="id">Id:</label>
        <input type="number" name="Id" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="user"> User:</label> <!-- Corrected label -->
        <input type="text" name="User" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="Course">Course:</label> <!-- Corrected label -->
        <input type="text" name="Course" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="Enrollment_Id" value="<?php echo isset($Enrollment_Id) ? $Enrollment_Id : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $Enrollment_Id = $_POST['Enrollment_Id'];
    $User = $_POST['Enrollment_User']; // Corrected variable name
    $Course = $_POST['Enrollment_Course']; // Corrected variable name

    // Update the enrollment in the database
    $gms = $connection->prepare("UPDATE enrollments SET Enrollment_user=?, Enrollment_Course=? WHERE Enrollment_Id=?");
    $gms->bind_param("ssdssi", $User, $Course $Enrollment_Id);
    $gms->execute();

    // Redirect to Enrollment.php
    header('Location: Enrollment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
