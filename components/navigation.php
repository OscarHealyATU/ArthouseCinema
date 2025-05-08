<a href="index.php" id="logo">
    <h1>Silverstrand Screen</h1>
</a>
<nav class="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="screenings.php"><strong>Buy</strong> Tickets</a></li>
        <li><a href="merch.php">Merchandise</li>
        <?php if (isset($_SESSION['username'])) {
            echo "<li id='profileName'><a href='profile.php'> Welcome <strong>" . $_SESSION["username"] . "</strong></a></li>";
            echo "<li> <a href='logout.php' id='logout'><strong>Log out</strong></a></li>";
        } else {
            echo "<li> <a href='login.html' id='login'><strong>Log in</strong></a></li>";
            echo "<li> <a href='signUp.html' id='signUp'><strong>Sign Up</strong></a></li>";
        }
        ?>
    </ul>
</nav>