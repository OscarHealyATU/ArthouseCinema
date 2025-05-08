<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/namedElementStyles.css">
    <link rel="stylesheet" href="styles/troubleshootStyle.css">
    <link rel="icon" type="image/x-icon" href="/img/style_assets/favicon.png">
    <?php require 'components/connectToDB.php';
    session_start();


    // sql queries for lists at top of page
    // movie, date & time, & film  screen (location)
    $sql_film_title = "select distinct title, film_id from films";
    $sql_film_date = "select distinct screening_date, film_id from screenings order by screening_date";
    $sql_film_location = "select distinct location from screenings";

    function prepFilm($conn, $sql_film_var): mysqli_result
    {
        $stmt = $conn->prepare($sql_film_var);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();    
        return $result;
    }

    // get results from database
    $film_title_result = prepFilm($conn, $sql_film_title);
    $film_date_result =  prepFilm($conn, $sql_film_date);
    $film_location_result = prepFilm($conn, $sql_film_location);

    ?>
    <title>Screen Times</title>
</head>

<body>
    <?php include 'components/navigation.php'; ?>
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
            <tr>
                <th colspan="6" class="tableheadingAlt">All Screenings</th>
            </tr>
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
                    $table = "";
                    while ($row = $result->fetch_assoc()) {
                        $table .= "
                        <tr>
                            <td class='tdButton'>
                                <a onclick='filmDetails(" . $row['film_id'] . ",\"" . $row['screening_date'] . "\")'>Book </a>
                            </td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["location"] . "</td>
                            <td>" . date_format(
                            date_create($row["screening_date"]),
                            "l H:i (M d)"
                        ) . "</td>
                            <td>
                                <img src='img/movie_posters/" . $row['url'] . "' class='thumbnail'>
                            </td>
                        </tr>";
                    }
                    echo $table;
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
    <!-- footer -->
    <?php include 'components/footer.php' ?>
    <script>
        function filmDetails(chosenMovie, chosenDate) {

            const params = new URLSearchParams({
                film_id: chosenMovie,
                screening_date: chosenDate
            });
            window.location.href = `filmDetails.php?${params}`;
        }

        function updateListings() {
            const selectedFilm = document.getElementById("movieSelection").value.split(". ", 2);
            const selectedTime = document.getElementById("timeSelection").value;
            const selectedScreen = document.getElementById("screenSelection").value;           
            const formData = new URLSearchParams();

            formData.append("film_id", selectedFilm[0]);
            formData.append("screening_date", selectedTime);
            formData.append("location", selectedScreen);
            // form data log
            console.log("form data: ", formData.toString());

            fetch("response/screeningsResponse.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: formData.toString()
                })
                .then(response => {
                    if(!response.ok){
                        throw new Error(`Http error: ${response.status}`);
                    }
                    return response.text();
                })
                .then(data => {
                    document.getElementById("listScreenings").innerHTML = data;
                })
                .catch(error => {
                    console.error("fetch error:", error);
                    document.getElementById("listScreenings").innerHTML = "<p class = 'db_error'>Something went wrong2</p>";
                    
                });
        }
    </script>
</body>

</html>