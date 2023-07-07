<?php
$path = $_SERVER['DOCUMENT_ROOT']."/";
require($path.'config.php');
$sonuc              = "";
$time               = time();
if($add == 'add'){
    if($_SESSION['time']==$timeout){
        /*
            Eğer SESSION'daki time ile input'tan gelen timeout aynı ise işleme giriyor.
            Değil ise aşağıya atıyor.
        */
        unset($_SESSION['time']);
        $url    = createPermalink($name).".html";
        /*
            ben genelde son sayfaları hep .html olarak belirliyorum.
            hiyerarşi oluşturma bakımından.
            tabi burada htaccess göstermeyeceğim ama en azından permalink yapımını da görün istedim.
            bir diğer konu aynı url'den 2 tane olabilir. bunun içinde ekstra kontrol sağlamanız gerekir.
            siteadi.com/kategori/altkategori/urun-url.html şeklinde kullanırım genel olarak.
        */
        $images = image_upload();
        /*
            burada resim yükleme fonksiyonumuz devreye giriyor ve resmi yükleyip yeni ismini $images olarak veriyor.
        */
        $array  = array(
          'name'            => $name,
          'url'             => $url,
          'price'           => $price,
          'vat'             => $vat,
          'stock_code'      => $stock_code,
          'stock_quantity'  => $stock_quantity,
          'image'           => $images,
          'details'         => $details
        );
        $result = $db->insert('products', $array);
        $sonuc = $result->message;
    } else {
        $sonuc = '<center><b>Lütfen tekrar deneyiniz</b></center>';
    }
}
$_SESSION['time']   = $time;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Pure PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/">
    <link href="minata/css.css?time=<? echo time(); ?>" rel="stylesheet">
</head>
<body>
<? include(THEME.'header.php'); ?>
<div class="container">
    <? echo $sonuc; ?>
    <form action="product-add.php?add=add" method="post" enctype="multipart/form-data">
        <h1>Yeni Ürün Ekle</h1>
        <input type="hidden" name="timeout" value="<? echo $time; ?>">
        <!--
        Burada timeout'u kullanmamızın nedeni kişi içeriği ekledikten sonra F5 yaparsa tekrar işlem yapmaması için.
        Bu konuda farklı alternatifler yapabilirsiniz. Mesela Google Recaptcha, IP kontrolü, Sayfa dışı yönlendirme vs vs.
        Fakat en basit yoldan kafa bulandırmadan devam edelim.
        Yukarıda SESSION'daki time ile POST edilen time kontrolünü yapacağız.
        -->
        <label class="left">Ürün adı</label>
        <input class="left" type="text" name="name" required>
        <label class="left">Stok Kodu</label>
        <input class="left" type="text" name="stock_code" required>
        <label class="left">Stok Miktarı</label>
        <input class="left" type="text" name="stock_quantity">
        <label class="left">Ürün Fiyatı</label>
        <input class="left" type="text" name="price" required>
        <label class="left">Ürün KDV Oranı</label>
        <input class="left" type="text" name="vat" value="20">
        <!-- KDV kısmını isterseniz selectbox da kullanabilirsiniz ama TR şartlarında tavsiye etmem :) -->
        <label class="left">Ürün Resmi</label>
        <input class="left" type="file" name="image" accept="image/*">
        <!--
        accept="image/*" ekleyerek sadece resim dosyalarını seçebilme özelliği veriyoruz. Fakat bu tek başına güvenli değil :)
        Upload kısmında da ekstra güvenlik önlemi almamız gerekiyor.
        -->
        <label class="left">Ürün Açıklaması</label>
        <textarea class="left" name="details" required></textarea>
        <button>KAYDET</button>
    </form>
</div>
<footer>
    Copyright Pure PHP. Designed by <a href="https://codermingle.dev/@suleymanozcan" target="_blank">Süleyman Zuckerberg</a>
</footer>
</body>
</html>
