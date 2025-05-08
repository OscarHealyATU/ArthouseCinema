<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <?php include 'components/navigation.php'; ?>
    <nav class="navbar" id="screeningBar">

    </nav>
    <main>
      <div class="temporary">
        <h2>Welcome Oscar</h2>
        <img src="account/profile.png" alt="profile picture" srcset="">
        <input type="text" name="firstName" id="" value="Oscar">
        <input type="text" name="LastName" id="" value="Healy">
        <input type="text" name="email" id="" value="oscar.healy101@gmail.com">
        <input type="text" name="phone" id="" value="083 803 8985">
        <input type="text" name="location" id="" value="Galway">
        
      </div>  
    </main>
    <!-- footer -->
    <!-- <?php include 'components/footer.php' ?> -->
</body>

</html>