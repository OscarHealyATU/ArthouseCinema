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
    require "cliplib/connectToDB.php";
    $sql = "SELECT username, email FROM Users WHERE username=? or email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_in, $email_in);
    $stmt->execute();
    $result_username = $stmt->get_result();

    while ($row = $result_username->fetch_assoc()) {
        if ($row['username'] == $username_in) {
            $usernameExists = true;
        }
        if ($row['email'] === $email_in) {
            $emailExists = true;
        }
    }

    if (!$usernameExists && !$emailExists) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO Users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username_in, $email_in, $password_in);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p>User registered successfully! page will reload shortly...</p>";
            echo "<p>Username : {$username_in}</p>";
            echo "<p>Email : {$email_in}</p>";
            echo "<script>window.setTimeout(reload,3000);</script>";
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
    }
    // Close connections
    $stmt->close();
    $conn->close();
}
?>