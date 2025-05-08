<?php
    // $servername = "frameworkproject"; // name of laptop project
    $servername = "arthousecinema";
    $username = "root";
    $password = "";
    $dbname = "silverstrand_screen";

// create & checking connection 
$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>