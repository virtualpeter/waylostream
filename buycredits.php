<?php
/* User login process, checks if user exists and password is correct */
require 'db.php';
session_start();
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_SESSION['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
$user = $result->fetch_assoc();
$credits = $user['credits'];
$verified = $user['active'];
if ($verified > 0) {
    $credits = $credits + 10000;
    $sql = $mysqli->prepare("UPDATE users SET credits='$credits' WHERE email='$email'");
    $sql->bind_param('is', $credits, $email);
    $sql->execute();
    header("location: profile.php");
}
else { header("location: profile.php");}
?>


