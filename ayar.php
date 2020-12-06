<?php

    define('site', 'http://localhost:8888/yoklama/');
    $siteadi = 'http://localhost:8888/yoklama/';

// veri tabanı bağlantısı
    $ip = "localhost:8889"; //host
    $user = "root";  // host id
    $password = "root";  // db şifresi
    $db = "yoklama"; // db adı
    
    //bağlantı
    try {
        $db = new PDO("mysql:host=$ip;dbname=$db", $user, $password);
        // türkçe karakter için utf8
        $db->exec("SET CHARSET UTF8");
        //eğer hata olursa pdo nun exception komutu ile ekrana yazdırıyoruz
    } catch (PDOException $e) {
        echo("Hata var");
    }
ob_start();
session_start();
