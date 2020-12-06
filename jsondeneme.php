<?php
//header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
    $response[giris] = array(
        'giris' => true,
        'ogrID' => 2,
        'ogrAd' => 'Görkem',
        'ogrSoyad' => 'Koç',
        'ogrNo' => 160805022
        );

echo json_encode($response);
