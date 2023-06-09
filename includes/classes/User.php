<?php
class User{
      private $user;
      private $con;
      public function __construct($con, $user)
       {
          $this->con = $con;
          if (!empty($user)) {
              $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
              if ($user_details_query && mysqli_num_rows($user_details_query) > 0) {
                  $this->user = mysqli_fetch_array($user_details_query);
              } else {
                  $this->user = array();
              }
          } else {
              $this->user = array();
          }
       }

      public function getUsername(){
        return $this->user['username'];
      }
      public function getNumPosts(){
        $username=$this->user['username'];
        $query=mysqli_query($this->con,"SELECT num_posts FROM users WHERE username='$username'");
        $row=mysqli_fetch_array($query);
        return $row['num_posts'];
      }
      public function getFirstAndLastName(){
        $username=$this->user['username'];
        $query=mysqli_query($this->con,"SELECT fname , lname FROM users WHERE username='$username'");
        $row=mysqli_fetch_array($query);
        return $row['fname']." ".$row['lname'];
      }
      public function isClosed()
      {
        $username=$this->user['username'];
        $query=mysqli_query($this->con,"SELECT user_closed FROM users WHERE username='$username'");
        $row=mysqli_fetch_array($query);
        if($row['user_closed']=='yes'){
          return true;
        }
        else{
          return false;
        }
      }
      public function isFriend($username_to_check){
        $username_comma="," . $username_to_check . ",";
        if(strstr($this->user['friend_array'],$username_comma) || $username_to_check==$this->user['username']){
          return true;
        }else{
          return false;
        }
      }
}







?>