<?php
session_start();
$_SESSION['admin_username'] = $admin_username;
$admin_username=$_SESSION['admin_username'];

//session_unregister("admin_username");
unset($admin_username);
session_unset();
session_destroy();

header("Location: login.php?action=logout");
?>