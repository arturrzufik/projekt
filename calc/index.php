<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator IP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/style-kalkulator.css">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style-button-hs.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <!-- MENU -->  
    <header>
        <nav class="navigation" id="panel-menu">
                    <img class="logo" src="photo/happyit.png" alt="WesolyInformatyk-logo">
    <div class="nav-menu-main">
            <a href="" class="menu">KALKULATOR IP</a>
            <a href="" class="menu">Q&A</a>
            <a href="" class="menu">ZAKRES MATERIAŁU</a>
    </div>
    <div>
        <span class="checkbox-container">
          <input class="checkbox-trigger" type="checkbox"  />
          <span class="menu-content">
              <ul>
                <li><a class="color-link-menu-sliding" href="">Profil</a></li>
                <li><a class="color-link-menu-sliding" href="">Zmień Hasło</a></li>
                <li><a class="color-link-menu-sliding" href="">Wyloguj się</a></li>
              </ul>
            <span class="hamburger-menu"></span>
            </div>
    </div>
        </nav>
    </header>

    <main>
    <div class="tresc-main">
                <h1 class="tytul-main">KALKULATOR IP</h1>
                </div>
    <div class="formularz" id="formularz">
            <div class="formularz-input">
                <form action="./" method="post">
                    <br><br><br>
                    
                    Podaj adres IP (IPv4) : <input class="css-input" name="ip1" type='number' min="0" max="255" size="2"> . <input class="css-input" name="ip2" type='number' min="0" max="255" size="2"> . <input class="css-input" name="ip3" type='number' min="0" max="255" size="2"> . <input class="css-input" name="test" type='number' min="0" max="255" size="2"><br /><br />
                    Podaj maskę: <input class="css-input" name="maska" type='number' min="8" max="32"> <button class="myButton-2 css-input" type="submit" id="btn-as"> Prześlij dane </button><br /><br />
                    <div class="przyciski">
                        <button class="myButton" type="button" id="btn-as" onclick= 'pokaTablice1()'> Adres sieciowy </button>
                         <button type="button" class="myButton" onclick= 'pokaTablice2()'> Adres Rozgłoszeniowy</button> 
                          <button type="button" class="myButton"> Ilość hostów </button></br>
                        <button type="button" class="myButton"> Ilość podsieci </button>
                         <button type="button" class="myButton"> Host min/max </button>
                          <button type="button" class="myButton"> Klasa sieci </button></br>
                        <button type="button" class="myButton-wszystko" id= "myButton-wszystko" onclick="myFunction()"> OBLICZ WSZYSTKO </button>

                    </div>
                </form>
                
            </div>
    </div>


    </main>
  <!-- USUWANIE BŁĘDów PHP -->
  <?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

?>


<!-- WYNIKI -->

<div class="tresc-main">
                <h1 class="tytul-main">WYNIKI</h1>
                </div>
<div class="formularz" id="formularz">

