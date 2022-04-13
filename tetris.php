<html lang="en">
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
                <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/tetris.php" name="tetris" style="background-color: rgb(13, 140, 255)">Play Tetris</a>
                <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/leaderboard.php" name="leaderboard">Leaderboard</a>
            </div>
        </div>
        <!--Tetris Page Contents-->
        <div class=main>
            <div class=grey_box>
                <div style="margin: auto;">
                    <p id="score" style="position:center;margin-top: 35px">Score: 0</p>
                </div>
                <div id=tetris-bg>
                </div>
                <div style="margin: auto;">
                    <button id="startStopButton" type="button" onclick="handleStartStopButton()" style="position:center;margin-bottom: 10px">Start the game</button>
                </div>
            </div>
        </div>

        <form id="scoreForm">
            <input type="number" id="scoreValue" name="scoreValue" value=-999>
            <input type="submmit">
        </form>

        <?php
            $score=$_GET['scoreValue'];

            $error = false;

            $conn_username = "webuser";
            $conn_password = "webpass";
            $conn_dbname = "tetris";
            $conn = mysqli_connect("localhost", $conn_username, $conn_password, $conn_dbname);
                        
            if (!$conn) {
                $error = true;
            }
            if(empty($score)) {
                $error=true;
            }    

            if (!$error){
                if(isset($_SESSION["username"])){
                    $sql = "SELECT Display FROM Users WHERE Username='".$_SESSION["username"]."'";
                    $query = mysqli_query($conn,$sql);
                    while($result = mysqli_fetch_array($query)){
                        if ($result["Display"]==2){
                            $sql = "INSERT INTO Scores VALUES (0,'".$_SESSION["username"]."',".$score.")";
                            mysqli_query($conn,$sql);
                        }
                    }    
                }
                mysqli_close($conn);

                header("Location: http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/leaderboard.php");
            }
        ?>

        <script src="/javascript/tetris.js"></script>
    </body>
</html>