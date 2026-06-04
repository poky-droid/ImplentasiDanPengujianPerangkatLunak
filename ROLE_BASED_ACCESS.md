# Dokumentasi Sistem Role-Based Access Control

## Fitur yang Sudah Diimplementasikan

### 1. Role Column di Tabel Users
- Sudah ada di migration: `0001_01_01_000000_create_users_table.php`
- Tipe: String dengan default value 'user'
- Nilai yang didukung: 'admin', 'user'

### 2. UserSeeder
**File**: `/database/seeders/UserSeeder.php`

Tiga user dibuat:
- **Admin User** (role: admin)
  - Email: admin@example.com
  - Password: password123
  
- **Test User 1** (role: user)
  - Email: john@example.com
  - Password: password123
  
- **Test User 2** (role: user)
  - Email: jane@example.com
  - Password: password123

### 3. AdminMiddleware
**File**: `/app/Http/Middleware/AdminMiddleware.php`

Fungsi:
- Mengecek apakah user sudah login
- Mengecek apakah user memiliki role 'admin'
- Jika bukan admin, return error 403 (Unauthorized)

Digunakan di:
```php
middleware(['auth', 'admin'])
```

### 4. LoginController
**File**: `/app/Http/Controllers/Auth/LoginController.php`

Method `authenticated()`:
- Jika user role = 'admin' → Redirect ke `/admin/dashboard` (route name: `admin.dashboard`)
- Jika user role = 'user' → Redirect ke `/` (home page)

### 5. Admin Routes
**File**: `/routes/web.php`

Semua route admin dilindungi dengan middleware `['auth', 'admin']`:
```php
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Semua routes admin
});
```

Rute yang ada:
- `/admin/dashboard` - Dashboard Admin
- `/admin/users` - Manajemen User
- `/admin/owners` - Manajemen Owner
- `/admin/pengajuan` - Pengajuan Mitra
- `/admin/bookings` - Daftar Booking
- `/admin/pembayaran` - Pembayaran
- `/admin/komplain` - Komplain/Review

## Alur Login

1. User mengisi form login (email & password)
2. Sistem validasi credentials
3. Jika benar:
   - Session dibuat
   - Method `authenticated()` dipanggil
   - **Jika role = 'admin'**: Redirect ke admin dashboard
   - **Jika role = 'user'**: Redirect ke home page
4. User yang mencoba akses route admin tanpa role admin akan mendapat error 403

## Testing

### Test sebagai Admin:
```
Email: admin@example.com
Password: password123
```
→ Akan diarahkan ke `/admin/dashboard`

### Test sebagai User Biasa:
```
Email: john@example.com
Password: password123
```
→ Akan diarahkan ke `/`
→ Jika coba akses `/admin/...` akan dapat error 403

## Menambah User Admin Baru

Edit file `/database/seeders/UserSeeder.php`:
```php
User::create([
    'name' => 'Nama Admin',
    'email' => 'admin@domain.com',
    'role' => 'admin',  // Ini yang penting!
    'password' => Hash::make('password'),
    'email_verified_at' => now(),
]);
```

Kemudian jalankan:
```bash
php artisan db:seed --class=UserSeeder
```

## Keamanan

✅ Middleware `admin` mengecek role di setiap request ke route admin
✅ Session diverifikasi dengan `auth` middleware
✅ Admin routes ter-protect dengan double middleware check
✅ Error 403 jika user tidak punya akses

## Catatan Penting

- Role 'admin' memiliki akses ke semua halaman admin
- Role 'user' hanya bisa akses halaman publik
- Middleware berjalan di setiap request ke route admin
- Jika ingin menambah role baru, update:
  1. Enum di migration (jika perlu)
  2. LoginController untuk redirect logic
  3. Middleware jika ada aturan khusus
