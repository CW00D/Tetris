<html>
    <?php session_start(); ?>

    <head>
        <link rel="stylesheet" href="/css/TetrisStyle.css">
        <title>Tetris</title>
    </head>
    <body>
        <!--Navbar-->
        <div class=navbar>
            <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/index.php" name="home">Home</a>
            <div class=navbar-right-section>
                <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/tetris.php" name="tetris">Play Tetris</a>
                <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/leaderboard.php" name="leaderboard">Leaderboard</a>
            </div>
        </div>
        <!--Register Page Contents-->
        <div class=main>
            <div class=grey_box>
                <form style="margin-top:16px">
                    <label for="first_name">First Name:</label><br>
                    <input type="text" id="first_name" name="first_name" placeholder="First name"><br><br>
                    <label for="last_name">Last Name:</label><br>
                    <input type="text" id="last_name" name="last_name" placeholder="Last name"><br><br>
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" placeholder="Username"><br><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password"  placeholder="Password"><br><br>
                    <label for="confirm_password">Confirm Password:</label><br>
                    <input type="password" id="confirm_password" name="confirm_password"  placeholder="Confirm password"><br><br>
                    
                    <p>Display Scores:</p>
                    <input type="radio" id="yes" name="display_scores" value=2 checked>
                    <label for="html">Yes</label><br>
                    <input type="radio" id="no" name="display_scores" value=1>
                    <label for="css">No</label><br><br>

                    <input type="submit" value="Register" style="display: block; margin: 0 auto;">
                </form>
                
                <?php
                    $first_name=$_GET['first_name'];
                    $last_name=$_GET['last_name'];
                    $username=$_GET['username'];
                    $password=$_GET['password'];
                    $confirm_password=$_GET['confirm_password'];
                    $display_scores=$_GET['display_scores'];

                    $error = false;

                    $conn_username = "webuser";
                    $conn_password = "webpass";
                    $conn_dbname = "tetris";
                    $conn = mysqli_connect("localhost", $conn_username, $conn_password, $conn_dbname);
                    
                    if (!$conn) {
                        $error = true;
                    }
                    if(empty($first_name)) {
                        $error=true;
                    }
                    if(empty($last_name)) {
                        $error=true;
                    }
                    if(empty($username)) {
                        $error=true;
                    }
                    if(empty($password)) {
                        $error=true;
                    }
                    if(empty($confirm_password)) {
                        $error=true;
                    }
                    if(empty($display_scores)) {
                        $error=true;
                    }
                    if($password != $confirm_password) {
                        $error=true;
                    }
                    $sql = "SELECT UserName FROM Users WHERE UserName='".$username."'";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0) {
                        $error = true;
                    }

                    if (!$error){                      
                        //inserting new users into database
                        $sql = "INSERT INTO Users VALUES('" . $username . "','" . $first_name . "','" . $last_name . "','" . $password . "'," . $display_scores . ")"; 
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);

                        //logging the user in
                        $_SESSION["username"] = $username;

                        //redirect
                        header("Location: http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/index.php");
                    }
                    mysqli_close($conn);
                ?>
            </div>  
        </div>
    </body>
</html>