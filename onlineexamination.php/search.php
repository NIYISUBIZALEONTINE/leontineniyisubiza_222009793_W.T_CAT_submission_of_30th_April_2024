<?php
include('database_connection.php');

if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query
    $sql = "SELECT * FROM users WHERE User_Id LIKE '%$searchTerm%'";
    $result_user = $connection->query($sql);

    // Search in the course table
    $sql = "SELECT * FROM course WHERE Name LIKE '%$searchTerm%'";
    $result_course = $connection->query($sql);

    // Search in the Assignments table
    $sql = "SELECT * FROM assignments WHERE Course LIKE '%$searchTerm%'";
    $result_Assignment = $connection->query($sql);

    // Search in the Exam table
    $sql = "SELECT * FROM exam WHERE Name LIKE '%$searchTerm%'";
    $result_Exam = $connection->query($sql);

    // Search in the Enrollment table
    $sql = "SELECT * FROM enrollment WHERE User LIKE '%$searchTerm%'";
    $result_Enrollment = $connection->query($sql);

    // Search in the Submission table
    $sql = "SELECT * FROM submission WHERE Assignment LIKE '%$searchTerm%'";
    $result_submission = $connection->query($sql);

    // Search in the Grade table
    $sql = "SELECT * FROM grade WHERE Exam LIKE '%$searchTerm%'";
    $result_grade = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>Users:</h3>";
    if ($result_user->num_rows > 0) {
        while ($row = $result_user->fetch_assoc()) {
            echo "<p>" . $row['User_Id'] . "</p>";
        }
    } else {
        echo "<p>No users found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Courses:</h3>";
    if ($result_course->num_rows > 0) {
        while ($row = $result_course->fetch_assoc()) {
            echo "<p>" . $row['Name'] . "</p>";
        }
    } else {
        echo "<p>No course found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Assignments:</h3>";
    if ($result_Assignment->num_rows > 0) {
        while ($row = $result_Assignment->fetch_assoc()) {
            echo "<p>" . $row['Course'] . "</p>";
        }
    } else {
        echo "<p>No assignment found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Exam:</h3>";
    if ($result_Exam->num_rows > 0) {
        while ($row = $result_Exam->fetch_assoc()) {
            echo "<p>" . $row['Name'] . "</p>";
        }
    } else {
        echo "<p>No exam found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Enrollment:</h3>";
    if ($result_Enrollment->num_rows > 0) {
        while ($row = $result_Enrollment->fetch_assoc()) {
            echo "<p>" . $row['User'] . "</p>";
        }
    } else {
        echo "<p>No enrollment found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Submissions:</h3>";
    if ($result_Submission->num_rows > 0) {
        while ($row = $result_Submission->fetch_assoc()) {
            echo "<p>" . $row['Assignment'] . "</p>";
        }
    } else {
        echo "<p>No submission found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Grade:</h3>";
    if ($result_grade->num_rows > 0) {
        while ($row = $result_grade->fetch_assoc()) {
            echo "<p>" . $row['Exam'] . "</p>";
        }
    } else {
        echo "<p>No grade found matching the search term: " . $searchTerm . "</p>";
    }

    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
