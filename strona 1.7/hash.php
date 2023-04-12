<?php

if(isset($_POST['haslo'])){
    $haslo = $_POST['haslo'];

    $hash = password_hash($haslo , PASSWORD_DEFAULT);

    echo 'zrobione: '.$hash;

}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>hashowanie hasel</title>
</head>
<body>
    <form method="post">
        Haslo:<input type="text" name="haslo"/><br/>
        <input type="submit" value="HASZUJ"/>
</form>
</body>
</html>