<?php
include('database_connection.php');

// Check if Assignment_Id is set
if (isset($_REQUEST['Assignment_Id'])) {
    $Assignment_Id = $_REQUEST['Assignment_Id'];

    $gms = $connection->prepare("SELECT * FROM assignment WHERE Assignment_Id=?");
    $gms->bind_param("i", $Assignment_Id);
    $gms->execute();
    $result = $gms->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['id'];
        $c = $row['Name']; // Corrected field name
        $d = $row['Course'];
        $e = $row['Title'];
        $f = $row['Deadline']; // Corrected variable name
        $f = $row['Maximum_Score'];
    } else {
        echo "Assignment not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Assignment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Assignment form -->
    <h2><u>Update Form of Assignment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

<html>
<body>
    <form method="POST">
        <!-- Corrected field names and added missing input type -->
        <label for="Id">Id:</label>
        <input type="number" name="Id" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="Name">Name:</label> <!-- Corrected label -->
        <input type="text" name="Name" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="Course">Course:</label> <!-- Corrected label -->
        <input type="text" name="Course" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="Title">Title:</label>
        <input type="text" name="Title" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="Deadline">Deadline:</label>
        <input type="text" name="Deadline" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>

        <label for="Maximumscore">Maximumscore:</label>
        <input type="number" name="Maximumscore" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="Assignment_Id" value="<?php echo isset($Assignment_Id) ? $Assignment_Id : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $Assignment_Id = $_POST['Assignment_Id'];
    $Name = $_POST['Name']; // Corrected variable name
    $Course = $_POST['Course']; // Corrected variable name
    $Title = $_POST['Title']; // Corrected variable name
    $deadline = $_POST['deadline'];
    $Maximumscore = $_POST['Maximumscore'];

    // Update the assignment in the database
    $gms = $connection->prepare("UPDATE Assignment SET Name=?, Course=?, Title=?, Deadline=?, Maximumscore=? WHERE Assignment_Id=?");
    $gms->bind_param("ssdssi", $Name, $Course, $Title, $Deadline, $Maximumscore, $assignment_Id);
    $gms->execute();

    // Redirect to Assignment.php
    header('Location: Assignment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
