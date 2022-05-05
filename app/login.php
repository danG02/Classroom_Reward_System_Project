<!DOCTYPE html>
<html>
    <head>
        <title>Classroom Reward System</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
    <?php
    session_start();
    // Connections Database
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
        if(empty(trim($_POST["userName"]))) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["userName"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["userPassword"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["userPassword"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT userInfoName, userName, userPassword FROM userInfo WHERE userName = :userName";
            if($stmt = $dbh->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":userName", $param_username, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = trim($_POST["userName"]); //changing this will change it
                
                // Attempt to execute the prepared statement
                if($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if($stmt->rowCount() == 1) {
                        if($row = $stmt->fetch()) {
                            $userInfoName = $row["userInfoName"];
                            $username = $row["userName"];
                            $hashed_password = $row["userPassword"];
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["userInfoName"] = $userInfoName;
                                $_SESSION["userName"] = $username;                            
                                
                                // Redirect user to welcome page
                                header("location: index.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password. PASSWORD";
                            }
                        }
                    } else {
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
    <h2 class="title">Classroom Reward System</h2>
        <hr>
        <div class="login-page">
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
            <div class="form">
                <form class="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <input class="btn" type="text" placeholder="Username" name="userName" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <input class="btn" type="password" placeholder="Password" name="userPassword" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <input id="button" type="submit" value="Login"></input>
                    <p class="message"> Not registered? <a href="/signup.php">Create an account</a></p>
                </form>
            </div>
        </div>
    </body>
</html>


