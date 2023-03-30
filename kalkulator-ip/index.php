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

                <label class="tabelka_maska"> Podaj maskę (8-32) : </label> <input class="maska" type='number' min="8" max="32"></label><br />

                <button type="submit"> Oblicz</button>
            </form>
        </div>

        <div class= Rozwiazanie>

        </div>
    </main>


    <?php
        $adresIP_calosc = $_POST["ip"];
        $adresIP_rozdzielony = explode(".", $adresIP_calosc); //rozdzielanie kropek

        // $int_adresIP_rozdzielony = (int)$adresIP_rozdzielony;       //zamiana na INT i na liczbę binarną podzieloną kropkami
        for ($j =0; $j < count($adresIP_rozdzielony); $j++){
            $int_adresIP_rozdzielony_binarnie[$j] = decbin($adresIP_rozdzielony[$j]);
        }


        for($i=0; $i<count($int_adresIP_rozdzielony_binarnie); $i++){                                           // dodawanie 0 na poczatku by otrzymac 8 cyfr
            do{
                $int_adresIP_rozdzielony_binarnie[$i] = ("0" . $int_adresIP_rozdzielony_binarnie[$i]);
            }
            while(strlen($int_adresIP_rozdzielony_binarnie[$i])<8);
        }

        // print_r($int_adresIP_rozdzielony_binarnie);

        $str_adresIP_polaczony_binarnie = implode(".", $int_adresIP_rozdzielony_binarnie);
        
        echo("Podany adres w wersji binarnej: " . $str_adresIP_polaczony_binarnie);
    ?>

    
</body>


</html>

