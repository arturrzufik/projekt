<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator IP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="Formularz">
            <form action="./" method="post">
                <label class="tabelka_ip"> Podaj adres IP (IPv4) : </label> <input class="ip" name="ip" type='text'></label><br /><br />

                <label class="tabelka_maska"> Podaj maskę (8-32) : </label> <input class="maska" name="maska" type='number' min="8" max="32"></label><br />

                <button type="submit"> Oblicz</button>
            </form>
        </div>

        <div class= Rozwiazanie>

        </div>
    </main>


    <?php

        //zapobiegamy wyskakiwaniu błędów przed wprowadzeniem danych
        if(!empty($_POST)){

            //zapobiegamy wysyłaniu pustego formularza
            $errors = null;
            foreach($_POST as $k=>$v){
                $v = trim($v);
                if(empty($v)) $errors .= "Pola nie mogą być puste.<br>";
            }

            if(!is_null($errors)) echo $errors;
            else{



                //pobieramy ip z formularza
            $adresIP_calosc = $_POST["ip"];
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
            echo("Podany adres w wersji binarnej: " . $str_adresIP_polaczony_binarnie . " \n ");

        //zamiana maski na system binarny

                //pobieramy wprowadzona maske od uzytkownika
            $maska = $_POST["maska"];

                //zamieniamy maske na jedynki (wprowadzona maska = ilosc jedynek w zapisie)
            $maska_binarnie = 1;
            for($y=0; $y<($maska -1); $y++){
                $maska_binarnie = ($maska_binarnie . "1");
            };

                //zapelniamy maske zerami
            for($z=0; strlen($maska_binarnie)<32; $z++){
                $maska_binarnie = ($maska_binarnie . "0");
            };

            //AKAPIT
            echo('<br />');
            echo("\n Maska przedstawiona binarnie: " . $maska_binarnie);

            //dzielimy sobie adres sieci i maskę na pojecyńcze cyfry
                $str_adresIP_polaczony_binarnie_bez_kropek = implode("", $int_adresIP_rozdzielony_binarnie);
                $pojedyncze_cyfry_ip = wordwrap($str_adresIP_polaczony_binarnie_bez_kropek, 1, ' ', 1);
                $pojedyncze_cyfry_maska = wordwrap($maska_binarnie, 1, ' ', 1);

                
                //AKAPIT
                echo('<br />');
                

            //wrzucamy pojedynce cyfry z maski i z adresu sieci do tablic
                $tablica_pojedyncze_cyfry_ip = explode(" ", $pojedyncze_cyfry_ip);
                $tablica_pojedyncze_cyfry_maska = explode(" ", $pojedyncze_cyfry_maska);



            //tworzymy funkcje liczaca adres sieci w wersji binarnej oraz dziesietnej.
            function adres_sieci($ip, $maska){
                $adres_sieci_tablica = [];
                for($g = 0; $g<count($ip); $g++){
                        //proste kalkulacje binarne na kazdej pojedynczych wierszach
                    if($ip[$g] == '1' and $maska[$g] == '1') $adres_sieci_tablica[$g] = '1';
                    if($ip[$g] == '1' and $maska[$g] == '0') $adres_sieci_tablica[$g] = '0';
                    if($ip[$g] == '0' and $maska[$g] == '1') $adres_sieci_tablica[$g] = '0';
                    if($ip[$g] == '0' and $maska[$g] == '0') $adres_sieci_tablica[$g] = '0';

                }
                    //laczymy wynik mnozenia w tablice
                $adres_sieci_polaczony = implode("", $adres_sieci_tablica);

                    //dzielimy po 8 żeby wyglądało jak adres sieci z kropkami
                $adres_sieci_ostateczny = wordwrap($adres_sieci_polaczony, 8, '.', 1);

                    //tworzymy 4 osobne tablice aby zmienić kod na dziesiętny
                $adres_sieci_podzielony_po_8 = explode(".",$adres_sieci_ostateczny);

                    //zmieniamy każdy z 4 osobnych wierszy na zapis dziesiętny
                for($j = 0; $j<count($adres_sieci_podzielony_po_8); $j++){
                    $adres_sieci_podzielony_po_8_dziesietnie[$j] = bindec($adres_sieci_podzielony_po_8[$j]);
                }
                    //laczymy wszystko w jeden dziesietny adres sieci podzielony kropkami
                $adres_sieci_dziesietny_polaczony = implode(".", $adres_sieci_podzielony_po_8_dziesietnie);

                    //returnujemy nasz wynik
                return ('Adres sieci w wersji binarnej: ') . $adres_sieci_ostateczny . ('<br /> Adres sieci w wersji dziesiętnej: ') . $adres_sieci_dziesietny_polaczony;
            }

            //pobieramy funkcje do zmiennej
            $adres_sieci_tablica_wynik = adres_sieci($tablica_pojedyncze_cyfry_ip, $tablica_pojedyncze_cyfry_maska);














            print_r($adres_sieci_tablica_wynik);
        }
    }

    ?>

    
</body>


</html>

