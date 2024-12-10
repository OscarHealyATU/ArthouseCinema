<?php
require 'connectToDB.php';
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username_in = $_POST['usernameInput'];
    $password_in = $_POST['passwordInput'];
    
    
    $sql = "select * from users where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username_in);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows>0) {
        
        $row = $result->fetch_assoc();
        if ($password_in === $row["password_hash"]) {
            $_SESSION["username"] = $username_in;
            echo "<script>document.location.assign('index.php')</script>";
        }else { 
            echo "Incorrect Username or Password";
            
        }
    } else{
        echo "Incorrect Username or Password";
    }
}
?>
