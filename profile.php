<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
if(isset($_GET['profile_username'])){
  $username=$_GET['profile_username'];
  $user_detail_query=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
  $user_array=mysqli_fetch_array($user_detail_query);
  $num_friends=(substr_count($user_array['friend_array'],",")) -1 ;
}

?>
<style type="text/css">
  .wrapper{
    margin-left: 0px;
    padding-left: 0px;
  }

</style>
<div class="profile_left">
  <img src="<?php echo $user_array['profile_pic']; ?>">
  <div class="profile_info">
    <p><?php echo "Posts: " . $user_array['num_posts'];?></p>
    <p><?php echo "Likes: " . $user_array['num_posts'];?></p>
    <p><?php echo "Friends: " . $num_friends;?></p>

  </div>
  <form action="<?php echo $username; ?>">
  <?php
    $profile_user_obj = new User($con,$username);
    if($profile_user_obj->isClosed()){
      header("Location: user_closed.php");
      
    }
    $logged_in_user_obj = new User($con,$userLoggedIn);
    if($logged_in_user_obj->isFriend($username)){
      echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
    }
  ?>

  </form>

</div>
    <div class="main_column column">
      <?php  echo $username;?>

    </div>
</div>
</body>
</html>