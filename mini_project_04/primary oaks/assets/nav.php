<?php
echo "<div>";
echo "<nav>";
echo "<a href='index.php'>Home</a>";

if(isset($_SESSION['user']) && $_SESSION['user'] === true){
    echo "<a href='logout.php'>Logout</a>";
} else {
    echo "<a href='login.php'>Login</a>";
    echo "<a href='register.php'>Register</a>";
}
echo "</nav>";
echo "</div>";
?>
