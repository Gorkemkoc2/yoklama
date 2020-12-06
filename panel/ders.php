<?php

include_once 'header.php';
include_once 'theme.php';
$islem='';
$islem= $_GET[islem];

if (!isset($_SESSION["aka"])) { ?>
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
} else {
    if (isset($_POST["dersKayit"])) {
        $query = $db->prepare("INSERT INTO dersler SET adi=?");
        $ekle = $query->execute(array($_POST["dersAdi"]));
        if ($ekle) {
            $sonuc='Ders Başarıyla Eklendi.';
        } else {
            $sonuc='Ders Kaydı Eklenemedi.';
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
                        <h3>Ders Ekle</h3>
                    </div>
                    <div class="row" style="margin-top:25px">
                        <div class="col-md-12">
                            <form method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text"  name="dersAdi" class="form-control" placeholder="Ders Adı"/>
                                    </div>
                            </div>
                                <div class="col-sm-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="dersKayit" >Kaydet</button>
                                </div>
                                <div style="text-align: center;">
                                <?php if (isset($sonuc)): echo $sonuc; endif; ?>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    break;
    case 'listele':

        $query=$db->prepare('SELECT * FROM dersler ORDER BY id DESC');
        $query->execute();
        $dersler=$query-> fetchAll(PDO::FETCH_OBJ); ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Dersler</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Ders Adı</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>Ders Adı</th>
            </tr>
          </tfoot>
          <tbody>
        <?php
            foreach ($dersler as $ders) {?>
                <tr>
                <td style="text-transform: capitalize;"><?= $ders->adi ?></td>
                </tr>
        <?php } ?>
          </tbody>
        </table>
    </div>
</div>
</div>
<?php
    break;
}

    include_once 'footer.php';
}
