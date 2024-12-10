<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/namedElementStyles.css">
    <link rel="stylesheet" href="styles/troubleshootStyle.css">
    <?php require 'connectToDB.php';
    session_start(); ?>
    <title>Home</title>
</head>

<body>
    <a href="index.php" id="logo">
        <h1>Silverstrand Screen</h1>
    </a>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tickets.php"><strong>Buy</strong> Tickets</a></li>
            <li><a href="screenings.php">Screenings</a></li>
            <li><a href="merch.php">Merchandise</li>

            <?php
            if (isset($_SESSION['username'])) {

                echo "<li id='profileName'> Welcome <strong>" . $_SESSION["username"] . "</strong></li>
             <li> <a href='logout.php' id='logout'><strong>Log out</strong></a></li>";


            } else {
                echo "<li> <a href='login.html' id='login'><strong>Log in</strong></a></li>";
                echo "<li> <a href='signUp.html' id='signUp'><strong>Sign Up</strong></a></li>";
            }
            ?>


        </ul>
    </nav>
    <nav class="navbar" id="screeningBar">

    </nav>
    <main>
        <!-- slide show made with help from w3shools carousel tutorial -->
        <!-- https://www.w3schools.com/howto/howto_js_slideshow.asp -->
        <div class="slideshowContainer temporary">
            <div class="slides fade">
                <div class="noText">1 / 3</div>
                <img src="" alt="" srcset="">
                <div class="captionText"></div>
            </div>
            <div class="slides fade">
                <div class="noText">2 / 3</div>
                <img src="" alt="" srcset="">
                <div class="captionText"></div>
            </div>
            <div class="slides fade">
                <div class="noText">3 / 3</div>
                <img src="" alt="" srcset="">
                <div class="captionText"></div>
            </div>

        </div>
        <script>

        </script>
        <table class='card_table'>
            <tr>
                <th colspan="3"> Movies on Show</th>
            </tr>
            
            <tr>
                <?php

                $sql = "select * from films";
                $result = $conn->query($sql);
                $cardcounter = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($cardcounter == 3) {
                            echo "<tr>";
                        }
                        echo "<td>
                        <div class='table_card'>
                            <img src='img/" . rawurlencode($row["title"]) . "' alt='picture of  " . $row["title"] ."' onerror=\"this.src='img/noMovie.jpg';\">
                            <h3>" . $row["title"] . "</h3>
                            <p>" . $row["director"] . "     
                             <span class='release'>" . $row["release_year"] . "</span></p>
                            <p><span class='genre'>" . $row["genre"] . "</span></p>
                            <p>" . $row["description"] . "</p></div>
                        </div></td>";
                        $cardcounter++;
                        if ($cardcounter == 3) {
                            echo "</tr>";
                            $cardcounter = 0;
                        }
                        

                    }
                } else {
                    echo '<div class="db_error"><p>No records found.</p></div>';
                }

                // Close the connection
                $conn->close();

                ?>
            </tr>
        </table>



    </main>
    <footer>
        <p>footer</p>
    </footer>


</body>

</html>