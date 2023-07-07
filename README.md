# PHP_PDO_Ornekleri
PHP için temel konuları baz alarak, herhangi bir kütüphane kullanmaksızın sadece PDO'yu kullanarak INSERT, UPDATE, DELETE, QUERY vb. temel konular.


Proje içerisinde mümkün olduğunda HTML ve CSS karmaşasından kurtulmak için Bootstrap, Jquery vs kullanmadım. 
Belki ileride farklı repolar yaparak onları da dahil ederim. Burada temel olarak en basit şekilde PHP hakkında bilgi vermek istedim.




----
Eğer GET veya POST ile gelen veriyi ekrana basacaksanız.
Bazı basit kuralları baz alabilirsiniz.
Mesela noicehackerdefender.php dosyasındaki
```
function cleanInput($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = cleanInput($value);
        }
    } else {
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    return $data;
}
foreach($_POST as $key => $value) { $$key = cleanInput($value); }
foreach($_GET as $key => $value) {  $$key = cleanInput($value); }
```
bu kullanımda gelen özel karakterleri temizler.
böylece
```
echo $_POST['deger'] veya $_GET['deger']
```
yerine direk $deger olarak kullanabilirsiniz biri
```
index.php?id=<img src=x onerror=prompt(/OPENBUGBOUNTY/)>
```
şeklinde bir veri gönderirse.
arkaplanda aşağıdaki gibi işleyecek fakat görüntüde
```
"<img src=x onerror=prompt(/OPENBUGBOUNTY/)>"
```
bu şekilde gösterecektir.
```
&lt;img src=x onerror=prompt(/OPENBUGBOUNTY/)&gt;
```

Zaten veritabanı için insert, update, delete, query gibi işlemler de PDO kurallarını kullanacağımız için de bindValue yüksek oranda SQL injection saldırılarından sizi koruyacaktır.
