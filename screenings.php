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
    <nav class="navbar" id="screeningBar">
        <ul>
            <li>
                <!-- chose movie  -->
                <select name="movieSelection" id="movieSelection" onchange="updateListings(1)">
                    <option value="">Choose Movie</option>
                    <!-- creates list of film titles  -->
                    <?php FillOptions($film_title_result, "title"); ?>
                </select>
            </li>
            <li>
                <!-- choose time  -->
                <select name="timeSelection" id="timeSelection" onchange="updateListings(2)">
                    <option value="">Choose time</option>
                    <?php FillOptions($film_date_result, "screening_date"); ?>
                </select>
            </li>
            <li>
                <!-- choose screen  -->
                <select name="screenSelection" id="screenSelection" onchange="updateListings(3)">
                    <option value="">Choose screen</option>
                    <?php FillOptions($film_location_result, "location"); ?>

                </select>
            </li>
        </ul>
    </nav>
    <main>
        <div id="listScreenings"></div>
        <table>
            <tr><th colspan="6" class="tableheadingAlt">All Screenings</th></tr>
            <tr>
                <th colspan="1">Film</th>
                <th colspan="1">Screen</th>
                <th colspan="4">time</th>
                

            </tr>
            <tr>
                <?php
                // sql query for main table results
                
                $sql_film_times = " select screenings.*, films.title as title, films.film_url as url  
                                        from screenings 
                                        join films on screenings.film_id = films.film_id
                                        
                                        order by title";
                $result = $conn->query($sql_film_times); // continues where ever table is
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='tdButton'><a onclick='filmDetails(".$row['film_id'].")'>Book </a></td>";
                        echo "<td>"
                            . $row["title"] . "</td><td>"
                            . $row["location"] . "</td><td>"
                            . date_format(date_create($row["screening_date"]), "l H:i (M d)") . "</td0>";
                            echo "<td>";
                        echo "<td><img src='". $row["url"] . "' class='thumbnail'></td>";   
                        echo "</tr>";
                    }
                } else {
                    echo '<div class="db_error"><p>No records found.</p></div>';
                }
                // fills select drop downs 
                function FillOptions($select_result, $db_item)
                {
                    if ($select_result->num_rows > 0) {
                        while ($row = $select_result->fetch_assoc()) {
                            if ($db_item === "title") {
                                echo "<option>" . $row["film_id"] . ". " . $row[$db_item] . "</option>";
                            } else if ($db_item === "screening_date") {
                                 echo "<option value='$row[$db_item]'>" . date_format(date_create($row[$db_item]), " H:i D d") . "</option>";
                            } else if ($db_item === "location") {
                                echo "<option>" . $row["location"] . "</option>";
                            }
                        }
                    } else {
                        echo '<option class = "db_error">Something went wrong</option>';
                    }
                }


                // Close the connection
                $conn->close();
                ?>
            </tr>
        </table>


    </main>
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
    <script>
        function filmDetails(chosenMovie){
        //   alert("create session variabes for film details"); 
        window.location.href = `filmDetails.php?${"film_id="+chosenMovie}`;

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