<?php
session_start();
if(isset($_SESSION['logon']) && $_SESSION['logon'] == True){
    header('Location: panel.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="CSS/logowanie.css" />
        <link rel="stylesheet" href="CSS/header.css">
        <title>Login</title>
    </head>
        <div class="bg" aria-hidden="true">
            <div class="bg__dot"></div>
            <div class="bg__dot"></div>
        </div>
        <form method="post" action="login.php" class="form" autocomplete="off">
            <div class="form__icon" aria-hidden="true"></div>
            <div class="form__input-container">
                <input class="form__input" type="text" name="login"  placeholder=" "/>
                <label class="form__input-label" for="login">Nazwa</label>
            </div>
            <div class="form__input-container">
                <input class="form__input" name="pass" type="password" placeholder=" "
                />
                <label class="form__input-label" for="pass">Hasło</label>
            </div>
            <div class="form__spacer" aria-hidden="true"></div>
            <input type="submit" class="form__button" value="zaloguj się">
        </form>
        <?php
        if(isset($_SESSION['error'])){
            echo'<span class="error-login">'.$_SESSION['error'].'</span>';
            unset($_SESSION['error']);
        }
        ?>
    </body>
</html>
