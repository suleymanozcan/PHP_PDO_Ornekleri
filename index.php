<?php
$path = $_SERVER['DOCUMENT_ROOT']."/";
require($path.'config.php');
$product    = $db->query("SELECT * FROM products ORDER BY updated_at DESC")->fetchAll(PDO::FETCH_ASSOC);
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
<header>
    <a href="index.html">Ürün Listesi</a>
    <a href="product-add.html">Ürün Ekle</a>
</header>
<div class="container">
    <table>
        <thead>
            <tr>
                <th class="center">Stok Kodu</th>
                <th>Ürün Adı</th>
                <th class="center">Miktarı</th>
                <th class="center">Fiyatı</th>
                <th class="center">KDV</th>
                <th class="center">İncele</th>
                <th class="center">Düzenle</th>
                <th class="center">Sil</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($product as $products){ ?>
            <tr>
                <td class="center"><? echo $products['stock_code']; ?></td>
                <td><? echo $products['name']; ?></td>
                <td class="center"><? echo $products['stock_quantity']; ?></td>
                <td class="center"><? echo $products['price']; ?></td>
                <td class="center"><? echo $products['vat']; ?></td>
                <td class="center"><a href="">İncele</a></td>
                <td class="center"><a href="">Düzenle</a></td>
                <td class="center"><a href="">Sil</a></td>
            </tr>
        <?php }
        /*
        Foreach kullanımı hakkında kısa bilgi
        Burada şu tarz kullanımlar da görebilirsiniz.
        <?php foreach ($product as $products): ?>
            <tr>
                ........
            </tr>
        <?php endforeach; ?>

        yada hiç PHP aç/kapat yapmadan direk PHP içinde de olabilir.
        Bu eğitimin amacı basic seviye de birşeyler anlatmak olduğu için yukarıdaki gibi yapıyorum.

        Okunabilirlik konusunda
        foreach ($product as $products):
        endforeach;
        tercih edilse de
        foreach ($product as $products){ } şeklinde de kullanabilirsiniz.
        Kimse diğer türlü daha performanslı diyemez çünkü aynı işlevi görmekteler.


        PHP içerisinde HTML kullanımı kısmını da bir örnek vereyim. Bu örneği de endforeach; kullanarak yapayım.
         <?php
            foreach ($product as $products):
                echo "
                <tr>
                    <td>{$products['stock_code']}</td>
                </tr>
                ";
            endforeach;
        ?>
        şeklinde de kullanabilirsiniz.

        Burada ekstra bir nüans vermek gerekebilir. echo'yu dikkat ederseniz "" olarak kullandım. Eğer echo '' olarak kullanmak isterseniz aşağıdaki gibi yapmanız gerekir.
        <?php
            foreach ($product as $products):
                echo '
                <tr>
                    <td>'.$products['stock_code'].'</td>
                </tr>
                ';
            endforeach;
        ?>

        Şimdi "" ve '' ne için kullanmalıyız onu söyleyeyim. Performans için çok büyük etkiler yaratmaz.
        fakat '' kullanırsanız PHP değişkenleri için yukarıdaki '.$deger.' şeklinde geçmeniz gerekir.
        Bu işlem "" içeriğinde ise {$deger} bu şekilde rahatça kullanabilirsiniz.
        '' genel olarak salt html kodu için kullanmanızı tavsiye ederim.
        Örnek olarak
        echo '<div>Merhaba Dünya</div>'; gibi
        */
        ?>
        </tbody>
    </table>
</div>
<footer>
    Copyright Pure PHP. Designed by <a href="https://codermingle.dev/@suleymanozcan" target="_blank">Süleyman Zuckerberg</a>
</footer>
</body>
</html>
