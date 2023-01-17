# Install
```bash
composer install vdes/permisionrole
```

# Cara Pasang
Masukan code berikut kedalam file app.php yang berada dalam folder config
```php
'providers' => [
    ....
    Vdes\PermisionRoles\PermissionsServiceProvider::class,
    ....
 ],
```
Jalankan perintah publish
```php
php vdes vendor:publish
```
kemudian jalankan migrasi

```php
php vdes migrate
```
masukan angka yang memiliki kata kunci Vdes\PermisionRoles ...dst
setelah itu edit model User menjadi seperti berikut 

```php
<?php

namespace App\Models;

// tambah kode
use Vdes\PermisionRoles\Permissions\HasPermissionsTrait;
// end kode

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    ....
    // tambah ini HasPermissionsTrait pada use
    use HasFactory, Notifiable, HasPermissionsTrait ;
    ....
}
```
kemudin tambah middleware pada file Kernel.php yang berada pada folder > app > Http
```php
    protected $routeMiddleware = [
        ....
        'permission' => \Vdes\PermisionRoles\Middleware\PermissionMiddleware::class,
    ];
```
# Cara penggunaan
Ada 2 cara penggunaan yaitu pada File Controller dan Blade anda.
## Cara menggunakan pada file controller
Sisipkan pada setiap method yang ada.
contoh jika anda menggunakan method default vdes index, create, store, edit, update, dan destroy
```php

...

class NamaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:namamodul-list',['only' => ['index']]);
        $this->middleware('permission:namamodultasks',['only' => ['store', 'create']]);
        $this->middleware('permission:namamodul-edit',['only' => ['edit','update']]);
        $this->middleware('permission:namamodul-delete',['only' => ['destroy']]);
    }

    ....
    
}
```
## cara meggunakan pada file blade
contoh jika kita ingin mengecek apakah user miliki akses untuk melihat list pada salah satu modul
```php
@role('namamodul-list')

@endrole
```

