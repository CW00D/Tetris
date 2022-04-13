<html lang="en">
    <?php session_start(); ?>

    <head>
        <link rel="stylesheet" href="/css/TetrisStyle.css">
        <title>Tetris</title>
    </head>
    <body>
        <!--Navbar-->
        <div class=navbar>
            <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/index.php" name="home" style="background-color: rgb(13, 140, 255)">Home</a>
            <div class=navbar-right-section>
                <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/tetris.php" name="tetris">Play Tetris</a>
                <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/leaderboard.php" name="leaderboard">Leaderboard</a>
            </div>
        </div>
        <div class=main>
            <!--Not Logged In Page Contents-->
            <?php if(!isset($_SESSION["username"])){ ?> 
                <div class=grey_box>
                    <form style="margin-top:16px">
                        <label for="username">Username:</label><br>
                        <input type="text" id="username" name="username" placeholder="Username"><br><br>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password"  placeholder="Password"><br><br>
                        <input type="submit" value="Log In" style="display: block; margin: 0 auto;">
                        <p style="text-align: center;">Don’thave a user account?<br><a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/register.php">Register now</a></p>
                    </form>

                    <?php
                        $username=$_GET['username'];
                        $password=$_GET['password'];

                        $error = false;

                        $conn_username = "webuser";
                        $conn_password = "webpass";
                        $conn_dbname = "tetris";
                        $conn = mysqli_connect("localhost", $conn_username, $conn_password, $conn_dbname);
                        
                        if (!$conn) {
                            $error = true;
                        }
                        if(empty($username)) {
                            $error=true;
                        }
                        if(empty($password)) {
                            $error=true;
                        }
                        $sql = "SELECT UserName FROM Users WHERE UserName='".$username."' AND Password='".$password."'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) == 0) {
                            $error = true;
                        }
                        mysqli_close($conn);
                        if (!$error){
                            $_SESSION["username"] = $username;
                            header("Location: http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/index.php");
                        }
                    ?>
                </div>
            <?php } ?>
            
            <!--Logged In Page Contents-->
            <?php if(isset($_SESSION["username"])){ ?> 
                <div class=grey_box>
                    <form action="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/tetris.php">
                        <h3>Welcome to Tetris</h3><br>
                        <button type="submit" style="display: block; margin: 0 auto;">Click here to play</button>
                        <a href="logout.php"><p style="text-align:center">Log Out</p></a>
                    </form>
                </div>
            <?php } ?>
        </div>        
    </body>
</html>