<?php
session_start();

// unst all session 
$_SESSION = array();

// dtry the session
session_destroy();

header("Location: index.php"); 
exit();
?>
