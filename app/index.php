<!DOCTYPE html>
<html>
    <head>
        <title>Classroom Reward System</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php

            //session_start();
            //if($_SESSION["loggedIn"] != true){
            //    echo 'Not logged in';
            //    header("Location: login.php");
            //    exit;
            //}
            // Code From Dr. Paul
            //$dsn = 'mysql:host=localhost;dbname=Final Project 370';
            //$username = 'root';
            //$password = '';
            //$pdo = new PDO($dsn, $username, $password);
            //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // May need Plugin in MySQL Workbench ?
            $host = "localhost";
            $port = 3306;
            $socket = "";
            $user = "root";
            $password = "";
            $dbname = "classroomsystems";
            
            try {
                $dbh = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        ?>
        <h1 id="main_title"><a href="index.php">Classroom Reward System</a></h1>
        <h1>Welcome --Username--</h1>
        <h2>Here is your classroom Roster!</h2>
        <a href="add.php" class="butn">Add Student</a>
        <a href="delete.php" class="butn">Delete Student</a>
        <a href="history.php" class="butn">View History</a>
        <a href="points.php" class="butn">Add/Remove Points</a>
        <?php
            // Print table data
            $select = "SELECT * FROM studentInfo;";
            $result = $dbh->query($select);
            echo "<table>";
            echo " <th>Full Name</th> <th>ID</th> <th>Currency</th>";
            while($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr><td>" . htmlspecialchars($row['studentInfoName']) . "</td><td>" .  htmlspecialchars($row['studentID']) . "</td><td>" . htmlspecialchars($row['currency']) . "</td><td>";
            }
            echo "</table>";
        ?>
    </body>
</html>