<!DOCTYPE html>
<html>
    <head>
        <title>Classroom Reward System</title>
        <link rel="stylesheet" href="add.css">
    </head>
    <body>
    <h1 id="main_title"><a href="index.php">Classroom Reward System</a></h1>
        <h2>Add a student to the list!</h2>
        <form method="get">
            <label for="studentInfoName">Full Name:</label><br>
            <input type="text" name="studentInfoName"><br>
            <label for="studentID">Id:</label><br>
            <input type="text" name="studentID"><br>
            <label for="currency">Currency:</label><br>
            <input type="text"  name="currency"><br>
            <input type="submit" value="Submit">
        </form>
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
            // Inserting the data
            if(isset($_GET['studentInfoName'])) 
            {
                $sql = 'INSERT INTO studentInfo '.
                                '(studentInfoName, studentID, currency) '.
                                'VALUES (?, ?, ?);';
                $statement = $dbh->prepare($sql);
                $statement->bindValue(1, $_GET['studentInfoName']);
                $statement->bindValue(2, $_GET['studentID']);
                $statement->bindValue(3, $_GET['currency']);
                try{
                    $ret = $statement->execute();
                }catch(Exception $e){
                    echo "Insert error: ", $e->getMessage();
                }
                echo "<h1>You have successfully added a student!</h1>";
            }
        ?>
    </body>
</html>









