<?php
include("includes/header.php");

?>
    <div class="user_detail column">
       <a href="<?php echo $userLoggedIn?>"><img src="<?php echo $user['profile_pic'];?>"></a>
       <div class="user_details_left_right">
        <a href="<?php echo $userLoggedIn?>">
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
    <div class="main_column column">
        <form class="post_form"action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
            <input type="submit" name="post" id="post_button" value="Post">
            <hr>
        </form>

    </div>
</div>
</body>
</html>