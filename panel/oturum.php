<?php
include_once 'header.php';
include_once 'theme.php';
$islem = '';
$islem = $_GET[islem];
if (isset($_SESSION["aka"])) {
    if (isset($_GET['goster'])) { ?>
        <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="sub-title">
                            <h3>Oturuma Katıl</h3>
                        </div>
                        <div class="row" style="margin-top:25px">
                            <div class="col-md-12">
                                <img src="<?php echo "../qr.php?boyut=300&oturumid=" . $_GET['goster'] ?>" alt="DersQR"> 
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
    <?php
    } elseif (isset($_POST["baslat"])) {
        $query = $db->prepare("INSERT INTO oturum SET dersid=?, egitmenid=?");
        $ekle = $query->execute(array($_POST["ders"],$_SESSION["akaID"]));
        if ($ekle) {
            $oturumid = $db->lastInsertId(); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="sub-title">
                            <h3>Oturum Başlatıldı</h3>
                        </div>
                        <div class="row" style="margin-top:25px">
                            <div class="col-md-12">
                                <img src="<?php echo "../qr.php?boyut=300&oturumid=" . $oturumid ?>" alt="DersQR"> 
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div><?php
        }
    } else {
        switch ($islem) {
        case '':
        case baslat: ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="sub-title">
                            <h3>Oturum Başlat</h3>
                        </div>
                        <div class="row" style="margin-top:25px">
                            <div class="col-md-12">
                                <form method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Ders Seçiniz:
                                                </div>
                                                <div class="col-md-8">
                                                    <?php
                                                        try {
                                                            $sql = "SELECT * FROM dersler ORDER BY id DESC";
                                                            $sonuckod = $db->query($sql); //Database bağlantı kodumuzda bağlantıyı sağlayan değişken adı
                                                            $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                                            
                                                            echo '<select name="ders" style="width:100%;" >'; //Post olacak alanın ismi ders
                                                
                                                            while ($row = $sonuckod->fetch()) {
                                                                echo '<option value="'.$row['id'].'">'.$row['adi'].'</option>'; //value alanında idyi yazıp post olacak değerin bu id olacağını belirtiyoruz. Diğer isim alanı kullanıcıya gösterilecek alan
                                                            }
                                                
                                                            echo '</select>';
                                                        } catch (PDOException $e) {
                                                            die("Database bağlantı hatası" . $e->getMessage());
                                                        } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="baslat">Başlat</button>
                                </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        <?php
        break;
        case listele:
                $query=$db->prepare('SELECT oturum.id, dersler.adi as dersadi, egitmen.ad as egitmenAd, egitmen.soyad as egitmenSoyad
                FROM oturum
                INNER JOIN dersler ON oturum.dersid = dersler.id
                INNER JOIN egitmen ON oturum.egitmenid = egitmen.id
                WHERE oturum.egitmenid=?');
                $query->execute(array($_SESSION['akaID']));
                $oturumlar=$query-> fetchAll(PDO::FETCH_OBJ); ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Oturumlar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Ders Adı</th>
                      <th>Eğitmen</th>
                      <th>QR Göster</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Ders Adı</th>
                        <th>Eğitmen</th>
                        <th>QR Göster</th>
                    </tr>
                  </tfoot>
                  <tbody>
                <?php
                    foreach ($oturumlar as $oturum) {?>
                        <tr>
                        <td style="text-transform: capitalize;"><?= $oturum->dersadi ?></td>
                        <td style="text-transform: capitalize;"><?=$oturum->egitmenAd . ' ' . $oturum->egitmenSoyad?></td>
                        <td  style="margin: 5px; text-align:center;"><a style="color: primary;" href="<?php echo '../panel/oturum.php?goster=' . $oturum->id ?>">QR Göster</a></td>
                        </tr>
                <?php } ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
            }
    }
} else {
    if (isset($_SESSION['ogr'])) {
        $query=$db->prepare('SELECT yoklama.id, dersler.adi as dersadi, egitmen.ad as egitmenAd, egitmen.soyad as egitmenSoyad, yoklama.timestamp as tarih
        FROM yoklama
        INNER JOIN oturum ON yoklama.oturumid = oturum.id
        INNER JOIN egitmen ON oturum.egitmenid = egitmen.id
        INNER JOIN dersler ON oturum.dersid = dersler.id
        INNER JOIN ogrenci ON yoklama.ogrencino = ogrenci.ogrencino
        WHERE ogrenci.id=?');
        $query->execute(array($_SESSION['ogrID']));
        $yoklamalar=$query-> fetchAll(PDO::FETCH_OBJ); ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Katıldığım Dersler</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Ders Adı</th>
                        <th>Eğitmen</th>
                        <th>Tarih</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Ders Adı</th>
                        <th>Eğitmen</th>
                        <th>Tarih</th>
                    </tr>
                  </tfoot>
                  <tbody>
                <?php
                    foreach ($yoklamalar as $yoklama) {?>
                        <tr>
                        <td><?= $yoklama->dersadi ?></td>
                        <td style="text-transform: capitalize;"><?= $yoklama->egitmenAd . ' ' . $yoklama->egitmenSoyad ?></td>
                        <td><?= $yoklama->tarih ?></td>
                        </tr>
                <?php } ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    }
}
include_once 'footer.php';
