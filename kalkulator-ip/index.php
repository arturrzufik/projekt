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
            echo('<br />');
            echo("\n Maska przedstawiona binarnie: " . $maska_binarnie_podzielona);
            echo('<br />');
            echo("Maska przedstawiona dziesietnie: " . maska_na_dziesietny($tablica_maska_dziesietnie_podzielna));

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



            //drukujemy wynik
            print_r("<br /> Adres sieci binarnie: " . $adres_sieci_binarnie);
            print_r("<br /> Adres sieci dziesietnie: " . $adres_sieci_dziesietnie);
            print_r("<br />");

            print_r("<br /> Adres rozgłoszeniowy binarnie: " . $adres_rozgloszeniowy_binarnie);
            print_r("<br /> Adres rozgłoszeniowy dziesietnie: " . $adres_rozgloszeniowy_dziesietnie);
            print_r("<br />");

            print_r("<br /> Maksymalna ilość adresów: " . pow(2, $ile_hostow));
            print_r("<br /> Maksymalna ilość hostów: " . pow(2, $ile_hostow)-2);
            print_r("<br /> Ilość hostów w sieci: " . 2);
            print_r("<br /> Host min: " . $host_minimum);
            print_r("<br /> Host max: " . $host_maksimum);
            print_r("<br />");
            
                    




        }
    }

    ?>

    
</body>


</html>

