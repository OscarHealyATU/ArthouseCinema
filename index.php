<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/namedElementStyles.css">
    <link rel="stylesheet" href="styles/slideShow.css">
    <link rel="stylesheet" href="styles/troubleshootStyle.css">
    <!-- <link rel="stylesheet" href="styles/slideShow.css"> -->
    <link rel="icon" type="image/x-icon" href="/img/style_assets/favicon.png">
    <?php require 'components/connectToDB.php';
    session_start(); ?>
    <title>Home</title>
</head>

<body>
    <!-- navigation -->
   <?php include 'components/navigation.php';?>
    <nav class="navbar" id="screeningBar"></nav>
    <main>
        <!-- slide show made with help from w3shools carousel tutorial -->
        <!-- https://www.w3schools.com/howto/howto_js_slideshow.asp -->
        <div class="slideshowContainer">
            <div class="slides fade">
                <div class="noText">1 / 3</div>
                <img src="img/style_assets/The-Grand-Budapest-Hotel-banner" style="width:100%;"
                    onerror="this.src='img/noMovie.jpg';">
                <div class="captionText">The Grand Budapest Hotel banner</div>
            </div>
            <div class="slides fade">
                <div class="noText">2 / 3</div>
                <img src="img/style_assets/eraserhead-banner" style="width:100%;" onerror="this.src='img/noMovie.jpg';">
                <div class="captionText"></div>
            </div>
            <div class="slides fade">
                <div class="noText">3 / 3</div>
                <img src="img/style_assets/seventhseal-banner.jpg" style="width:100%;" onerror="this.src='img/noMovie.jpg';">
                <div class="captionText"></div>
            </div>

            <a class="prev" onclick="plusSlides(-1)"><img src="img/style_assets/asset_back_arrow" alt="prev_image"></a>
            <a class="next" onclick="plusSlides(1)"><img src="img/style_assets/asset_next_arrow" alt="next_image"></a>

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
                            <img src='img/movie_posters/" . $row["film_url"] . "' alt='picture of  " . $row["title"] . "' onerror=\"this.src='img/noMovie.jpg';\">
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

    <!-- footer -->
    <?php include 'components/footer.php' ?>

</body>

</html>