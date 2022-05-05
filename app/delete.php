<!DOCTYPE html>
<html>
    <head>
        <title>Classroom Reward System</title>
        <link rel="stylesheet" href="delete.css">
    </head>
    <body>
    <h1 id="main_title"><a href="index.php">Classroom Reward System</a></h1>
        <h2>Delete a student from the list by using ID!</h2>
        <form method="get">
            <label for="studentID">Id:</label><br>
            <input type="text" name="studentID"><br>
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

            //echo $_POST['studentID'];
            //echo $_REQUEST['studentID'];
            
            try {
                $dbh = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            // Inserting the data
            if(isset($_GET['studentID'])) 
            {
                //$sql = 'DELETE FROM studentInfo WHERE id='" . $_GET["studentID"] . "';';
                $sql = "DELETE FROM studentInfo WHERE studentID='" . $_GET["studentID"] . "'";
                
                //$statement = $dbh->prepare($sql);
                //$statement->bindValue(1, $_GET['studentInfoName']);
                //$statement->bindValue(2, $_GET['studentID']);
                //$statement->bindValue(3, $_GET['currency']);
                try{
                    $dbh->exec($sql);
                    //$ret = $statement->execute();
                }catch(Exception $e){
                    echo "Delet error: ", $e->getMessage();
                }
                echo "<h1>You have successfully deleted a student!</h1>";
            }
        ?>
    </body>
</html>

