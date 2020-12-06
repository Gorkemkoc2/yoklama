<?php

require_once 'ayar.php';

function girisYap($kadi, $sifre, $unvan)
{
    $query = $db->query("SELECT * FROM $unvan WHERE ogrencino='$kadi' && sifre='$sifre'", PDO::FETCH_ASSOC);
    if ($say = $query -> rowCount()) {
        if ($say > 1) {
            session_start();
            $_SESSION['oturum']=true;
            header("Location: panel/");
        } else {
            echo "oturum açılmadı hata";
        }
    }
}


    girisYap(160805022, 123456, "ogrenci");