<?php
#Broadcast

        //zapobiegamy wyskakiwaniu błędów przed wprowadzeniem danych
        if(!empty($_POST)){
            

            //zapobiegamy wysyłaniu pustego formularza
            $errors = null;
            foreach($_POST as $k=>$v){
                $v = trim($v);
                if($v!= 0 and empty($v)) $errors .= "<b>Pola nie mogą być puste.<b><br>";
            }

            if(!is_null($errors)) echo $errors;
            else{



                //pobieramy ip z formularza
            $adresIP1 = $_POST["ip1"] . ".";
            $adresIP2 = $_POST["ip2"] . ".";
            $adresIP3 = $_POST["ip3"] . ".";
            $adresIP4 = $_POST["test"];

            $adresIP_calosc = ($adresIP1 . $adresIP2 . $adresIP3 . $adresIP4);
            $adresIP_rozdzielony = explode(".", $adresIP_calosc); //rozdzielamy pojedyncze bity
            
            


                //zamiana na INT i na liczbe binarna podzielona kropkami
            for ($j =0; $j < count($adresIP_rozdzielony); $j++){
                $int_adresIP_rozdzielony_binarnie[$j] = decbin($adresIP_rozdzielony[$j]);
            };


                // dodawanie 0 na poczatku by otrzymac 8 cyfr
            for($i=0; $i<4; $i++){        

                $ile = strlen($int_adresIP_rozdzielony_binarnie[$i]);
                while($ile<8){
                    $int_adresIP_rozdzielony_binarnie[$i] = ("0" . $int_adresIP_rozdzielony_binarnie[$i]);
                    $ile = strlen($int_adresIP_rozdzielony_binarnie[$i]);
                }
            };
                
            


                //laczenie pojedynczych bitow w caly adres IP
            $str_adresIP_polaczony_binarnie = implode(".", $int_adresIP_rozdzielony_binarnie);
    

                //wyswietlamy wynik
            // echo("Podany adres w wersji binarnej: " . $str_adresIP_polaczony_binarnie . " \n ");

        //zamiana maski na system binarny

                //pobieramy wprowadzona maske od uzytkownika
            $maska = $_POST["maska"];

                //zamieniamy maske na jedynki (wprowadzona maska = ilosc jedynek w zapisie)
            $maska_binarnie = 1;
            for($y=0; $y<($maska -1); $y++){
                $maska_binarnie = ($maska_binarnie . "1");
                
            };



                //zapelniamy maske zerami
            $ile_hostow = 0;

            for($z=0; strlen($maska_binarnie)<32; $z++){
                $maska_binarnie = ($maska_binarnie . "0");
                $ile_hostow ++;
            };

                //dzielimy maske binarnie
            $maska_binarnie_podzielona = wordwrap($maska_binarnie, 8, '.', 1);

                                 //zamiana maski na dziesietny
                            $tablica_maska_dziesietnie_podzielna = explode('.', $maska_binarnie_podzielona);

                            function maska_na_dziesietny($maskaID){
                                
                                for($i=0;$i<count($maskaID); $i++){
                                    $tablica_maska_dziesietnie_podzielona[$i] = bindec($maskaID[$i]);
                                }
                                $maska_dziesietnie_podzielona = implode(".", $tablica_maska_dziesietnie_podzielona);

                                return $maska_dziesietnie_podzielona;
                            }
            
            

            //AKAPIT
            // echo('<br />');
            // echo("\n Maska przedstawiona binarnie: " . $maska_binarnie_podzielona);
            // echo('<br />');
            // echo("Maska przedstawiona dziesietnie: " . maska_na_dziesietny($tablica_maska_dziesietnie_podzielna));

            //dzielimy sobie adres sieci i maskę na pojecyńcze cyfry
                $str_adresIP_polaczony_binarnie_bez_kropek = implode("", $int_adresIP_rozdzielony_binarnie);
                $pojedyncze_cyfry_ip = wordwrap($str_adresIP_polaczony_binarnie_bez_kropek, 1, ' ', 1);
                $pojedyncze_cyfry_maska = wordwrap($maska_binarnie, 1, ' ', 1);

                
                //AKAPIT
                echo('<br />');
                

            //wrzucamy pojedynce cyfry z maski i z adresu sieci do tablic
                $tablica_pojedyncze_cyfry_ip = explode(" ", $pojedyncze_cyfry_ip);
                $tablica_pojedyncze_cyfry_maska = explode(" ", $pojedyncze_cyfry_maska);


            //tworzymy tablice z wynikiem adresu sieci
            $adres_sieci_tablica = [];
            for($g = 0; $g<count($tablica_pojedyncze_cyfry_maska); $g++){

                    //proste kalkulacje binarne na kazdej pojedynczych wierszach
                if($tablica_pojedyncze_cyfry_ip[$g] == '1' and $tablica_pojedyncze_cyfry_maska[$g] == '1') $adres_sieci_tablica[$g] = '1';
                if($tablica_pojedyncze_cyfry_ip[$g] == '1' and $tablica_pojedyncze_cyfry_maska[$g] == '0') $adres_sieci_tablica[$g] = '0';
                if($tablica_pojedyncze_cyfry_ip[$g] == '0' and $tablica_pojedyncze_cyfry_maska[$g] == '1') $adres_sieci_tablica[$g] = '0';
                if($tablica_pojedyncze_cyfry_ip[$g] == '0' and $tablica_pojedyncze_cyfry_maska[$g] == '0') $adres_sieci_tablica[$g] = '0';


            }

                                                //tworzymy funkcje liczaca adresy binarnie, dzisiętnie oraz hosty min - max
                            function adres_binarnie($tablica1){

                                    //laczymy wynik mnozenia w tablice
                                $adres_polaczony = implode("", $tablica1);

                                    //dzielimy po 8 żeby wyglądało jak adres sieci z kropkami
                                $adres_binarnie = wordwrap($adres_polaczony, 8, '.', 1);

                                return $adres_binarnie;
                            }
                    
                    


                            function adres_dziesietnie($binarnie){
                                    //tworzymy 4 osobne tablice aby zmienić kod na dziesiętny
                                $adres_podzielony_po_8 = explode(".",$binarnie);

                                    //zmieniamy każdy z 4 osobnych wierszy na zapis dziesiętny
                                for($j = 0; $j<count($adres_podzielony_po_8); $j++){
                                    $adres_podzielony_po_8_dziesietnie[$j] = bindec($adres_podzielony_po_8[$j]);
                                }
                                    //laczymy wszystko w jeden dziesietny adres sieci podzielony kropkami
                                $adres_dziesietnie = implode(".", $adres_podzielony_po_8_dziesietnie);

                                return $adres_dziesietnie;
                            };

                            function klasa($dziesietny){
                                $adres_podzielony_po_8 = explode(".",$dziesietny);
                                if ($adres_podzielony_po_8[0] < '127') $klasa = "A";
                                elseif ($adres_podzielony_po_8[0] > '191') $klasa = "C";
                                else $klasa = "B";

                                return $klasa;
                            };


                            function host_min($dziesietnie_min){
                                $podzielony = explode(".", $dziesietnie_min);

                                $host_min = ($podzielony[0] .'.'. $podzielony[1] .'.'. $podzielony[2] .'.'. ($podzielony[3]+1));

                                return $host_min;
                            };

                            function host_max($dziesietnie_max){
                                $podzielony = explode(".", $dziesietnie_max);

                                $host_max = ($podzielony[0] .'.'. $podzielony[1] .'.'. $podzielony[2] .'.'. ($podzielony[3]-1));

                                return $host_max;
                            };


                    //przypisywanie funkcji do zmiennej
                    $adres_sieci_binarnie = adres_binarnie($adres_sieci_tablica);
                    $adres_sieci_dziesietnie = adres_dziesietnie($adres_sieci_binarnie);
                    $host_minimum = host_min($adres_sieci_dziesietnie);
                    $klasa_sieci = klasa($adres_sieci_dziesietnie);

                    //zmienna do przechowania danych
                    $dane_tablica_do_rozgłoszeniowego = $adres_sieci_tablica;

                    //zmiana w tablicy maski 0 na 1
                    for($y=0; $y<count($tablica_pojedyncze_cyfry_maska); $y++){
                        if($tablica_pojedyncze_cyfry_maska[$y] == '0') $dane_tablica_do_rozgłoszeniowego[$y] = '1';
                    };

                    //przypisywanie funkcji do zmiennej
                    $adres_rozgloszeniowy_binarnie = adres_binarnie($dane_tablica_do_rozgłoszeniowego);
                    $adres_rozgloszeniowy_dziesietnie = adres_dziesietnie($adres_rozgloszeniowy_binarnie);
                    $host_maksimum = host_max($adres_rozgloszeniowy_dziesietnie);

                    
                    function dzielone($host){

                        $host_podzielony = explode('.', $host);

                        for($i=0;$i<count($host_podzielony); $i++){
                            
                            $na_bin[$i] = decbin($host_podzielony[$i]);
                        };
                        
                        for($j=0;$j<4;$j++){
                            $ile = strlen($na_bin[$j]);
                            while($ile<8){
                                $na_bin[$j] = ("0" . $na_bin[$j]);
                                $ile = strlen($na_bin[$j]);
                            }
                        }

                        $host_binarnie = implode('.', $na_bin);

                        return $host_binarnie;
                    };

                    $host_minimum_binarnie = dzielone($host_minimum);
                    $host_maksimum_binarnie = dzielone($host_maksimum);
                    $maska_dziesietnie = maska_na_dziesietny($tablica_maska_dziesietnie_podzielna);
                    $hostow_w_sieci = (pow(2, $ile_hostow)-2);
        }
    }

    ?>
