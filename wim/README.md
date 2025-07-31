# WIM - Reddit Style Blog Theme

Modern, mobil öncelikli WordPress blog teması. Reddit benzeri estetik ile tasarlanmış, yazarların blog yazıları için optimize edilmiş temiz ve kullanıcı dostu bir tema.

## 🎨 Özellikler

### Tasarım
- **Reddit Benzeri Estetik**: Modern, temiz ve kullanıcı dostu arayüz
- **Mobil Öncelikli**: Responsive tasarım, tüm cihazlarda mükemmel görünüm
- **Lacivert Ana Renk**: Profesyonel ve modern görünüm
- **Dark Mode Desteği**: Sistem tercihine göre otomatik dark mode
- **Modern Tipografi**: Okunabilir ve estetik font kullanımı

### Teknik Özellikler
- **WordPress 5.0+ Uyumlu**: En son WordPress sürümleri ile tam uyumluluk
- **SEO Optimize**: Arama motorları için optimize edilmiş kod yapısı
- **Hızlı Yükleme**: Optimize edilmiş CSS ve JavaScript
- **Lazy Loading**: Görsel yükleme optimizasyonu
- **Accessibility**: Erişilebilirlik standartlarına uygun

### Kullanıcı Deneyimi
- **Mobil Menü**: Hamburger menü ile kolay navigasyon
- **Smooth Scrolling**: Yumuşak sayfa geçişleri
- **Scroll to Top**: Kolay üst sayfa erişimi
- **Reading Progress**: Okuma ilerleme çubuğu
- **Copy Code**: Kod blokları için kopyalama özelliği
- **Keyboard Navigation**: Klavye ile navigasyon desteği

## 📁 Dosya Yapısı

```
wim/
├── style.css              # Ana stil dosyası
├── functions.php          # Tema fonksiyonları
├── header.php             # Header şablonu
├── footer.php             # Footer şablonu
├── index.php              # Ana sayfa şablonu
├── single.php             # Tekil yazı şablonu
├── page.php               # Sayfa şablonu
├── archive.php            # Arşiv sayfası şablonu
├── search.php             # Arama sayfası şablonu
├── 404.php                # 404 hata sayfası
├── script.js              # JavaScript dosyası
├── screenshot.png         # Tema önizleme görseli
├── README.md              # Bu dosya
└── inc/                   # Include dosyaları
    ├── template-tags.php  # Template tag fonksiyonları
    ├── template-functions.php # Template fonksiyonları
    ├── customizer.php     # Customizer ayarları
    └── jetpack.php        # Jetpack uyumluluğu
```

## 🚀 Kurulum

1. **Tema Dosyalarını Yükleyin**
   - `wim` klasörünü WordPress'in `/wp-content/themes/` dizinine yükleyin
   - WordPress admin panelinden **Görünüm > Temalar** bölümüne gidin
   - WIM temasını etkinleştirin

2. **Menü Oluşturun**
   - **Görünüm > Menüler** bölümünden yeni menü oluşturun
   - Menüyü "Primary Menu" konumuna atayın

3. **Özelleştirme**
   - **Görünüm > Özelleştir** bölümünden tema ayarlarını yapın
   - Renk, yazı tipi ve diğer görsel ayarları değiştirin

## ⚙️ Özelleştirme

### Customizer Ayarları
- **Primary Color**: Ana renk ayarı
- **Background Color**: Arka plan rengi
- **Text Color**: Metin rengi
- **Posts per Page**: Sayfa başına yazı sayısı
- **Show Author**: Yazar adı gösterimi
- **Show Date**: Tarih gösterimi
- **Show Categories**: Kategori gösterimi

### CSS Özelleştirme
Ana renkleri değiştirmek için `style.css` dosyasındaki CSS değişkenlerini düzenleyin:

```css
:root {
    --wim-primary-color: #0079d3;    /* Ana renk */
    --wim-background-color: #f8f9fa; /* Arka plan */
    --wim-text-color: #1a1a1b;       /* Metin rengi */
}
```

## 📱 Mobil Uyumluluk

Tema tamamen mobil öncelikli olarak tasarlanmıştır:
- **Responsive Grid**: Tüm ekran boyutları için optimize
- **Touch Friendly**: Dokunmatik cihazlar için optimize edilmiş butonlar
- **Fast Loading**: Mobil cihazlarda hızlı yükleme
- **Mobile Menu**: Kolay kullanılabilir mobil menü

## 🎯 SEO Özellikleri

- **Semantic HTML**: Anlamlı HTML yapısı
- **Meta Tags**: Otomatik meta etiketleri
- **Schema Markup**: Yapılandırılmış veri desteği
- **Fast Loading**: Hızlı sayfa yükleme
- **Mobile Friendly**: Mobil uyumluluk

## 🔧 Geliştirici Notları

### Hooks ve Filters
```php
// Özel CSS eklemek için
add_action('wp_head', 'custom_css');

// Özel JavaScript eklemek için
add_action('wp_footer', 'custom_js');

// Post meta değiştirmek için
add_filter('wim_post_meta', 'custom_post_meta');
```

### Template Parts
Tema, template parts kullanır:
- `template-parts/content.php` - İçerik şablonu
- `template-parts/content-single.php` - Tekil yazı şablonu
- `template-parts/content-page.php` - Sayfa şablonu

## 🐛 Sorun Giderme

### Yaygın Sorunlar

1. **Menü Görünmüyor**
   - WordPress admin panelinden menü oluşturun
   - Menüyü "Primary Menu" konumuna atayın

2. **Stil Sorunları**
   - Tarayıcı önbelleğini temizleyin
   - CSS dosyasının doğru yüklendiğini kontrol edin

3. **JavaScript Hataları**
   - Tarayıcı konsolunu kontrol edin
   - Diğer eklentilerle çakışma olup olmadığını kontrol edin

## 📄 Lisans

Bu tema GNU General Public License v2 veya sonrası altında lisanslanmıştır.

## 🤝 Katkıda Bulunma

1. Bu repository'yi fork edin
2. Yeni bir branch oluşturun (`git checkout -b feature/yeni-ozellik`)
3. Değişikliklerinizi commit edin (`git commit -am 'Yeni özellik eklendi'`)
4. Branch'inizi push edin (`git push origin feature/yeni-ozellik`)
5. Pull Request oluşturun

## 📞 Destek

Sorularınız veya önerileriniz için:
- GitHub Issues kullanın
- WordPress.org tema forumlarını ziyaret edin

## 🔄 Güncellemeler

### v1.0.0
- İlk sürüm
- Reddit benzeri tasarım
- Mobil öncelikli responsive tasarım
- Dark mode desteği
- Modern JavaScript özellikleri

---

**WIM Theme** - Modern blog deneyimi için tasarlandı. 🚀 