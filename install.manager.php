<?php

// Doan ma nho giup cai dat file manger
// va luu vao 1 thu muc dinh san ($path)
// Yeu cau: ext-zip

$fileUrl = 'https://github.com/pmtpro/file-manager-php/archive/main.zip';
$saveTo = 'manager-' . time() . '.zip';
$path = './';
$pathUrl = 'file-manager-php-main';
$userAgent = 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36';

$fp = fopen($saveTo, "w+");
 
if ($fp === false) {
    echo 'Lỗi';
    exit;
}
 
$ch = curl_init($fileUrl);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_exec($ch);
 
if (curl_errno($ch)) {
    echo 'Lỗi';
    exit;
}
 
curl_close($ch);
fclose($fp);

$zip = new ZipArchive; 

$zip->open($saveTo); 
$zip->extractTo($path); 
$zip->close();

echo '<a href="' . $pathUrl . '/">OK!</a>';
