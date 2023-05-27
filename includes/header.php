<?php
require 'config/config.php';
if(isset($_SESSION['username'])){
    $userLoggedIn=$_SESSION['username'];
    
}else{
    header("Location:registor.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FriendLink</title>
</head>
<body>
    jfkldsjfslkajdklsjkafljd