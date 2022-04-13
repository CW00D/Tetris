<html>
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
                <a href="http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/leaderboard.php" name="leaderboard" style="background-color: rgb(13, 140, 255)">Leaderboard</a>
            </div>
        </div>
        <!--Leaderboard Page Contents-->
        <div class=main>
            <?php
                //checking connection
                $conn_username = "webuser";
                $conn_password = "webpass";
                $conn_dbname = "tetris";
                $conn = mysqli_connect("localhost", $conn_username, $conn_password, $conn_dbname);

                $sql = "SELECT * FROM Scores ORDER BY Score DESC;";
                $result = mysqli_query($conn,$sql);
                echo '<div class=grey_box>';
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        echo '<table class=leaderboard>';
                        echo '<tr><th>Username</th><th>Score</th></tr>';
                            while( $row = mysqli_fetch_assoc($result) ) {                               
                            echo "<tr>";
                            echo "<td>" . $row["Username"]. "</td>";
                            echo "<td>" . $row["Score"]. "</td>";
                            echo "</tr>";
                        }
                        echo '</table>';
                    } else {
                    echo "No scores to show.";
                    }
                echo '</div>';

                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>