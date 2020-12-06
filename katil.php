<?php
header('Content-type: application/json');
include_once 'ayar.php';


    if (!isset($_GET['oturumid']) || !isset($_GET['ogrencino'])) {
        $response[yoklama] = array(
        'sonuc' => false,
        'mesaj' => 'Oturum veya öğrenci bilgisi alınırken hata oluştu'
    );
        echo json_encode($response);
    } else {
        $query = $db->prepare("SELECT oturum.durum FROM oturum WHERE oturum.id=?");
        $durum = $query->execute(array($_GET['oturumid']));
        if ($durum) {
            $aktiflik = $query-> fetch(PDO::FETCH_OBJ);
            $aktifMi = $aktiflik->durum;
            if ($aktifMi) {
                $yoklamaKayit = $db->prepare("INSERT INTO yoklama SET oturumid=?, ogrencino=?");
                $ekle = $yoklamaKayit->execute(array($_GET["oturumid"], $_GET['ogrencino']));
                if ($ekle) {
                    $yoklamaid = $db->lastInsertId();
                    $response[yoklama] = array(
                    'sonuc' => true,
                    'yoklamaID'=> $yoklamaid
                    );
                    echo json_encode($response);
                } else {
                    $response[yoklama] = array(
                    'sonuc' => false,
                    'mesaj' => 'Veritabanı sorgusu esnasında sorun meydana geldi'
                    );
                    echo json_encode($response);
                }
            } else {
                $response[yoklama] = array(
                'sonuc' => false,
                'mesaj' => 'Oturum Sonlandırılmış'
                );
                echo json_encode($response);
            }
        }
    }
