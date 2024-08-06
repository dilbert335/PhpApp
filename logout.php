<?php
// This logs out the user by stopping the session and moving the user to
//login.php
session_start();
session_destroy();
header('Location: login.php');
exit();
?>
