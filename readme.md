## SEWA MOBIL

Aplikasi Rental Mobil berbasis web dibangun dengan laravel 5.8 dan Mysql

## Step

1. Gunakan perintah git clone untuk mengunduh repository ke dalam direktori lokal
   
2. Setelah repository terunduh, masuk ke direktori proyek Laravel
   
3. Setelah itu, instal semua dependencies yang diperlukan menggunakan Composer
   composer install

4. Duplikat file .env.example sebagai .env
   cp .env.example .env

5. Laravel menggunakan kunci enkripsi yang perlu di-generate. Jalankan perintah 
   php artisan key:generate

6. jalankan migrasi dan seed untuk membuat skema basis data
   php artisan migrate
   php artisan db:seed
   
8. Untuk menjalankan proyek di server lokal, gunakan perintah
   php artisan serve

## Login
username : user
password : rahasia

