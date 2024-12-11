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
    <title>Merchandise</title>
</head>

<body>
    <a href="index.php" id="logo">
        <h1>Arthouse Cinema</h1>
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
   
    <main>
        <div id="listScreenings"></div>
        <table class='card_table'>
            <tr>
                <th colspan="3"> Movies on Show</th>
            </tr>

            <tr>
                <?php

                $sql = "select * from merchandise";
                $result = $conn->query($sql);
                $cardcounter = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($cardcounter == 3) {
                            echo "<tr>";
                        }
                        // prints out the img urls so that i can insert them into the database
                         echo "img/". $row["image_url"]     ."<br> ";
                        echo "<td>
                        <div class='table_card'>
                            <img src='img/" . $row["image_url"] . "' alt='picture of  " . $row["name"] . "' onerror=\"this.src='img/noMovie.jpg';\">
                            <h3>" . $row["name"] . "</h3>
                            <p> €" . $row["price"] . "   
                            <br>
                             
                            <p class='descripion'>" . $row["description"] . "</p>
                            <span class='genre'>Add to Cart</span></p>
                            
                            
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
    <script>
        function filmDetails(chosenMovie){
          alert("create session variabes for film details");
        }
        function updateListings() {
            var selectedFilm = document.getElementById("movieSelection").value.split(". ", 2);
            var selectedTime = document.getElementById("timeSelection").value;
            var selectedScreen = document.getElementById("screenSelection").value;

            console.log(selectedFilm[0] + " " + selectedTime + " " + selectedScreen + " ");

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "screeningsResponse.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("listScreenings").innerHTML = this.responseText;
                }
            };
            xmlhttp.send("titleValue=" + selectedFilm[0] + "&timeValue=" + selectedTime + "&screenValue=" + selectedScreen);
        }

        
    </script>
</body>

</html>