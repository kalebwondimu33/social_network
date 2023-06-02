<?php
class Post{
      private $user_obj;
      private $con;
      public function __construct($con,$user)
      {
        $this->con=$con;
        $this->user_obj=new User($con,$user);
      }
      public function submitPost($body,$user_to){
        $body=strip_tags($body);
        $body=mysqli_real_escape_string($this->con,$body);
        $check_empty=preg_replace('/\s+/','',$body);//delete all spaces 
       if($check_empty!=""){
        //current date and time
        $date_added=date("y-m-d H:i:s");
        //tet username
        $added_by=$this->user_obj->getUsername();
        //if user is on own profile ,user_to is 'none'
        if ($user_to==$added_by){
            $user_to="none";
        }
        //insert post
        $query=mysqli_query($this->con,"INSERT INTO posts VALUES('','$body','$added_by','$user_to','$date_added','no','no','0')");
        $returned_id=mysqli_insert_id($this->con);
        //insert notfication
        //update post count for user
        $num_posts=$this->user_obj->getNumPosts();
        $num_posts++;
        $update_query=mysqli_query($this->con,"UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
       }
      }
      public function loadPostFriends(){
        $str="";//string to return 
        $data=mysqli_query($this->con,"SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");
        while ($row=mysqli_fetch_array($data)){
          $id=$row['id'];
          $body=$row['body'];
          $added_by=$row['added_by'];
          $date_time=$row['date_added'];
          //prepare user_to string so it can be included even if not posted to a user
          if ($row['user_to']=="none"){
            $user_to="";
          }
          else{
            $user_to_obj=new User($this->con,$row['user_to']);
            $user_to_name=$user_to_obj->getFirstAndLastName();
            $user_to="<a href-'".$row['user_to']."'>".$user_to_name."</a";
          }
          //check if user who posted has their accound closed"
          $added_by_obj=new User($this->con,$added_by);
          if($added_by_obj->isClosed()){
            continue;
          }
          else{
            $user_detail_query=mysqli_query($this->con,"SELECT fname,lname,profile_pic FROM username='$added_by'");
            $user_row=mysqli_fetch_array($user_detail_query);
          }
        }
            }
}







?>