    <?php require '../components/connectToDB.php';
    // values from screenings.php 
    // use null if not set 

    $selectedFilm = $_POST['film_id'] ?? null;
    $selectedTime = $_POST['screening_date'] ?? null;
    $selectedScreen = $_POST['location'] ?? null;
    // declare empty strings for constructing sql statement
    $whereClauses = [];

    $params = [];
    $types = ""; // e.g bind_param("$types", $params)

    if (!empty($selectedFilm)) {
        $whereClauses[] = "films.film_id = ?";
        $params[] = $selectedFilm;
        $types .= "i";
    }
    if (!empty($selectedTime)) {
        $whereClauses[] = "screenings.screening_date = ? ";      
        $params[] = $selectedTime;
        $types .= "s";
    }
    if (!empty($selectedScreen)) {
        $whereClauses[] = "screenings.location = ?";
        $params[] = $selectedScreen;
        $types .= "s";
    }
    $whereSQL = "";
    if (count($whereClauses)>0) {
        $whereSQL = "where ".implode(" and ",$whereClauses);
    }

    $sql= "select screenings.*, films.title as title
                            from screenings
                            join films on screenings.film_id = films.film_id
                            $whereSQL
                            order by title";

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types,...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table>
    <tr><th colspan='4' class='tableheadingAlt'>Selected Screenings</th></tr>
    <tr>
    <th colspan='2' >Film</th>
    <th>Time</th>
    <th>Screen</th>
    </tr>";
    if ($result && $result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        
    echo "<tr>";
    echo "<td class='tdButton'><a onclick='filmDetails(".$row['film_id'].")'>Book </a></td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" .  date_format(date_create($row["screening_date"]), "l H:i (M d)") . "</td>";
    echo "<td>" . $row['location'] . "</td>";
    echo "</tr>";
    }
    }else{
        echo"<tr><td colspan='4'>No results with current selection</td></tr>";
    }
    echo "</table>";

        $conn->close();
    ?>

