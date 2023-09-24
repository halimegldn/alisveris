// "Buy Now" düğmelerini seçin
var buyNowButtons = document.querySelectorAll('.buy-now-btn');

// Her "Buy Now" düğmesine tıklanınca çalışacak kodu burada tanımlayın
buyNowButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const urunId = this.getAttribute('data-urun-id');
        
        // Ürünü veritabanından çekmek için getProductDetails işlemini çağırın
        getProductDetails(urunId);
    });
});

// Ürün detaylarını veritabanından çekmek için işlev
function getProductDetails(urunId) {
    // Bu örnek veritabanı bilgilerinizi kendinize göre güncelleyin
    var veritabaniBilgileri = {
        1: { urunAdi: 'Armut', urunFiyati: 10 },
        2: { urunAdi: 'Çilek', urunFiyati: 10 },
        3: { urunAdi: 'Elma', urunFiyati: 10 },
        4: { urunAdi: 'Karpuz', urunFiyati: 10 },
        5: { urunAdi: 'Kiraz', urunFiyati: 10 },
        6: { urunAdi: 'Kivi', urunFiyati: 10 },
        7: { urunAdi: 'Muz', urunFiyati: 10 },
        8: { urunAdi: 'Uzum', urunFiyati: 10 },
        9: { urunAdi: 'Portakal', urunFiyati: 10 },
        10: { urunAdi: 'Şeftali', urunFiyati: 10 }
        // Diğer ürünler
    };

    // Veritabanından ürün detaylarını alın
    var urunDetaylari = veritabaniBilgileri[urunId];

    if (urunDetaylari) {
        // Ürün detaylarını aldığınızda sepete eklemeyi çağırın
        addToCart(urunId, urunDetaylari.urunAdi, urunDetaylari.urunFiyati);
    } else {
        console.log('Ürün detayları bulunamadı.'); // Hata kontrolü
    }
}

// Sepete eklemek ve yönlendirmek için JavaScript kodu
function addToCart(urunId, urunAdi, urunFiyat) {
    var quantity = 1; // Varsayılan miktarı burada ayarlayabilirsiniz

    // Sepet bilgilerini tarayıcı depolama kullanarak kaydetme
    var cart = localStorage.getItem("cart");
    if (!cart) {
        cart = [];
    } else {
        cart = JSON.parse(cart);
    }

    // Ürünü sepete eklemek için bir nesne oluşturun
    var newItem = {
        urunId: urunId,
        urunAdi: urunAdi,
        urunFiyat: urunFiyat,
        quantity: quantity
    };

    // Ürünü sepete ekleyin
    cart.push(newItem);

    // Sepeti güncelle ve localStorage'e kaydet
    localStorage.setItem("cart", JSON.stringify(cart));

    // Kullanıcıyı istediğiniz sayfaya yönlendirin
    // Örneğin, sepet sayfasına yönlendirebilirsiniz
    window.location.href = "sepet.php";
}
