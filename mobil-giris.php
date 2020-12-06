<?php
header('Content-type: application/json');
include_once 'ayar.php';

if (!isset($_GET['ogrNo']) || !isset($_GET['ogrSifre'])) {
    $response[giris] = array(
        'giris' => false,
        'mesaj' => 'Öğrenci bilgileri alınırken hata oluştu'
        );
    echo json_encode($response);
} else {
    $ogrNo = $_GET["ogrNo"];
    $ogrSifre = $_GET["ogrSifre"];
    
    if ($ogrNo != '' && $ogrSifre != '') {
        $query = $db->prepare("SELECT * FROM ogrenci WHERE ogrencino =:a");
        $query->execute(array("a"=>$ogrNo));
        $rs = $query->fetch(PDO::FETCH_ASSOC);

        if ($ogrNo == $rs["ogrencino"] and $ogrSifre == $rs["sifre"]) {
            $_SESSION["ogr"] = true;
            $_SESSION["ogrID"] = $rs["id"];
            $_SESSION["ogrAd"] = $rs["ad"];
            $_SESSION["ogrSoyad"] = $rs["soyad"];

            $response[giris] = array(
            'giris' => true,
            'ogrID' => $rs["id"],
            'ogrAd' => $rs["ad"],
            'ogrSoyad' => $rs["soyad"],
            'ogrNo' =>$ogrNo
            );
            echo json_encode($response);
        } else {
            $response[giris] = array(
                'giris' => false,
                'mesaj' => 'Öğrenci no veya şifre hatalı.'
                );
            echo json_encode($response);
        }
    } else {
        $response[giris] = array(
            'giris' => false,
            'mesaj' => 'Öğrenci no ve şifre boş.'
            );
        echo json_encode($response);
    }
}
