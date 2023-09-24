<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/web.css"> <!-- CSS dosyasını dahil et -->
    <title>Sepet</title>
    
</head>
<body>
    <?php
    session_start(); // Oturumu başlat

    // Sepet verisini oturumdan alın ve diziye dönüştürün
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = [];
    }

    // Veritabanına bağlantı yapın (veritabanı bilgilerinizi kendinize göre ayarlayın)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fruit";

    $conn = new mysqli($servername, $username, $password, $database);

    // Bağlantıyı kontrol edin
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    // Sepet içeriğini göster
    echo '<ul>'; // Sepet ürünlerini bir liste olarak göster
    foreach ($cart as $item) {
        $urunId = $item['urunId'];
        $quantity = $item['quantity'];

        // $urunId'nin geçerli bir değer içerdiğinden emin olun
        if (!empty($urunId)) {
            // Veritabanından ürün bilgilerini çekin
            $sql = "SELECT urun_adi, urun_fiyat FROM bilgi WHERE urun_id = $urunId";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "Sorgu hatası: " . $conn->error;
            } else {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $urunAdi = $row['urun_adi'];
                    $urunFiyati = $row['urun_fiyat'];

                    // Ürün bilgilerini göster
                    echo '<li>Ürün Adı: ' . $urunAdi . ', Fiyat: ' . $urunFiyati . ', Miktar: ';
                    echo '<span class="quantity">' . $quantity . '</span>';
                    echo '<button onclick="artirMiktar(' . $urunId . ')" class="artir">+</button>';
                    echo '<button onclick="azaltMiktar(' . $urunId . ')" class="azalt">-</button>';
                    echo '</li>';
                } else {
                    echo 'Ürün bulunamadı.';
                }
            }
        } else {
            echo 'Geçersiz ürün ID.';
        }
    }
    echo '</ul>'; // Liste sonu

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>

    <!-- Sepetiniz boşsa bu kısmı görüntüleyin -->
    <?php
    if (empty($cart)) {
        echo 'Sepetiniz boş.';
    }
    ?>

    
</body>
</html>
