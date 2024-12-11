<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/namedElementStyles.css">
    <link rel="stylesheet" href="styles/troubleshootStyle.css">
    <?php require 'connectToDB.php';
    session_start();

    $film_id = "1";
    // sql queries for lists at top of page
    // movie, date & time, & film  screen (location)
    $sql_film_title = "select distinct title, film_id from films";
    $sql_film_date = "select distinct screening_date, film_id from screenings order by screening_date";
    $sql_film_location = "select distinct location from screenings";

    // get results from database
    $film_title_result = $conn->query($sql_film_title);
    $film_date_result = $conn->query($sql_film_date);
    $film_location_result = $conn->query($sql_film_location);

    ?>
    <title>Screen Times</title>
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
    <table class='card_table'>



        <?php

        $sql = "select films.*, screenings.* from films
                 join screenings on screenings.film_id = films.film_id
                where films.film_id =". $_GET['film_id'];

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                // prints out the img urls so that i can insert them into the database
                //  echo "img/". $row["image_url"]     ."<br> ";
                echo "<tr><th> " . $row["title"] . "</th></tr>";
                echo "<tr><td>
                        <div class='table_card'>
                            <img src='" . $row["film_url"] . "' alt='picture of  " . $row["title"] . "' onerror=\"this.src='img/noMovie.jpg';\">
                            <h3>" . $row["title"] . "</h3>
                            <p> Director: " . $row["director"] . "   
                            <br><br>
                            <span class='genre'>" . $row["genre"] . "</span></p> 
                            <p class='descripion'>" . $row["description"] . "</p>
                            <span class='genre'><button class='book_ticket'>Book Ticket</span></p>
                            
                            
                        </div></td>";
                         




            }
        } else {
            echo '<div class="db_error"><p>No records found.</p></div>';
        }

        // Close the connection
        $conn->close();

        ?>

    </table>
    <footer>
        <div>
            <img src="img/DALL·E-The-Silverstrand-Screen" alt="" id="footimg">
        </div>
        <div>
            <br><br>
            <p>About The Silverstrand Screen</p>
            <p>The Silverstrand Screen is more than just a cinema—it’s a sanctuary for film lovers and storytellers
                alike.
                Nestled in a charming corner of the city, this indie theater celebrates the art of filmmaking in its
                purest
                form, offering a carefully curated selection of films that range from hidden gems to thought-provoking
                masterpieces. <br>
                The space exudes a warm, intimate atmosphere, with a vintage-meets-modern aesthetic that invites patrons
                to
                lose
                themselves in the magic of the silver screen. Plush seating, ambient lighting, and an eclectic film
                schedule
                make
                every visit feel like an event. <br>
                <br>
                At The Silverstrand Screen, the emphasis is on connection—between the audience and the films, and among
                a
                community
                of cinephiles who share a passion for storytelling. <br> Monthly retrospectives, director spotlights,
                and
                post-screening
                discussions foster a deeper appreciation for the craft.<br> Whether you’re discovering a foreign film
                for the
                first time or
                revisiting a cult classic with friends, The Silverstrand Screen transforms movie-watching into an
                unforgettable experience. <br>
                This is where cinema lives, breathes, and inspires. (chat gpt filler text)
            </p>
        </div>
    </footer>
</body>

</html>