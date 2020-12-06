<?php
require_once 'ayar.php';
require_once "vendor/autoload.php";

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

if (!$_GET[boyut]) {
    $boyut=250;
} else {
    $boyut=$_GET[boyut];
}

    $qrString = 'https://gorkemkoc.net/jsondeneme.php';
    $qrCode = new QrCode($qrString);
    $qrCode->setSize($boyut);
    //$qrCode->setWriterByName('png');
    //$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
    //$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 255]);
    header('Content-Type: '.$qrCode->getContentType());
    echo $qrCode->writeString();
