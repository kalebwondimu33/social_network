<?php
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
$error_array=""; //holds error message
if (isset($_POST['reg_button'])){
  //firstname
  $fname=strip_tags($_POST['reg_fname']);//remove tags
  $fname=str_replace(' ','',$fname);//remove space
  $fname=ucfirst(strtolower($fname));//convert to lowercase and capitalize the first letter
  //lastname
  $lname=strip_tags($_POST['reg_lname']);
  $lname=str_replace(' ','',$lname);
  $lname=ucfirst(strtolower($lname));
  //email
  $email=strip_tags($_POST['reg_email']);
  $email=str_replace(' ','',$email);
  $email=ucfirst(strtolower($email));
  //email2
  $email2=strip_tags($_POST['reg_email2']);
  $email2=str_replace(' ','',$email2);
  $email2=ucfirst(strtolower($email2));
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
          echo "Email already in use";
        }
       }
       else{
        echo "Invalid format";
       }
  }
  else{
      echo "Emails don't match";
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
    <input type="text" name="reg_fname" placeholder="First Name" required>
    <br>
    <input type="text" name="reg_lname" placeholder="Last Name" required>
    <br>
    <input type="email" name="reg_email" placeholder="email" required>
    <br>
    <input type="email" name="reg_email2" placeholder="confirm email" required>
    <br>
    <input type="password" name="reg_password" placeholder="Enter password" required>
    <br>
    <input type="password" name="reg_password2" placeholder="confirm password" required>
    <br>
    <input type="submit" name="reg_button" value="Register" required>
  </form>  
</body>
</html>