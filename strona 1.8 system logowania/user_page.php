<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <link rel="stylesheet" href="css/style-login.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Panel <span>Użytkownika</span></h3>
      <h1>Cześć <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p class="sdfdfdsfdsf">Znajdujesz się na profilu użytkownika</p>
      <a href="login_form.php" class="btn">Logowanie</a>
      <a href="index.html" class="btn">Strona główna</a>
      <a href="logout.php" class="btn">Wyloguj</a>
   </div>

</div>

</body>
</html>