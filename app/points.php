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
            <label for="description">Description: </label><br>
            <input type="text" name="description"><br>
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
                $sql = "UPDATE studentInfo SET currency = '" . $_GET["currency"] . "' WHERE studentInfoName = '" . $_GET["studentInfoName"] . "' ";
                $statement = $dbh->prepare($sql);
                try{
                    $ret = $statement->execute();
                }catch(Exception $e){
                    echo "Insert error: ", $e->getMessage();
                }
            }
            // Inserting the data
            if(isset($_GET['description'])) 
            {
                $sql2 = 'INSERT INTO transHistory '.
                '(description) '.
                'VALUES (?);';
                $statement1 = $dbh->prepare($sql2);
                $statement1->bindValue(1, $_GET['description']);
                try{
                    $ret1 = $statement1->execute();
                }catch(Exception $e){
                    echo "Insert error: ", $e->getMessage();
                }
                echo "<h1>Changes have successfully been made!</h1>";
            }
        ?>
    </body>
</html>









