<?php
    require 'config/config.php';
    include("includes/classes/User.php");
    include("includes/classes/Post.php");
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
    <title></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php
    //Get id of post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}
   $get_likes=mysqli_query($con,"SELECT likes,added_by FROM posts WHERE id='$post_id'");
   $row=mysqli_fetch_array($get_likes);
   $total_likes=$row['likes'];
   $user_liked=$row['added_by'];
   $user_detail_query=mysqli_query($con,"SELECT * FROM users WHERE username='$user_liked'");
   $row=mysqli_fetch_array($user_detail_query);
   //like
   //unlike
   //check for previous likes
   $check_query=mysqli_query($con,"SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
   $num_rows=mysqli_num_rows($check_query);
   if($num_rows>0){
    echo '<form action="like.php"?post_id=' . $post_id . '"method="POST">
    <input type="submit" class="comment_like" name="unlike_button" value="unlike">
    <div class="like_value">
       '.$total_likes .'Likes
    </div>
    </form>
    ';
   }else{
    echo '<form action="like.php"?post_id=' . $post_id . '"method="POST">
    <input type="submit" class="comment_like" name="like_button" value="like">
    <div class="like_value">
       '.$total_likes .'Likes
    </div>
    </form>
    ';
   }
    ?>
</body>
</html>