<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="pl">
<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="CSS/logowanie.css" />
        <title>Login</title>
    </head>
        <div class="bg" aria-hidden="true">
            <div class="bg__dot"></div>
            <div class="bg__dot"></div>
        </div>
        <form method="post" action="" class="form" autocomplete="on">
            <div class="form__icon" aria-hidden="true"></div>
            <div class="form__input-container">
                <input class="form__input" type="email" name="email" required  placeholder=" "/>
                <label class="form__input-label" for="login">e-mail</label>
            </div>
            <div class="form__input-container">
                <input class="form__input" name="password" type="password" required  placeholder=" "
                />
                <label class="form__input-label" for="pass">Hasło</label>
            </div>
            <div class="form__spacer" aria-hidden="true"></div>
            <input type="submit" name="submit" class="form__button" value="zaloguj się">
            <p>Nie masz konta?<a href="register_form.php">  Zrejestruj się!</a></p>
        </form>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-login">'.$error.'</span>';
         };
      };
      ?>
</div>

</body>
</html>