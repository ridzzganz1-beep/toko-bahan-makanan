# 🏪 Toko Bahan Makanan - Sistem Multi-User E-commerce

Aplikasi Laravel modern dengan sistem **Admin** dan **User** yang terintegrasi sempurna, menampilkan UI ecommerce premium yang responsif, elegan, dan profesional menggunakan **Tailwind CSS**, **Font Awesome**, dan **Alpine.js**.

---

## 📋 Fitur Utama

### 👤 **Role User / Pelanggan**

- ✅ Login & Register
- ✅ Melihat daftar barang dengan search & filter kategori
- ✅ Keranjang belanja (CRUD item)
- ✅ Checkout dengan validasi data
- ✅ Riwayat pembelian / Pesanan
- ✅ Profil user (edit nama/email, ganti password)
- ✅ Logout

### 🔐 **Role Admin**

- ✅ Dashboard statistik (barang, pesanan, user)
- ✅ CRUD data barang (nama, harga, stok, gambar)
- ✅ Kelola transaksi / Pesanan
- ✅ Kelola user (edit role, hapus akun)
- ✅ Logout

---

## 🎨 Desain & UI

- **Modern Ecommerce Dashboard**: Tampilan profesional & elegan
- **Glassmorphism Design**: Efek kaca modern dengan backdrop blur
- **Color Scheme**: Navy, Ungu Gradient, Putih, Abu soft
- **Responsive**: Desktop, Tablet, Mobile
- **Rounded Corners**: Minimal 2xl untuk card & button
- **Animasi Smooth**: Hover effect, fade-in, scale transition
- **Icons**: Font Awesome 6.5.4

---

## 🗄️ Database Schema

### Table `users`
```sql
- id (primary key)
- name
- email (unique)
- email_verified_at
- password
- role (admin/user) - DEFAULT: user
- remember_token
- timestamps
```

### Table `barangs`
```sql
- id (primary key)
- nama
- harga (decimal)
- stok (integer)
- gambar (nullable)
- timestamps
```

### Table `carts`
```sql
- id (primary key)
- user_id (foreign key → users)
- timestamps
```

### Table `cart_items`
```sql
- id (primary key)
- cart_id (foreign key → carts)
- barang_id (foreign key → barangs)
- name
- price
- quantity
- timestamps
```

### Table `orders`
```sql
- id (primary key)
- user_id (foreign key → users)
- recipient_name
- address
- phone
- payment_method (Transfer Bank, COD, Dana, OVO, Gopay)
- status (Pending, Completed, Cancelled)
- total (decimal)
- timestamps
```

### Table `order_details`
```sql
- id (primary key)
- order_id (foreign key → orders)
- barang_id (foreign key → barangs)
- name
- price
- quantity
- subtotal
- timestamps
```

---

## 📁 Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php          # Login, Register, Logout
│   │   ├── ShopController.php          # Home & Products untuk user
│   │   ├── CartController.php          # Keranjang belanja
│   │   ├── CheckoutController.php      # Checkout
│   │   ├── OrderController.php         # Riwayat pesanan user
│   │   ├── ProfileController.php       # Edit profil user
│   │   ├── BarangController.php        # CRUD barang (admin)
│   │   └── Admin/
│   │       ├── UserController.php      # Kelola user (admin)
│   │       └── OrderController.php     # Kelola pesanan (admin)
│   └── Middleware/
│       ├── AdminMiddleware.php         # Proteksi halaman admin
│       └── UserMiddleware.php          # Proteksi halaman user
├── Models/
│   ├── User.php                        # User model dengan relasi cart & orders
│   ├── Barang.php                      # Barang model
│   ├── Cart.php                        # Cart model
│   ├── CartItem.php                    # Cart item model
│   ├── Order.php                       # Order model
│   └── OrderDetail.php                 # Order detail model
└── Providers/
    └── AppServiceProvider.php

resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php              # Layout admin & user
│   │   └── auth.blade.php             # Layout login/register
│   ├── welcome.blade.php               # Landing page
│   ├── home.blade.php                  # Home user
│   ├── dashboard.blade.php             # Dashboard admin
│   ├── user/
│   │   ├── products.blade.php         # Daftar produk
│   │   ├── cart.blade.php             # Keranjang
│   │   ├── checkout.blade.php         # Checkout
│   │   ├── profile.blade.php          # Profile user
│   │   └── orders/
│   │       ├── index.blade.php        # Riwayat pesanan
│   │       └── show.blade.php         # Detail pesanan
│   ├── barang/
│   │   ├── index.blade.php            # Daftar barang (admin)
│   │   ├── create.blade.php           # Tambah barang
│   │   └── edit.blade.php             # Edit barang
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   └── admin/
│       ├── users/
│       │   ├── index.blade.php        # Daftar user (admin)
│       │   └── edit.blade.php         # Edit user (admin)
│       └── orders/
│           ├── index.blade.php        # Daftar pesanan (admin)
│           └── show.blade.php         # Detail pesanan (admin)

database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   ├── 0001_01_01_000002_create_jobs_table.php
│   ├── 2026_05_10_000001_create_barangs_table.php
│   ├── 2026_05_10_000002_create_transaksis_table.php
│   ├── 2026_05_10_072251_add_gambar_to_barangs_table.php
│   ├── 2026_05_10_080000_create_shop_tables.php        # NEW: Cart, Orders
│   └── 2026_05_10_080001_add_stok_to_barangs_table.php  # NEW: Stok field
└── seeders/
    └── DatabaseSeeder.php             # Create admin & user

routes/
└── web.php                              # Routing lengkap dengan middleware

public/
└── images/
    └── barangs/                        # Gambar barang
```

---

## 🚀 Instalasi & Setup

### 1. **Clone Repository**
```bash
cd c:\xamppp\htdocs
# atau direktori project Anda
```

### 2. **Install Dependencies**
```bash
composer install
npm install
```

### 3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

### 4. **Konfigurasi Database**
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toko_bahan_makanan
DB_USERNAME=root
DB_PASSWORD=
```

### 5. **Migrasi Database**
```bash
php artisan migrate
php artisan db:seed
```

### 6. **Build Assets**
```bash
npm run build
# atau untuk development:
npm run dev
```

### 7. **Jalankan Server**
```bash
php artisan serve
```

Buka: `http://localhost:8000`

---

## 🔐 Akun Default

**Admin:**
- Email: `admin@example.com`
- Password: `password` (sesuaikan di seeder)

**User:**
- Email: `user@example.com`
- Password: `password` (sesuaikan di seeder)

---

## 📝 Middleware Role

### `AdminMiddleware`
Melindungi route admin agar hanya admin yang bisa akses.

```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes
});
```

### `UserMiddleware`
Melindungi route user agar hanya user yang bisa akses.

```php
Route::middleware(['auth', 'user'])->group(function () {
    // User routes
});
```

---

## 🛣️ Route Map

### **Public Routes**
```
GET  /              → welcome page
GET  /login         → login form
POST /login         → login process
GET  /register      → register form
POST /register      → register process
POST /logout        → logout
```

### **User Routes** (middleware: auth, user)
```
GET  /home                          → home user
GET  /products                      → daftar produk
POST /cart/add/{barang}            → tambah ke keranjang
GET  /cart                         → lihat keranjang
PUT  /cart/{item}                  → update item
DELETE /cart/{item}                → hapus item
GET  /checkout                     → form checkout
POST /checkout                     → proses checkout
GET  /orders                       → riwayat pesanan
GET  /orders/{order}               → detail pesanan
GET  /profile                      → lihat profil
PUT  /profile                      → update profil
PUT  /profile/password             → ganti password
```

