<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect the user to the login page
header("Location: login1.php");
exit();
?>
