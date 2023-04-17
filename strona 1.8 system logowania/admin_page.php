<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/css/style-login.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Admin <span>Panel</span></h3>
      <h1>Cześć <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p class="sdfdfdsfdsf">Znajdujesz się w panelu administratora</p>
      <a href="login_form.php" class="btn">Logowanie</a>
      <a href="index.html" class="btn">Strona główna</a>
      <a href="logout.php" class="btn">Wyloguj</a>
   </div>

</div>

</body>
</html>