<?php
require '../components/connectToDB.php';
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username_in = $_POST['usernameInput'];
    $password_in = $_POST['passwordInput'];
    
    $sql = "select * from users where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username_in);
    $stmt->execute();
    $result = $stmt->get_result();
    $response = [];

    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();

        if (password_verify($password_in, $row["password_hash"])) {
            $_SESSION["username"] = $username_in;
            $response['status'] = 'success';
            $response['message'] = 'success';
        }else { 
            $response['status'] = 'error';
            $response['message'] = 'Incorrect Username or Password';
        }
    } else{
        $response['status'] = 'error';
        $response['message'] = 'Incorrect Username or Password';
    }
    echo json_encode($response);
}


?>
