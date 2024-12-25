<?php
session_start();
session_destroy();
header("Location: ./auth/login.php");
exit();
?>