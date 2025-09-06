# 🚀 Laravel Base Service Repository Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/imamsudarajat04/laravel-base-service-repo.svg?style=flat-square)](https://packagist.org/packages/imamsudarajat04/laravel-base-service-repo)
[![Total Downloads](https://img.shields.io/packagist/dt/imamsudarajat04/laravel-base-service-repo.svg?style=flat-square)](https://packagist.org/packages/imamsudarajat04/laravel-base-service-repo)
[![License](https://img.shields.io/packagist/l/imamsudarajat04/laravel-base-service-repo.svg?style=flat-square)](https://packagist.org/packages/imamsudarajat04/laravel-base-service-repo)

## English Version

### Introduction
Laravel Base Service Repository Package is a customizable package designed to simplify the implementation of Service and Repository patterns in your Laravel application. This package provides a structured approach to organizing business logic and database operations with modern PHP 8.3 features.

### 📦 Features
- Automatically generate Service and Repository classes.
- Configurable directory paths for generated files.
- Extendable base classes for Services and Repositories.
- Comprehensive CRUD operations with pagination.
- Advanced query methods (findBy, findFirstBy, exists, count).
- Custom exception handling with EmptyDataException.
- Type-safe method signatures with proper return types.
- Supports semantic versioning.

### 📜 Installation
1. Install the package via Composer:
   ```bash
   composer require imamsudarajat04/laravel-base-service-repo
   ```

2. Publish the configuration file:
   ```bash
   # Simple command (recommended)
   php artisan servicerepo:publish
   
   # Or using vendor:publish with tag
   php artisan vendor:publish --tag=servicerepo-config
   ```

3. Customize the configuration file located at `config/servicerepo.php` if needed.

### ⚙️ Usage

#### Helper Functions
The package provides convenient helper functions for quick access:

```php
// Get ServiceRepo instance
$serviceRepo = service_repo();

// Make a service with repository
$service = make_service(BlogService::class, BlogRepository::class);

// Make a repository with model
$repository = make_repository(BlogRepository::class, Blog::class);
```

#### Facade Usage
You can also use the ServiceRepo facade:

```php
use ServiceRepo;

// Make a service
$service = ServiceRepo::make(BlogService::class, BlogRepository::class);

// Make a repository
$repository = ServiceRepo::makeRepository(BlogRepository::class, Blog::class);
```

#### Creating a Service
Run the following command to generate a new service class:
```bash
php artisan make:service ServiceName
```
The service will be created in the directory defined in the configuration file (default: `app/Services`).

#### Creating a Repository
Run the following command to generate a new repository class:
```bash
php artisan make:repository RepositoryName
```

To create a repository with a model:
```bash
php artisan make:repository RepositoryName --model=ModelName
```
The repository will be created in the directory defined in the configuration file (default: `app/Repositories`).

### Example Workflow
1. Create a service:
   ```bash
   php artisan make:service UserService
   ```
   This generates `app/Services/UserService.php`.

2. Create a repository:
   ```bash
   php artisan make:repository UserRepository // Automaticly created repository and model
   php artisan make:repository UserRepository --withouth-model // Created repository without model
   ```
   This generates `app/Repositories/UserRepository.php`.

3. Use the generated service and repository in your controller or application logic.

### 📚 API Reference

#### BaseRepository Methods
- `getAll()` - Get all records
- `findById($id)` - Find record by ID
- `create($data)` - Create new record
- `update($id, $data)` - Update record by ID
- `delete($id)` - Delete record by ID
- `paginate($perPage = 15)` - Get paginated records
- `findBy($column, $value)` - Find records by column value
- `findFirstBy($column, $value)` - Find first record by column value
- `exists($id)` - Check if record exists
- `count()` - Get count of records
- `getModel()` - Get model instance
- `setModel($model)` - Set model instance
- `newQuery()` - Get new query builder

#### BaseService Methods
- `getAll()` - Get all records
- `findById($id)` - Find record by ID
- `create($data)` - Create new record
- `update($id, $data)` - Update record by ID
- `delete($id)` - Delete record by ID
- `paginate($perPage = 15)` - Get paginated records
- `findBy($column, $value)` - Find records by column value
- `findFirstBy($column, $value)` - Find first record by column value
- `exists($id)` - Check if record exists
- `count()` - Get count of records
- `getRepository()` - Get repository instance
- `setRepository($repository)` - Set repository instance
- `newQuery()` - Get new query builder

#### EmptyDataException
- `EmptyDataException::forModel($model, $id)` - Create exception for specific model
- `EmptyDataException::forColumn($model, $column, $value)` - Create exception for specific column

### Configuration
The `config/servicerepo.php` file contains the following configurable options:
- **target_service_dir**: Directory for Service classes.
- **target_repository_dir**: Directory for Repository classes.
- **model_root_namespace**: Namespace for application models.
- **base_repository_parent_class**: Parent class for Repository.
- **base_service_parent_class**: Parent class for Service.


### Contribution
Feel free to fork and submit pull requests. Issues and feedback are highly welcome!

### 🔧 Troubleshooting

#### Command `vendor:publish` tidak berfungsi?
Jika command `vendor:publish` tidak berfungsi, gunakan command yang lebih simple:
```bash
php artisan servicerepo:publish
```

#### Package tidak terdeteksi otomatis?
Pastikan Anda sudah menjalankan:
```bash
composer dump-autoload
```

#### Command tidak tersedia?
Pastikan package sudah terinstall dengan benar:
```bash
composer require imamsudarajat04/laravel-base-service-repo
```

### License
This package is open-source and available under the [MIT License](LICENSE).

---

## Versi Bahasa Indonesia

### Pengantar
Laravel Base Service Repository Package adalah package yang dapat dikustomisasi untuk mempermudah implementasi pola Service dan Repository dalam aplikasi Laravel Anda. Paket ini memberikan pendekatan terstruktur untuk mengatur logika bisnis dan operasi database.

### 📦 Fitur
- Membuat kelas Service dan Repository secara otomatis.
- Direktori file yang dihasilkan dapat dikonfigurasi.
- Kelas dasar yang dapat diperluas untuk Service dan Repository.
- Mendukung versi semantik.

### 📜 Instalasi
1. Pasang package melalui Composer:
   ```bash
   composer require imamsudarajat04/laravel-base-service-repo
   ```

2. Publikasikan file konfigurasi:
   ```bash
   # Command yang lebih simple (direkomendasikan)
   php artisan servicerepo:publish
   
   # Atau menggunakan vendor:publish dengan tag
   php artisan vendor:publish --tag=servicerepo-config
   ```

3. Sesuaikan file konfigurasi yang terletak di `config/servicerepo.php` jika diperlukan.

### ⚙️ Penggunaan
#### Membuat Service
Jalankan perintah berikut untuk membuat kelas Service baru:
```bash
php artisan make:service ServiceName
```
Service akan dibuat di direktori yang didefinisikan dalam file konfigurasi (default: `app/Services`).

#### Membuat Repository
Jalankan perintah berikut untuk membuat kelas Repository baru:
```bash
php artisan make:repository RepositoryName
```
Repository akan dibuat di direktori yang didefinisikan dalam file konfigurasi (default: `app/Repositories`).

### Contoh Alur Kerja
1. Membuat Service:
   ```bash
   php artisan make:service UserService
   ```
   Ini akan menghasilkan `app/Services/UserService.php`.

2. Membuat Repository:
   ```bash
   php artisan make:repository UserRepository // Membuat repositori dan model secara automatis
   php artisan make:repository UserRepository --without-model // Membuat repositori tanpa model
   ```
   Ini akan menghasilkan `app/Repositories/UserRepository.php`.

3. Gunakan Service dan Repository yang dihasilkan dalam controller atau logika aplikasi Anda.

### Konfigurasi
File `config/servicerepo.php` berisi opsi konfigurasi berikut:
- **target_service_dir**: Direktori untuk kelas Service.
- **target_repository_dir**: Direktori untuk kelas Repository.
- **model_root_namespace**: Namespace untuk model aplikasi.
- **base_repository_parent_class**: Kelas induk untuk Repository.
- **base_service_parent_class**: Kelas induk untuk Service.

### 🧪 Testing

Package ini dilengkapi dengan test coverage yang komprehensif. Jalankan test menggunakan:

```bash
# Install dev dependencies
composer install --dev

# Jalankan semua test
composer test

# Jalankan test dengan coverage
composer test-coverage
```

Test coverage mencakup:
- ✅ ServiceProvider registration dan konfigurasi
- ✅ Semua artisan commands (make:service, make:repository, servicerepo:publish)
- ✅ Fungsi BaseRepository dan BaseService
- ✅ Exception handling
- ✅ Integration tests untuk workflow lengkap

### Kontribusi
Silakan fork dan kirimkan pull request. Masukan dan feedback sangat dihargai!

### 🔧 Troubleshooting

#### Command `vendor:publish` tidak berfungsi?
Jika command `vendor:publish` tidak berfungsi, gunakan command yang lebih simple:
```bash
php artisan servicerepo:publish
```

#### Package tidak terdeteksi otomatis?
Pastikan Anda sudah menjalankan:
```bash
composer dump-autoload
```

#### Command tidak tersedia?
Pastikan package sudah terinstall dengan benar:
```bash
composer require imamsudarajat04/laravel-base-service-repo
```

### Lisensi
Paket ini bersifat open-source dan tersedia di bawah [MIT License](LICENSE).
