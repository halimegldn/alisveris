<?php
// Kullanıcıdan gelen verileri kontrol et
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "fruit"; 

    $kullanici = $_POST["username"];
    $sifre = $_POST["password"];

    // Veritabanına bağlan
    $conn = new mysqli($servername, $username, $password);

    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Veritabanını seç
    $conn->select_db($dbname);

    $sql = "SELECT * FROM fruits WHERE username = '$kullanici' AND password = '$sifre'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        session_start(); 
        $_SESSION["username"] = $kullanici; 
        header("Location: sepet.php"); 
        exit(); 
    } else {
       
        echo "Kullanıcı adı veya şifre yanlış!";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
} else {
    echo "Kullanıcı adı veya şifre gönderilmemiş.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="POST" action="login.php">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Giriş Yap">
    </form>
</body>
</html>
