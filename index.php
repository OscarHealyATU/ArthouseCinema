<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/namedElementStyles.css">
    <link rel="stylesheet" href="styles/troubleshootStyle.css">
    <link rel="stylesheet" href="styles/slideShow.css">
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
        <div class="slideshowContainer">
            <div class="slides fade">
                <div class="noText">1 / 3</div>
                <img src="img/The-Grand-Budapest-Hotel-banner" style="width:100%;"
                    onerror="this.src='img/noMovie.jpg';">
                <div class="captionText">The Grand Budapest Hotel banner</div>
            </div>
            <div class="slides fade">
                <div class="noText">2 / 3</div>
                <img src="img/eraserhead-banner" style="width:100%;" onerror="this.src='img/noMovie.jpg';">
                <div class="captionText"></div>
            </div>
            <div class="slides fade">
                <div class="noText">3 / 3</div>
                <img src="img/seventhseal-banner.jpg" style="width:100%;" onerror="this.src='img/noMovie.jpg';">
                <div class="captionText"></div>
            </div>

            <a class="prev" onclick="plusSlides(-1)"><img src="img/asset_back_arrow" alt="prev_image"></a>
            <a class="next" onclick="plusSlides(1)"><img src="img/asset_next_arrow" alt="next_image"></a>

        </div>

        <script src="scripts/slideshow"></script>
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
                        // prints out the img urls so that i can insert them into the database
                        // echo "img/".rawurlencode($row["title"])."<br> ";
                        echo "<td>
                        <div class='table_card'>
                            <img src='" . $row["film_url"] . "' alt='picture of  " . $row["title"] . "' onerror=\"this.src='img/noMovie.jpg';\">
                            <h3>" . $row["title"] . "</h3>
                            <p>" . $row["director"] . "     
                             <span class='release'>" . $row["release_year"] . "</span><br>
                             <span class='genre'>" . $row["genre"] . "</span></p>
                            <p class='descripion'>" . $row["description"] . "</p></div>
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
        <p>The Silverstrand Screen is more than just a cinema—it’s a sanctuary for film lovers and storytellers alike.
            Nestled in a charming corner of the city, this indie theater celebrates the art of filmmaking in its purest
            form, offering a carefully curated selection of films that range from hidden gems to thought-provoking
            masterpieces. <br>
            The space exudes a warm, intimate atmosphere, with a vintage-meets-modern aesthetic that invites patrons to
            lose
            themselves in the magic of the silver screen. Plush seating, ambient lighting, and an eclectic film schedule
            make
            every visit feel like an event.
            <br>
            At The Silverstrand Screen, the emphasis is on connection—between the audience and the films, and among a
            community
            of cinephiles who share a passion for storytelling. Monthly retrospectives, director spotlights, and
            post-screening
            discussions foster a deeper appreciation for the craft.<br> Whether you’re discovering a foreign film for the
            first time or
            revisiting a cult classic with friends, The Silverstrand Screen transforms movie-watching into an
            unforgettable experience.
            This is where cinema lives, breathes, and inspires. (chat gpt)
        </p>
    </footer>


</body>

</html>