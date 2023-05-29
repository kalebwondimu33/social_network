<?php
include("includes/header.php");

?>
    <div class="user_detail column">
       <a href=""><img src="<?php echo $user['profile_pic'];?>"></a>
       <div class="user_details_left_right">
        <a href="#">
            <?php echo $user['fname']." ".$user['lname'];
            ?>
        </a>
        <br>
        <?php
        echo "Post:".$user['num_posts']."<br>";
        echo "Likes:".$user['num_likes'];
        ?>
       </div>
    </div>
</div>
</body>
</html>