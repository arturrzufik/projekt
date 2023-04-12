<?php
session_start();

if(isset($_POST['login']) && isset($_POST['pass'])){
  if(strlen($_POST['login']) < 3 || strlen($_POST['pass']) < 3){
    $_SESSION['error'] = "Dane muszą mieć więcej niż 3 znaki!";
    header('Location: index_logowanie.php');
    exit();
  }
  else{
    $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
    $pass = $_POST['pass'];

    try{
      $connection = new mysqli("localhost", "root", "", "logowanie");

      if($connection->connect_errno != 0){
        throw new Excpetion(mysqli_connect_errno());
      }
      else{
        if($reply = mysqli_query($connection, "SELECT * FROM users WHERE login='$login'")){
          if($reply->num_rows > 0){
            $row = $reply->fetch_assoc();
            if(password_verify($pass, $row['pass'])){
              $_SESSION['logon'] = True;
              $_SESSION['login'] = $row['login'];

              $connection->close();
              header('Location: panel.php');
              exit();
            }
            else{
              $_SESSION['error'] = "Dane są nieprawidłowe!";
              header('Location: index_logowanie.php');
              exit();
            }
          }
          else{
            $_SESSION['error'] = "Dane są nieprawidłowe!";
            header('Location: index_logowanie.php');
            exit();
          }
        }
        else{
          $_SESSION['error'] = "Błąd zapytania bazy danych!";
          header('Location: index_logowanie.php');
          exit();
        }
      }
    }
    catch(Exception $e){
      $_SESSION['error'] = "Błąd bazy danych!";
      header('Location: index_logowanie.php');
      exit();
    }
  }
}
else{
  $_SESSION['error'] = "Proszę wprowadzić dane!";
  header('Location: index_logowanie.php');
  exit();
}
?>
