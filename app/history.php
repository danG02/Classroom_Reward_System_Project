<!DOCTYPE html>
<html>
    <head>
        <title>Classroom Reward System</title>
        <link rel="stylesheet" href="add.css">
    </head>
    <body>
    <?php
            session_start();
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
        <h2>Transaction Log</h2>
        <?php
            // Print table data
            $select = "SELECT * FROM transHistory;";
            $result = $dbh->query($select);
            echo "<table>";
            echo " <th>Description</th>";
            while($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr><td>" . htmlspecialchars($row['transactionHist']) . "</td><td>" .  htmlspecialchars($row['description']);
            }
            echo "</table>";
        ?>
    </body>
</html>









