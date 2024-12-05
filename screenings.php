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
    // sql queries for lists
    // movie
    $sql_film_title = "select distinct title, film_id from films";
    // date & time
    $sql_film_date = "select distinct screening_date, film_id from screenings order by screening_date";
    // film screen (location)
    $sql_film_location = "select distinct location from screenings";

    // get results from database
    $film_title_result = $conn->query($sql_film_title);
    $film_date_result = $conn->query($sql_film_date);
    $film_location_result = $conn->query($sql_film_location);




    ?>
    <title>Screen Times</title>
</head>

<body>
    <H1 id="logo">Arthouse Cinema</H1>
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
                <select name="movieSelection" id="movieSelection">
                    <option value="">Choose Movie</option>
                    <!-- creates list of film titles  -->
                    <?php FillOptions($film_title_result, "title"); ?>
                </select>
            </li>
            <li>
                <!-- choose time  -->
                <select name="timeSelection" id="timeSelection">
                    <option value="">Choose time</option>
                    <?php FillOptions($film_date_result, "screening_date"); ?>
                </select>
            </li>
            <li>
                <!-- choose screen  -->
                <select name="screenSelection" id="screenSelection">
                    <option value="">Choose screen</option>
                    <?php FillOptions($film_location_result, "location"); ?>

                </select>
            </li>
        </ul>
    </nav>
    <main>
        <table>
            <tr>
                <th>Film</th>
                <th>Screen</th>
                <th>time</th>

            </tr>
            <tr>
                <?php
                // sql query for main table results
                $sql_film_times = " select screenings.*, films.title as title 
                                    from screenings where ".$movie."
                                    join films on screenings.film_id = films.film_id
                                    order by title";
                $result = $conn->query($sql_film_times); // continues where ever table is
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>"
                            . $row["title"] . "</td><td>"
                            . $row["location"] . "</td><td>"
                            . date_format(date_create($row["screening_date"]), "l H:i (M d)") . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo '<div class="db_error"><p>No records found.</p></div>';
                }

                function FillOptions($select_result, $db_item)
                {
                    if ($select_result->num_rows > 0) {
                        while ($row = $select_result->fetch_assoc()) {
                            $option = $row[$db_item];
                            echo "<option value='" . $row["film_id"] . "'>" . $option . "</option>";
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
        <p>footer</p>
    </footer>
    <script>
        
    </script>
</body>

</html>