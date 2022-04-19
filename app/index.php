<!DOCTYPE html>
<html>
    <head>
        <title>ClassRoom Monopoly</title>
    </head>
    <body>
        <?php
            $dsn = 'mysql:host=localhost;dbname=Final Project 370';
            $username = 'root';
            $password = '';
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        ?>
        <h1>Welcome --Username--</h1>
        <h2>Here is your classroom list</h2>
    </body>
</html>