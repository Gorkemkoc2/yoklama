<?php

    require_once 'ayar.php';

    if (isset($_SESSION["ogr"]) || isset($_SESSION["aka"])) {
        header("Location: panel/");
    }

    function form_filtrele($post)
    {
        return is_array($post) ? array_map('form_filtrele', $post) : htmlspecialchars(trim($post));
    }

    $_POST = array_map('form_filtrele', $_POST);

    function post($name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
    }

    // ogrenci post edilmişse
    if (post('ogrenci')) {
        $ogrNo = $_POST["ogrNo"];
        $ogrSifre = $_POST["ogrSifre"];

        if (!$ogrSifre or !$ogrSifre) {
            echo 'Lütfen boş bırakmayın';
        } else {
            $query = $db->prepare("SELECT * FROM ogrenci WHERE ogrencino =:a");
            $query->execute(array("a"=>$ogrNo));
            $rs = $query->fetch(PDO::FETCH_ASSOC);

            if ($ogrNo == $rs["ogrencino"] and $ogrSifre == $rs["sifre"]) {
                echo "hoşgeldin, ".$rs["ad"];
                $_SESSION["ogr"] = true;
                $_SESSION["ogrID"] = $rs["id"];
                $_SESSION["ogrAd"] = $rs["ad"];
                $_SESSION["ogrSoyad"] = $rs["soyad"];
                header("Location: panel/");
            } else {
                echo "kullanıcı bulunamadı!";
            }
        }
    }

    //akademisyen post edilmişse
    if (post('akademisyen')) {
        $akaNo = $_POST["akaNo"];
        $akaSifre = $_POST["akaSifre"];

        if (!$akaNo or !$akaSifre) {
            echo 'Lütfen boş bırakmayın';
        } else {
            $query = $db->prepare("SELECT * FROM egitmen WHERE akaNo =:a");
            $query->execute(array("a"=>$akaNo));
            $rs = $query->fetch(PDO::FETCH_ASSOC);

            if ($akaNo == $rs["akaNo"] and $akaSifre == $rs["sifre"]) {
                echo "hoşgeldin, ".$rs["ad"];
                $_SESSION["aka"] = true;
                $_SESSION["akaID"] = $rs["id"];
                $_SESSION["akaAd"] = $rs["ad"];
                $_SESSION["akaSoyad"] = $rs["soyad"];
                header("Location: panel/");
            } else {
                echo "kullanıcı bulunamadı!";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="vendor/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="style.css" rel="stylesheet">
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/jquery.min.js"></script>
</head>
<body>
    <div class="container login-container">
        <h1 style="text-align: center;margin-bottom: 20px;">Lütfen Giriş Yapınız</h1>
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h3>Öğrenci Girişi</h3><!--
                <a href="<?php echo constant('site') . 'qr.php'?>"> Tıkla </a>-->
                <form method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="ogrNo" placeholder="Öğrenci No" value="" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="ogrSifre" placeholder="Şifre" value="" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="ogrenci" value="1">
                        <button type="submit" class="btnSubmit" name="ogrGiris" >Giriş</button>
                    </div>
                    <!--
                    <div class="form-group">
                        <a href="#" class="ForgetPwd">Forget Password?</a>
                    </div>
                    -->
                </form>
            </div>
            <div class="col-md-6 login-form-2">
                <h3>Eğitmen Girişi</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="akaNo" placeholder="Akademisyen Kimlik No" value="" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="akaSifre" placeholder="Şifre" value="" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="akademisyen" value="1">
                        <button type="submit" class="btnSubmit" name="akaGiris">Giriş</button>
                    </div>
                    <!--
                    <div class="form-group">
                        <a href="#" class="ForgetPwd" value="Login">Forget Password?</a>
                    </div>
                    -->
                </form>
            </div>
        </div>
    </div>
</body>
</html>