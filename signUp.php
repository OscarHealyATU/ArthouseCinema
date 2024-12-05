<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username_in = $_POST['usernameInput'];
    $email_in = $_POST['emailInput'];
    $password_in = $_POST['passwordInput'];

    // variables check if exists already
    $emailExists = false; 
    $usernameExists = false; 

    // Database connection
    require "connectToDB.php";
    echo"<script>alert('checks if username or password exists')</script>";
    $sql = "SELECT username, email FROM Users WHERE username=? or email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_in, $email_in);
    $stmt->execute();
    $result_username = $stmt->get_result();
    

    while ($row = $result_username->fetch_assoc()) {
        
        if ($row['username'] == $username_in) {
            echo"<script>alert('".$username."')</script>";
            $usernameExists = true;
        }
        if ($row['email'] === $email_in) {
            $emailExists = true;
        }
    }
    

    if(!$usernameExists && !$emailExists) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username_in, $email_in, $password_in);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User registered successfully!<br>";
        echo "Username : {$username_in}<br>";
        echo "Email : {$email_in}<br>";
    } else {
        echo "Statement execute Error: " . $stmt->error;
    }
  
   
    }
    else {
        if($usernameExists) {
        echo "The username already exists<br>";
    }
        if($emailExists){
        echo "The email address has already been used<br>";
    }
    }
     // Close connections
     $stmt->close();
    $conn->close();
}
?>
