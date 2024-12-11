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
        footer
    </footer>
</body>

</html>