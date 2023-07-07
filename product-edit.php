<?php
$path = $_SERVER['DOCUMENT_ROOT']."/";
require($path.'config.php');
$sonuc              = "";
$time               = time();
if($edit == 'edit'){
    if($_SESSION['time']==$timeout){
        unset($_SESSION['time']);
        $array      = array(
            'name'            => $name,
            'price'           => $price,
            'vat'             => $vat,
            'stock_code'      => $stock_code,
            'stock_quantity'  => $stock_quantity,
            'details'         => $details
        );
        $conditions = array(
            'id'              => $id
        );
        // eğer birden fazla koşul belirtmek isterseniz conditions içine yazabilirsiniz.
        $result = $db->update('products', $conditions, $array);
        $sonuc = $result->message;
    } else {
        $sonuc = '<center><b>Lütfen tekrar deneyiniz</b></center>';
    }
}
$_SESSION['time']   = $time;
$product        = $db->prepare("SELECT * FROM products WHERE id = :id");
$product->execute([':id' => $id]);
$products       = $product->fetch(PDO::FETCH_ASSOC);
// Bakın burada fetch kullanıyoruz
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

    <form action="product-edit.php?edit=edit&id=<? echo $id; ?>" method="post">
        <h1>Mevcut Ürünü Düzenle</h1>
        <input type="hidden" name="timeout" value="<? echo $time; ?>">
        <label class="left">Ürün adı</label>
        <input class="left" type="text" name="name" value="<? echo $products['name']; ?>" required>
        <label class="left">Stok Kodu</label>
        <input class="left" type="text" name="stock_code" value="<?=$products['stock_code']; ?>" required>
        <?
        /*
         Dikkat ettiyseniz <? echo $products['name']; ?> hem böyle kullandım <?=$products['stock_code']; ?> hemde bu şekilde
         Bu durumun birbiri ile hiçbir farkı bulunmamaktadır. Her 2 şekilde de kullanabilirsiniz.
         Görmeniz açısından 2 sini farklı yazdım. Ben genelde echo'cuyum :)
         */
         ?>
        <label class="left">Stok Miktarı</label>
        <input class="left" type="text" name="stock_quantity" value="<? echo $products['stock_quantity']; ?>">
        <label class="left">Ürün Fiyatı</label>
        <input class="left" type="text" name="price" value="<? echo $products['price']; ?>" required>
        <label class="left">Ürün KDV Oranı</label>
        <input class="left" type="text" name="vat"  value="<? echo $products['vat']; ?>">
        <label class="left">Ürün Açıklaması</label>
        <textarea class="left" name="details" required><? echo $products['details']; ?></textarea>
        <button>GÜNCELLE</button>
    </form>
    <? } ?>
</div>
<footer>
    Copyright Pure PHP. Designed by <a href="https://codermingle.dev/@suleymanozcan" target="_blank">Süleyman Zuckerberg</a>
</footer>
</body>
</html>
