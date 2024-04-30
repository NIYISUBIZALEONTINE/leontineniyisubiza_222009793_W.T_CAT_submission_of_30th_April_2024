<!DOCTYPE html>
<html>
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About the System</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: blue;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color:blue;
    }
    /* Unvisited link */
    a:link {
      color: green; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: yellow;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */
      padding: 8px;  
    }
    header{
  background-color: #4567;
  padding: 20px;
}
    section{
      padding:32px;
    }
    footer{
  background-color: #4567;
  padding: 20px;
}

  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>

  </head>

  <header>

</head>
<header>
<body bgcolor="yellow"><br>

  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>

  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./image/wolves.jpg" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./assigment.php">assigment</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./course.php">course</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./enrollment.php">enrollment</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./exam.php">exam</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./submission.php">submission</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./grade.php">grade</a></li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: greenblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
  </ul>
</header>

  <section>
    <h1>Grade Form</h1>
     <form method="post" onsubmit="return confirmInsert();">
      <form method="post" action="Grade.php">
        <label for="id"> Id:</label>
        <input type="number" id="id" name="id" required><br><br>

        <label for="user">user:</label>
        <input type="text" id="user" name="user" required><br><br>

        <label for="assignment">assignment:</label>
        <input type="text" id="assignment" name="assignment" required><br><br>

        <label for="exam">exam:</label>
        <input type="text" id="exam" name="exam" required><br><br>

        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>

    </form>

    <?php
    include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $gms = $connection->prepare("INSERT INTO grade(Id, user, assignment, exam) VALUES (?, ?, ?, ?)");
        $gms->bind_param("isssss", $id, $user, $assignment, $exam);

        // Set parameters from POST and execute
        $id = $_POST['id'];
        $user = $_POST['user'];
        $assignment = $_POST['assignment'];
        $exam = $_POST['exam'];
        if ($gms->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='grade.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $gms->error;
        }

        $gms->close();
    } 
    ?>

    <center><h2>Table of grade</h2></center>
    <table>
        <tr>
            <th>Id</th>
            <th>User</th>
            <th>Assignment</th>
            <th>Exam</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php
        include('db.php');
        // SQL query to fetch data from the grade table
        $sql = "SELECT * FROM grade";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $Empid = $row["Id"];
                echo "<tr>
                    <td>" . $row["Id"] . "</td>
                    <td>" . $row["user"] . "</td>
                    <td>" . $row["assignment"] . "</td> 
                    <td>" . $row["exam"] . "</td>
                    <td><a style='padding:4px' href='delete_grade.php?Id=$id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_grade.php?Id=$id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>

    <footer>
        <marquee> 
            <b><h2>UR CBE BIT &copy; 2024 &reg; 222009793, Designed by: NIYISUBIZA Leontine</h2></b>
        </marquee>
    </footer>
</body>
</html>

