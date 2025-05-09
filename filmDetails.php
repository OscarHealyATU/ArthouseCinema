<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/namedElementStyles.css">
    <link rel="stylesheet" href="styles/troubleshootStyle.css">
    <?php require 'components/connectToDB.php';
    session_start();

    // $film_id = "1";
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
    <?php 
    include 'components/cartModal.php';
    include 'components/navigation.php';
      ?>
    <nav class="navbar" id="screeningBar">
    </nav>
    <form action="addToCart.php">
        <?php
        $sql = "select films.*, screenings.screening_date 
                from films
                join screenings on screenings.film_id = films.film_id
                where films.film_id =" . $_GET['film_id'] . " and screenings.screening_date = '" . $_GET['screening_date'] . "'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $alt_text = "picture of  " . $row["title"];

                echo '
                <div class="movie_details_card">
                    <img class="drop_shadow" src="img/movie_posters/' . $row["film_url"] . '" alt=" ' . $alt_text . ' " onerror=" this.src=\'img/style_assets/noMovie.jpg\' " ;>
                    <h2 class="listing_header" >' . $row["title"] . '</h2>
                    <div>
                        <p class="listing_genre">' . $row["genre"] . '</p>
                        <p class="listing_dircetor">' . $row["director"] . '</p>
                        <p class="listing_description">' . $row["description"] . '</p>
                        <p class="listing_description">' . $row["screening_date"] . '</p>
                    </div>
                    <div class="buy_ticket"><button class="book_ticket" type="submit">Select Time</button></div>
                </div>
                ';
            }
        } else {
            echo '<div class="db_error"><p>No records found.</p></div>';
        }

        // Close the connection
        $conn->close();
        ?>
        <div class="movie_details_card"><a href="screenings.php">back</a></div>
    </form>
    
    <?php include 'components/footer.php'; ?>
</body>

</html>