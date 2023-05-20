<?php
session_start();
$con=mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()){
  echo "faild to connect:".mysqli_connect_errno();
}
//declear variable
$fname="";
$lname="";
$email="";
$email2="";
$password="";
$password2="";
$date="";
$error_array=array(); //holds error message
if (isset($_POST['reg_button'])){
  //firstname
  $fname=strip_tags($_POST['reg_fname']);//remove tags
  $fname=str_replace(' ','',$fname);//remove space
  $fname=ucfirst(strtolower($fname));//convert to lowercase and capitalize the first letter
  $_SESSION['reg_fname']=$fname;//storing first name into session variable
  //lastname
  $lname=strip_tags($_POST['reg_lname']);
  $lname=str_replace(' ','',$lname);
  $lname=ucfirst(strtolower($lname));
  $_SESSION['reg_lname']=$lname;//storing last name into session variable
  //email
  $email=strip_tags($_POST['reg_email']);
  $email=str_replace(' ','',$email);
  $email=ucfirst(strtolower($email));
  $_SESSION['reg_email']=$email;//storing email into session variable
  //email2
  $email2=strip_tags($_POST['reg_email2']);
  $email2=str_replace(' ','',$email2);
  $email2=ucfirst(strtolower($email2));
  $_SESSION['reg_email2']=$email2;//storing email2 into session variable
  //password
  $password=strip_tags($_POST['reg_password']);
  $password2=strip_tags($_POST['reg_password2']);
  //date
  $date=date("Y-m-d");//current date

  //checking the email is match
  if ($email==$email2){
       //checking if the email is invalid format
       if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email=filter_var($email,FILTER_VALIDATE_EMAIL);
        //check if email already exist
        $email_check=mysqli_query($con,"SELECT email FROM users WHERE email='$email' ");
        $num_rows=mysqli_num_rows($email_check);
        if ($num_rows>0){
          array_push($error_array,"Email already in use <br>");
        }
       }
       else{
        array_push($error_array, "Invalid format <br>");
       }
  }
  else{
    array_push($error_array, "Emails don't match<br>");
  }
  if(strlen($fname)>25||strlen($fname)<2){
    array_push($error_array,"your first name must be between 2 and 25<br>");
  }
  if(strlen($lname)>25||strlen($lname)<2){
    array_push($error_array, "your last name must be between 2 and 25<br>");
  }
  if($password != $password2){
    array_push($error_array, "your password do not match<br>");
  }
  else{
    if (preg_match('/[^A-Za-z0-9]/',$password)){
      array_push($error_array, "your password only can contain engilsh character or numbers<br>");
    }
  }
  if (strlen($password)>30 || strlen($password)<5){
    array_push($error_array, "your password must be betwee 5 and 30<br>");
  }
  if(empty($error_array)){
    $password=md5($password);//encript the password before sending to the database
    //generate username by concatentaing first name and last name
    $username=strtolower($fname." " .$lname);
    $check_username_query=mysqli_query($con,"SELECT username FROM users WHERE username='$username' ");
    $i=0;
    //if username exist add number to username
    while(mysqli_num_rows($check_username_query)!=0){
      $i++;
      $username=$username."_".$i;
      $check_username_query=mysqli_query($con,"SELECT username FROM users WHERE username='$username' ");
    }
  }
  //profile picture assignment
  $random=rand(1,2);
  if ($random==1){
    $profile_pic="assets\images\profile_pic\default/head_deep_blue.png";
  }
  elseif($random==2){
    $profile_pic="assets\images\profile_pic\default/head_green_sea.png";
  }


}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registor</title>
</head>
<body>
  <form action="registor.php" method="post">
    <input type="text" name="reg_fname" placeholder="First Name" value="<?php
       if(isset($_SESSION['reg_fname'])){
        echo $_SESSION['reg_fname'];
       };?>" required>
    <br>
    <?php 
    if (in_array("your first name must be between 2 and 25<br>",$error_array))echo "your first name must be between 2 and 25<br>";
    ?>
    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
       if(isset($_SESSION['reg_lname'])){
        echo $_SESSION['reg_lname'];
       };?>" required>
    <br>
    <?php
    if (in_array("your last name must be between 2 and 25<br>",$error_array))echo "your last name must be between 2 and 25<br>";
    ?>
    <input type="email" name="reg_email" placeholder="email" value="<?php
       if(isset($_SESSION['reg_email'])){
        echo $_SESSION['reg_email'];
       };?>" required>
    <br>
    
    <input type="email" name="reg_email2" placeholder="confirm email" value="<?php
       if(isset($_SESSION['reg_email2'])){
        echo $_SESSION['reg_email2'];
       };?>" required>
    <br>
    <?php
    if (in_array("Email already in use <br>",$error_array))echo "Email already in use <br>";
    else if(in_array("Invalid format <br>",$error_array))echo "Invalid format <br>";
    else if(in_array("Emails don't match",$error_array))echo "Emails don't match<br>";
    ?>
    
    <input type="password" name="reg_password" placeholder="Enter password" required>
    <br>
    <input type="password" name="reg_password2" placeholder="confirm password" required>
    <br>
    <?php 
     if (in_array("your password do not match<br>",$error_array))echo "your password do not match<br>";
     else if(in_array("your password only can contain engilsh character or numbers<br>",$error_array))echo "your password only can contain engilsh character or numbers<br>";
     else if(in_array("your password must be betwee 5 and 30<br>",$error_array)) echo "your password must be betwee 5 and 30<br>";
     ?>
    <input type="submit" name="reg_button" value="Register" required>
  </form>  
</body>
</html>