### **Admin Routes** (middleware: auth, admin) - prefix: /admin
```
GET    /admin/dashboard             → dashboard
GET    /admin/barangs               → daftar barang
GET    /admin/barangs/create        → form tambah barang
POST   /admin/barangs               → simpan barang
GET    /admin/barangs/{barang}/edit → form edit barang
PUT    /admin/barangs/{barang}      → update barang
DELETE /admin/barangs/{barang}      → hapus barang
GET    /admin/users                 → daftar user
GET    /admin/users/{user}/edit     → form edit user
PUT    /admin/users/{user}          → update user
DELETE /admin/users/{user}          → hapus user
GET    /admin/orders                → daftar pesanan
GET    /admin/orders/{order}        → detail pesanan
```

---

## 💾 Model Relationships

```
User
├── hasOne: Cart
└── hasMany: Order

Cart
├── belongsTo: User
└── hasMany: CartItem

CartItem
├── belongsTo: Cart
└── belongsTo: Barang

Order
├── belongsTo: User
└── hasMany: OrderDetail

OrderDetail
├── belongsTo: Order
└── belongsTo: Barang

Barang
├── hasMany: CartItem
└── hasMany: OrderDetail
```

---

## 🎯 Fitur Validasi

### Login
- Email harus valid & terdaftar
- Password minimal 6 karakter
- Remember me option

### Register
- Nama harus diisi
- Email unik & valid
- Password minimal 6 karakter
- Password harus dikonfirmasi

### Barang (Admin)
- Nama barang harus diisi
- Harga minimal 0
- Stok minimal 0
- Gambar format: JPG, PNG, GIF, SVG (max 2MB)

### Checkout (User)
- Nama penerima harus diisi
- Alamat minimal 5 karakter
- Nomor HP format valid
- Metode pembayaran dipilih
- Keranjang tidak boleh kosong

---

## 🌐 Middleware & Authorization

Semua route dilindungi dengan middleware `auth`, `admin`, dan `user` sesuai kebutuhan.

**Routing rules:**
1. Guest hanya bisa akses login & register
2. User hanya bisa akses halaman user
3. Admin hanya bisa akses halaman admin
4. Redirect otomatis sesuai role saat login

---

## 📦 Dependencies

```json
{
  "php": "^8.2",
  "laravel/framework": "^11.0",
  "tailwindcss": "^3.0",
  "alpinejs": "^3.0"
}
```

### CDN Included
- Tailwind CSS 3
- Font Awesome 6.5.4
- SweetAlert2
- Toastr.js
- Alpine.js 3

---

## 🖼️ Customization

### Ubah Warna Theme
Edit `resources/views/layouts/app.blade.php` untuk mengubah gradient & warna:

```html
<!-- Indigo to Sky gradient -->
<div class="bg-gradient-to-r from-indigo-500 to-sky-500"></div>
```

### Ubah Logo
Edit logo di navbar `resources/views/layouts/app.blade.php`:

```html
<div class="w-14 h-14 rounded-3xl bg-gradient-to-br from-indigo-500 to-sky-500">
    <i class="fas fa-leaf text-xl"></i> <!-- Ubah icon ini -->
</div>
```

---

## 📱 Responsive Design

- **Desktop**: Full layout dengan sidebar admin
- **Tablet**: Layout responsif dengan hamburger menu
- **Mobile**: Stack vertical, touch-friendly buttons

---

## ⚡ Performance

- Lazy loading untuk gambar
- Pagination 12 produk per halaman
- Query optimization dengan eager loading
- Minified CSS & JS

---

## 🐛 Troubleshooting

### Migrasi gagal
```bash
php artisan migrate:fresh --seed
```

### Assets tidak ter-compile
```bash
npm run build
php artisan cache:clear
```

### Role tidak terbaca
```bash
php artisan cache:clear
php artisan config:cache
```

---

## 📄 License

MIT License - Free to use & modify

---

## 👨‍💻 Author

Aplikasi ini dibuat dengan ❤️ menggunakan Laravel 11 & Tailwind CSS 3

---

## 📞 Support

Untuk pertanyaan atau issue, silakan buat discussion atau contact admin.

**Happy Coding! 🚀**
