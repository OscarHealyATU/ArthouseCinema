<?php
require 'connectToDB.php';
// values from screenings.php
$selectedFilm = $_POST['titleValue'];
$selectedTime = $_POST['timeValue'];
$selectedScreen = $_POST['screenValue'];
// declare empty strings for constructing sql statement
$whereTitleClause = " ";
$whereTimeClause = " ";
$whereScreenClause = " ";
$andWhere = " where ";
// 
if ($selectedFilm) {
    $whereTitleClause = "$andWhere films.film_id = $selectedFilm";
    $andWhere = " or ";
}
if ($selectedTime) {
    $whereTimeClause = "$andWhere screenings.screening_date = '$selectedTime' ";
    $andWhere = " or ";
}
if ($selectedScreen) {
    $whereScreenClause = "$andWhere screenings.location = '$selectedScreen'";
    $andWhere = " or ";
}
$sql_film_times = "select screenings.*, films.title as title
                        from screenings
                        join films on screenings.film_id = films.film_id
                        $whereTitleClause$whereTimeClause$whereScreenClause
                        order by title";

$result = $conn->query($sql_film_times);

echo "<table>
<tr><th colspan='4' class='tableheadingAlt'>Selected Screenings</th></tr>
<tr>
<th colspan='2' >Film</th>
<th>Time</th>
<th>Screen</th>
</tr>";
if ($result && $result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {
    
  echo "<tr>";
  echo "<td class='tdButton'><a href='x\a.php'>select</a></td>";
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

