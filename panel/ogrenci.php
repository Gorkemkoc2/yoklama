<?php
include_once 'header.php';
include_once 'theme.php';

$islem = '';
$islem = $_GET[islem];
if (isset($_SESSION['aka'])) {
    if (isset($_POST['ogrKayit'])) {
        if (!isset($_POST['txtAdi']) || !isset($_POST['txtSoyadi']) || !isset($_POST['txtOgrNo'])|| !isset($_POST['txtSifre']) || !isset($_POST['txtSifretekrar']) || !isset($_POST['txtAdi']) || !isset($_POST['txtMail'])) {
            $sonuc = 'Lütfen boş alan bırakmayın';
        } else {
            if ($_POST['txtSifre'] != $_POST['txtSifretekrar']) {
                $sonuc = 'Şifreler uyuşmuyor.';
            } else {
                $query = $db->prepare("INSERT INTO ogrenci SET 
                ogrencino=?, 
                sifre =?,
                mail=?,
                ad=?,
                soyad=?
                ");
                $ekle = $query->execute(array(
                    $_POST["txtOgrNo"],
                    $_POST["txtSifre"],
                    $_POST["txtMail"],
                    $_POST["txtAdi"],
                    $_POST["txtSoyadi"],
                ));
                if ($ekle) {
                    $sonuc = 'İşlem Başarılı';
                } else {
                    $sonuc='Veriler eklenirken bir sorun oluştu.';
                }
            }
        }
    }
    switch ($islem) {
    case '':
    case 'ekle': ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="sub-title">
                        <h3>Öğrenci Ekle</h3>
                    </div>
                    <div class="row" style="margin-top:25px">
                        <div class="col-md-12">
                            <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text"  name="txtAdi" class="form-control" placeholder="Ad"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text"  name="txtSoyadi" class="form-control" placeholder="Soyad" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text"  name="txtOgrNo" class="form-control" placeholder="Öğrenci No" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="password"  name="txtSifre" class="form-control" placeholder="Şifre" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="password"  name="txtSifretekrar" class="form-control" placeholder="Şifre Tekrar" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="email"  name="txtMail" class="form-control" placeholder="E-Mail" />
                                    </div>
                                </div>
                            </div>
                                <div class="col-sm-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="ogrKayit" >Kaydet</button>
                                </div>
                                </div>
                            </form>
                            <div style="text-align:center;color:#e74a3b;">
                                <?php if (isset($sonuc)) : echo $sonuc; endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    <?php
    break;
    case 'listele':
        $query=$db->prepare('SELECT * FROM ogrenci ORDER BY id DESC');
        $query->execute();
        $ogrenciler=$query-> fetchAll(PDO::FETCH_OBJ);
    ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Öğrenciler</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Ad</th>
                      <th>Soyad</th>
                      <th>Öğrenci No</th>
                      <th>Mail</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Öğrenci No</th>
                        <th>Mail</th>
                    </tr>
                  </tfoot>
                  <tbody>
                <?php
                    foreach ($ogrenciler as $ogrenci) {?>
                        <tr>
                        <td style="text-transform: capitalize;"><?= $ogrenci->ad ?></td>
                        <td style="text-transform: capitalize;"><?= $ogrenci->soyad ?></td>
                        <td><?= $ogrenci->ogrencino ?></td>
                        <td><?php echo '<a href="mailto:' . $ogrenci->mail . '">' . $ogrenci->mail .'</a>';?></td>
                        </tr>
                        
                <?php } ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php break;
}
} else { ?>
    <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <span style="text-color:warning"> Giriş Yetkiniz Yok</span>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <?php
}

include_once 'footer.php';
