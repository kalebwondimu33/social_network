<?php
require 'config/config.php';
if(isset($_SESSION['username'])){
    $userLoggedIn=$_SESSION['username'];
    $user_detail_query=mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
    $user=mysqli_fetch_array($user_detail_query);
    
}else{
    header("Location:registor.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FriendLink</title>
    <!-- css file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- javascript file -->
    
    
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/aaa1dd84b2.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/demo.js"></script>
    
</head>
<body>
   <div class="top_bar">
       <div class="logo">
          <a href="index.php">Freind Link!</a>
       </div>
       <nav>
        <a href="<?php echo $userLoggedIn?>">
            <?php echo $user['fname']?>
        </a>
       <a href="index.php"><i class="fa fa-home fa-lg"></i></a>
        <a href="#"><i class="fa-solid fa-envelope"></i></a>
        <a href="#"><i class="fa-regular fa-bell"></i></a>
        <a href="requests.php"><i class="fa-solid fa-users"></i></a>
        <a href="#"><i class="fa-solid fa-gear"></i></a>
        <a href="includes/handlers/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
       </nav>

   </div>
   <div class="wrapper">
   