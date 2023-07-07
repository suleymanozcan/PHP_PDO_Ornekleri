<?php
$path = $_SERVER['DOCUMENT_ROOT']."/";
require($path.'config.php');
$_SESSION['time']   = $time;
$product        = $db->prepare("SELECT * FROM products WHERE url = :url");
$product->execute([':url' => $url]);
$products       = $product->fetch(PDO::FETCH_ASSOC);
// Bakın burada da fetch kullanıyoruz
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
    <? if ($products === false) {
        // belirtilen id'de ürün var mı yok mu kontrol edelim.
        echo "<center><b>Ürün Bulunamadı...</b></center>";
    } else { ?>

            <h1>Mevcut Ürünü Gör</h1>
            <label class="left">Ürün adı</label>
            <input class="left" type="text" name="name" value="<? echo $products['name']; ?>" disabled>
            <label class="left">Stok Kodu</label>
            <input class="left" type="text" name="stock_code" value="<?=$products['stock_code']; ?>" disabled>
            <label class="left">Stok Miktarı</label>
            <input class="left" type="text" name="stock_quantity" value="<? echo $products['stock_quantity']; ?>" disabled>
            <label class="left">Ürün Fiyatı</label>
            <input class="left" type="text" name="price" value="<? echo $products['price']; ?>" disabled>
            <label class="left">Ürün KDV Oranı</label>
            <input class="left" type="text" name="vat"  value="<? echo $products['vat']; ?>" disabled>
            <img src="/upload/<? echo $products['image']; ?>" width="400" height="400" />
            <label class="left">Ürün Açıklaması</label>
            <div style="clear: both;"><? echo nl2br($products['details']); ?></div>
            <!-- herhangi bir texteditör kullanmadığım için nl2br kullanıyoruz ki satırları algılasın. -->
    <? } ?>
</div>
<footer>
    Copyright Pure PHP. Designed by <a href="https://codermingle.dev/@suleymanozcan" target="_blank">Süleyman Zuckerberg</a>
</footer>
</body>
</html>
