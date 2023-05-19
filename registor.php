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
    <input type="password" name="reg_password" placeholder="Enter password" required>
    <br>
    <input type="password" name="reg_password2" placeholder="confirm password" required>
    <br>
    <input type="submit" name="reg_button" value="Registor" required>
  </form>  
</body>
</html>