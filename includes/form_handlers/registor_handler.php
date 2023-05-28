<?php
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
  
  //profile picture assignment
  $random=rand(1,2);
  if ($random==1){
    $profile_pic="assets/images/profile_pic/default/head_deep_blue.png";
  }
  elseif($random==2){
    $profile_pic="assets/images/profile_pic/default/head_green_sea.png";
  }
  $query=mysqli_query($con,"INSERT INTO users VALUES('','$fname','$lname','$username','$email','$password','$date','$profile_pic','0','0','no',',')");
  array_push($error_array,"<span style='color:#14c800;'>Registered successfully! Go head and login!</span><br>");
  //clearing session
  $_SESSION['reg_fname']="";
  $_SESSION['reg_lname']="";
  $_SESSION['reg_email']="";
  $_SESSION['reg_email2']="";
}

}
?>
