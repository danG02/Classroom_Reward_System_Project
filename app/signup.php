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
        
     // Define variables and initialize with empty values
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";
   
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["userName"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["userName"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userInfoName FROM userInfo WHERE userName = :userName;";
        
        if($stmt = $dbh->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userName", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["userName"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["userName"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["userPassword"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["userPassword"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["userPassword"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO userInfo (userName, userPassword) VALUES (:userName, :userPassword);";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userName", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":userPassword", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
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
        
    ?>


        <h2 class="title">Welcome let us improve your classroom manegment!</h2>
        <hr>
        <div class="login-page">
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="register" method="POST">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <input type="text" placeholder="Username" name="userName" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <input type="password" placeholder="Password" name="userPassword" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <input type="submit" value="Create"></input>
                    <p class="message"> Already registered? <a href="/login.php">Sign In</a></p>
                </form>
            </div>
        </div>
    </body>
</html>