<script>
    function pokaTablice1(){
        document.getElementById("table1").style.display = "block";
    }
    function pokaTablice2(){
        document.getElementById("table2").style.display = "block";
    }
</script>
<table class="my-table" id="table1">
    <br>
  <thead>
    <tr>
      <th>       </th>
      <th class = "mniejszy">binarnie</th>
      <th class = "mniejszy">dziesiętnie</th>
    </tr>
  </thead>
  <tbody>

    
    <tr>
      <td id= 'adresSieci3'>Adres Sieci </td>
      <td class="srodek" id= 'adresSieci1'> <?php print_r($adres_sieci_binarnie); ?></td>
      <td class="srodek" id= 'adresSieci2'><?php print_r($adres_sieci_dziesietnie) ?></td>
    </tr>

    </tbody>  
</table>

<table class="my-table" id="table2">
    <br>
  <thead>
    <tr>
      <th>       </th>
      <th class = "mniejszy">binarnie</th>
      <th class = "mniejszy">dziesiętnie</th>
    </tr>
  </thead>
  <tbody>

    
    <tr>
      <td id= 'ar1' >Adres Rozgłoszeniowy </td>
      <td class="srodek" id= 'ar2'><?php print_r($adres_rozgloszeniowy_binarnie) ?></td>
      <td class="srodek" id= 'ar3'><?php print_r($adres_rozgloszeniowy_dziesietnie) ?></td>
    </tr>

    </tbody>  
