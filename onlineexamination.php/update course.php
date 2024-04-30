<?php
include('database_connection.php');

// Check if course_Id is set
if (isset($_REQUEST['Course_Id'])) {
    $Course_Id = $_REQUEST['Course_Id'];

    $gms = $connection->prepare("SELECT * FROM course WHERE Course_Id=?");
    $gms->bind_param("i", $Course_Id);
    $gms->execute();
    $result = $gms->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['Id'];
        $c = $row['Name']; // Corrected field name
        $d = $row['Teacher'];
    
    } else {
        echo "Course not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Course form -->
    <h2><u>Update Form of Course</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

<html>
<body>
    <form method="POST">
        <!-- Corrected field names and added missing input type -->
        <label for="id">Id:</label>
        <input type="number" name="Id" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="name"> Name:</label> <!-- Corrected label -->
        <input type="text" name="Name" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="teacher">Teacher:</label> <!-- Corrected label -->
        <input type="text" name="Teacher" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="Course_Id" value="<?php echo isset($Course_Id) ? $Course_Id : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $Course_Id = $_POST['Course_Id'];
    $Course_Name = $_POST['Course_Name']; // Corrected variable name
    $Course_Teacher = $_POST['Course_Teacher']; // Corrected variable name

    // Update the course in the database
    $gms = $connection->prepare("UPDATE courses SET Course_Id=?, Course_Name=?, Course_Teacher=? WHERE Course_Id=?");
    $gms->bind_param("ssdssi", $Id, $Name, $Teacher $course_Id);
    $gms->execute();

    // Redirect to Course.php
    header('Location: Course.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
