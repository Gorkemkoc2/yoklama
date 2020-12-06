<?php
include_once 'header.php';
include_once 'theme.php';
?>

<div class="col-md-12">
    <h1> Hoş Geldin, <?php
        if (isset($_SESSION["ogr"])) {
            echo $_SESSION["ogrAd"] ." " . $_SESSION["ogrSoyad"];
        }
        if (isset($_SESSION["aka"])) {
            echo $_SESSION["akaAd"] . " " . $_SESSION["akaSoyad"];
        }
        ?>
    </h1>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<p>
        Kırıkkale Üniversitesi, Bilgisayar ve Öğretim Teknolojileri Eğitimi Bölümü 
        Grafik Tasarım dersi için <a href="https://gorkemkoc.net" target="_blank">Görkem Koç</a> tarafından hazırlanmıştır. </br></br>

        Kullanılan Teknolojiler: </br>
        <ul>
            <li><b> Website görsel yönü:</b> HTML, CSS ve JavaScript</li>
            <li><b> JavaScript Kütüphanesi:</b> JQuery ve DataTables bileşenleri</li>
            <li><b> Website Arkaplanı:</b> PHP programlama ve Veritabanı Bağlantısı için PDO Kütüphanesi. QR kod için Endroid-QR kütüphanesi.</li>
            <li><b> Veri Depolama:</b> MySQL, MariaDB</li>
            <li><b> Mobil Uygulama:</b> MIT AppInventor</li>
            <li><b> Mobil Uygulama ile sunucu arası iletişim:</b> Veriler JSON formatında sunucuda oluşturulup mobil uygulamaya gönderildi.</li>
        </ul>
        
</p>
</div>
<div class="col-md-2"></div>
</div>
<?php include_once 'footer.php' ?>