</table>

    <!-- <tr>
      
    </tr>
    <tr>
      <td id= 'm1' >Maska</td>
      <td class="srodek" id= 'm2'><?php print_r($maska_binarnie_podzielona) ?></td>
      <td class="srodek" id= 'm3'><?php print_r($maska_dziesietnie) ?></td>
    </tr>
    
    <tr>
        <td id= 'h1'> Hostów w sieci </td>
        <td class="srodek" id= 'h2'><?php print_r($hostow_w_sieci) ?></td>
    </tr>
    <tr>
        <td id= 'k1'> Klasa sieci </td>
        <td class="srodek" id= 'k2'><?php print_r($klasa_sieci) ?></td>
    </tr>
    <tr>
      <td id= 'Hmin1'>Host min</td>
      <td class="srodek" id= 'Hmin2'><?php print_r($host_minimum_binarnie) ?></td>
      <td class="srodek" id= 'Hmin3'><?php print_r($host_minimum) ?></td>
    </tr>
    <tr>
      <td id= 'Hmax1'>Host max</td>
      <td class="srodek" id= 'Hmax2'><?php print_r($host_maksimum_binarnie) ?></td>
      <td class="srodek" id= 'Hmax3'><?php print_r($host_maksimum) ?></td>
    </tr> -->




</div>
<!-- STOPKA -->


<footer class="stopka">    
        <div> 
            <p class="kontaktfr"> &copy; WesolyInformatyk.pl 2023  &nbsp; | &nbsp; </p>
                 <p class="kontakt" href="kontakt.html"> Kontakt &nbsp; | &nbsp; </p>

                   <ab id="11fcv" href="facebook.com" class="fa fa-facebook">
                   </ab>
                   <ab id="11fcv" href="twitter.com" class="fa fa-twitter"> 
                   </ab> 
                   <ab id="11fcv" href="instagram.com" class="fa fa-instagram">
                   </ab> 
            
        </div>
    </footer>
</body>


</html>

