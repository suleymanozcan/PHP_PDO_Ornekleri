<?php
function createPermalink($str) {
    // Büyük harfleri küçük harflere çevir
    $str = mb_strtolower($str, 'UTF-8');
    // Türkçe karakterleri İngilizce karşılıklarına dönüştür
    $search = array('ı', 'ğ', 'ü', 'ş', 'ö', 'ç', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç');
    $replace = array('i', 'g', 'u', 's', 'o', 'c', 'i', 'g', 'u', 's', 'o', 'c');
    $str = str_replace($search, $replace, $str);
    // Özel karakterleri kaldır ve boşlukları "-" ile değiştir
    $str = preg_replace('/[^a-zA-Z0-9\s]/', '', $str);
    $str = str_replace(' ', '-', $str);
    return $str;
}
function image_upload(){
    $izin_verilen_turler    = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/webp');
    $dosya_adi 		        = $_FILES['image']['name'];
    $dosya_boyutu 	        = $_FILES['image']['size'];
    $dosya_turu 	        = $_FILES['image']['type'];
    $tmp_dosya_adi 	        = $_FILES['image']['tmp_name'];
    $izin_verilen_uzantilar = array('jpeg', 'jpg', 'png', 'webp');
    $uzanti                 = strtolower(pathinfo($dosya_adi, PATHINFO_EXTENSION));
    $finfo                  = finfo_open(FILEINFO_MIME_TYPE);
    $gercek_tur             = finfo_file($finfo, $tmp_dosya_adi);
    finfo_close($finfo);

    if (!in_array($uzanti, $izin_verilen_uzantilar)) {
        // Geçersiz dosya uzantısı hatası
        return "none.png";
    } elseif (!in_array($gercek_tur, $izin_verilen_turler)) {
        // Geçersiz dosya türü hatası
        return "none.png";
    } elseif (!in_array($dosya_turu, $izin_verilen_turler)) {
        // Geçersiz dosya türü hatası
        return "none.png";
    } elseif ($dosya_boyutu == 0) {
        // Geçersiz dosya boyutu hatası
        return "none.png";
    } else {
        // Yükleme için yeni dosya adı ve yolu oluştur
        $yeni_dosya_adi = md5($dosya_adi . time()) . '.' . $uzanti;
        $yeni_dosya_yolu = UPLOAD . '/' . $yeni_dosya_adi;
        // Dosyayı yükle
        if (move_uploaded_file($tmp_dosya_adi, $yeni_dosya_yolu)) {
            // Dosya yükleme başarılı
            // Dosya boyutunu kontrol et
            if (filesize($yeni_dosya_yolu) < 2) {
                // Dosya boyutu çok küçük, dosyayı sil
                unlink($yeni_dosya_yolu);
                return "none.png";
            } else {
                // Dosya yükleme ve boyut kontrolü başarıl
                // Yeni dosya adını döndür
                return $yeni_dosya_adi;
            }
        } else {
            return "none.png";
        }
    }
}
?>