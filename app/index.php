<!DOCTYPE html>
<html>
    <head>
        <title>ClassRoom Monopoly</title>
    </head>
    <body>
        <?php
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
            $dbname = "classroomsystem";
            
            try {
                $dbh = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        ?>
        <h1>Welcome --Username--</h1>
        <h2>Here is your classroom list</h2>
        <?php
            // Print table data
            $select = "SELECT * FROM studentInfo;";
            $result = $dbh->query($select);
            echo "<table>";
            while($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr><td>" . htmlspecialchars($row['studentInfoName']) . "</td><td>";
            }
            echo "</table>";
        ?>
    </body>
</html>