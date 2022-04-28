<!DOCTYPE html>
<html>
    <head>
        <title>ClassRoom Monopoly</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
    <?php

    // Connections Database
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

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        header("location: index.php");
        exit;
    }
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    // ---------------------------------------------------------------------------------
    // Credit to -> https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
    //Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
     
        // Check if username is empty
        if(empty(trim($_POST["username"]))) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT userName, userPassword FROM userInfo WHERE userName = :username;";
            if($stmt = $dbh->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = trim($_POST["userName"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if($stmt->rowCount() == 1) {
                        if($row = $stmt->fetch()) {
                            //$id = $row["id"];
                            $username = $row["userName"];
                            //$hashed_password = $row["userPassword"];
                            $password = $row["userPassword"];
                            if(password_verify($password)){ //if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                //$_SESSION["id"] = $id;
                                $_SESSION["userName"] = $username;                            
                                
                                // Redirect user to welcome page
                                header("location: index.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password. PASSWORD";
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password. USERNAME";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                unset($stmt);
            }
        }
        
        // Close connection
        unset($dbh);
    }
    // ---------------------------------------------------------------------------------
    ?>
    <h2 class="title">App Name</h2>
        <hr>
        <div class="login-page">
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
            <div class="form">
                <form class="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <input type="text" placeholder="Username" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"/>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <input type="password" placeholder="Password" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"/>
                    <button>login</button>
                    <p class="message"> Not registered? <a href="/signup.php">Create an account</a></p>
                </form>
            </div>
        </div>
    </body>
</html>


