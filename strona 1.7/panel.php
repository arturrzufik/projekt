<?php
session_start();

if(isset($_SESSION['logon']) && $_SESSION['logon'] == True){
  echo '<h1>Witaj, '.$_SESSION['login'].'</h1><br/><a href="logout.php">Wyloguj się</a>';
}
else{
  $_SESSION['error'] = "Proszę się zalogować!";
  header('Location: index_logowanie.php');
  exit();
}
?>
