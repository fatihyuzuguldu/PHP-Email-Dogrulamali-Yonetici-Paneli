<?php
// Sessiz harfler
$sessizler = array('b', 'c', 'd', 'f', 'g', 'h', 'k', 'm', 'n', 'p', 'r', 's', 't', 'v', 'y', 'z');

// Sesli harfler
$sesliler = array('a', 'e', 'i', 'o', 'u');

// Kelime havuzu oluşturma
$kelime_havuzu = array();
foreach ($sessizler as $sessiz) {
    foreach ($sesliler as $sesli) {
        foreach ($sessizler as $sessiz2) {
            foreach ($sesliler as $sesli2) {
                foreach ($sessizler as $sessiz3) {
                    $kelime =$sessiz .$sesli. $sessiz2 .'a' . 's';
                    array_push($kelime_havuzu, $kelime);

                }
            }
        }
    }
}

// Rastgele kelime seçme
for ($i = 0; $i < 100; $i++) {
    $rastgele_kelime = $kelime_havuzu[array_rand($kelime_havuzu)];
    echo $rastgele_kelime . ".com<br>";
}


