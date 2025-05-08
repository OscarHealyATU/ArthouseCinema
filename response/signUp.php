<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    require "../components/connectToDB.php";
    // Get the form data
    // hashed password
    $password_in = password_hash($_POST['passwordInput'], PASSWORD_DEFAULT);
    $username_in = $_POST['usernameInput'];
    $email_in = $_POST['emailInput'];


    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username_in, $email_in, $password_in);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>User registered successfully! page will reload shortly...</p>";
        echo "<p>Username : {$username_in}</p>";
        echo "<p>Email : {$email_in}</p>";
    } else {
        echo "Statement execute Error: " . $stmt->error;
    }
} else {
    if ($usernameExists) {
        echo "Username or email already exists";
    }
    if ($emailExists) {
        echo "Username or email already exists";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>