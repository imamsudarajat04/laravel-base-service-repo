# 🚀 Laravel Base Service Repository Package

## English Version

### Introduction
Laravel Base Service Repository Package is a customizable package designed to simplify the implementation of Service and Repository patterns in your Laravel application. This package provides a structured approach to organizing business logic and database operations.

### 📦 Features
- Automatically generate Service and Repository classes.
- Configurable directory paths for generated files.
- Extendable base classes for Services and Repositories.
- Supports semantic versioning.

### 📜 Installation
1. Install the package via Composer:
   ```bash
   composer require imamsudarajat04/laravel-base-service-repo
   ```

2. Publish the configuration file:
   ```bash
   php artisan vendor:publish --tag=servicerepo-config
   ```

3. Customize the configuration file located at `config/servicerepo.php` if needed.

### ⚙️ Usage
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

### Configuration
The `config/servicerepo.php` file contains the following configurable options:
- **target_service_dir**: Directory for Service classes.
- **target_repository_dir**: Directory for Repository classes.
- **model_root_namespace**: Namespace for application models.
- **base_repository_parent_class**: Parent class for Repository.
- **base_service_parent_class**: Parent class for Service.

### Contribution
Feel free to fork and submit pull requests. Issues and feedback are highly welcome!

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

### Kontribusi
Silakan fork dan kirimkan pull request. Masukan dan feedback sangat dihargai!

### Lisensi
Paket ini bersifat open-source dan tersedia di bawah [MIT License](LICENSE).