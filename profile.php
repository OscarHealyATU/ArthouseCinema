<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/style_assets/favicon.png">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/namedElementStyles.css">
    <link rel="stylesheet" href="styles/troubleshootStyle.css">
    <link rel="stylesheet" href="styles/slideShow.css">
    <?php require 'components/connectToDB.php';
    session_start(); ?>
    <title>Home</title>
</head>

<body>
    <!-- navigation -->
    <?php include 'components/navigation.php'; 
    $username = $_SESSION['username'];
    $sql = "select * from users where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param("s",$username);
    $stmt ->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    ?>
    <nav class="navbar" id="screeningBar">

    </nav>
    <main>
      <div class="temporary">
        <h2>Welcome 
        <?php if (isset($_SESSION['username'])) {
          echo $_SESSION['username'];
        }?>
        </h2>
        <p>Profile Page</p>
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="" value="jimmy" disabled>
        <label for="firstName">Last Name:</label>
        <input type="text" name="LastName" id="" value="joe" disabled>
        <label for="firstName">Email:</label>
        <input type="text" name="email" id="" value="<?php echo htmlspecialchars($user['email']);?>" disabled>
        <label for="firstName">Phone:</label>
        <input type="text" name="phone" id="" value="081 235 1235" disabled>
        <label for="firstName">Location:</label>
        <input type="text" name="location" id="" value="ireland" disabled>
        
      </div>  
    </main>
    <!-- footer -->
    <!-- <?php include 'components/footer.php' ?> -->
</body>

</html>