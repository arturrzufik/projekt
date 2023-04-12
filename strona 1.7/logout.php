<?php
session_start();

if(isset($_SESSION['logon']) && $_SESSION['logon'] == True){
  unset($_SESSION['logon']);
  unset($_SESSION['login']);
  $_SESSION['error'] = "Pomyślnie wylogowano!";
  header('Location: index_logowanie.php');
  exit();
}
else{
  $_SESSION['error'] = "Proszę się zalogować!";
  header('Location: index_logowanie.php');
  exit();
}

?>
