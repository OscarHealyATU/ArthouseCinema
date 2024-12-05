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
            // logged in, redirects to home page + a console log
            echo "<script>console.log('log in successful');alert('todo: emplement hashing');</script>";
            echo "<script>console.log('".$_SESSION["username"] ."');alert('".$_SESSION["username"] ."');</script>";
            //  header("location: index.php");
            echo "<script>document.location.assign('index.php')</script>";
        }else { 
            echo "Incorrect Password";
            
        }
    } else{
        echo "no username like that exists";
    }
}
?>
