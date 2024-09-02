# Sistem Gudang

## About Me

Website: [Adityo Ar Rafiuddin](https://adityoarr.github.io/) <br/>
Social Media: [adityoarr](https://linktr.ee/adityoarr)

## Intro

Ini adalah projek berisi API yang dibuat menggunakan laravel + SQLite untuk tes kerja di ID-GROW. Cara instal projek ini di lokal anda adalah sebagai berikut:

1. Clone/Download projek ini
2. Buka cmd / terminal, arahkan ke root projek ini, lalu ketik <i>composer install</i>
3. Bila sudah berhasil, ketik <i>php artisan serve</i> untuk menjalankan projek

## API List

Berikut adalah daftar API yang dibuat pada projek ini

-   **POST api/login** -> get bearer token

-   **GET api/user** -> list all user + detail
-   **GET api/user/{idUser}** -> detail user by user id
-   **POST api/user** -> add user
-   **PUT api/user/{idUser}** -> edit user by user id
-   **DELETE api/user/{idUser}** -> delete user by user id

-   **GET api/barang** -> list all barang + detail
-   **GET api/barang/{kodeBarang}** -> detail barang by kodeBarang
-   **POST api/barang** -> add barang
-   **PUT api/barang/{kodeBarang}** -> edit barang by kodeBarang
-   **DELETE api/barang/{kodeBarang}** -> delete barang by kodeBarang

-   **GET api/mutasi** -> list all mutasi + detail
-   **GET api/mutasi/{idMutasi}** -> detail mutasi by idMutasi
-   **POST api/mutasi** -> add mutasi
-   **PUT api/mutasi/{idMutasi}** -> edit mutasi by idMutasi
-   **DELETE api/mutasi/{idMutasi}** -> delete mutasi by idMutasi
-   **GET api/history-mutasi-user/{idUser}** -> list all mutasi + detail history by user (idUser)
-   **GET api/history-mutasi-barang/{kodeBarang}** -> list all mutasi + detail history by barang (kodeBarang)

Semua API (kecuali login) harus diakses menggunakan token bearer yang dapat diperoleh melalui API Login. Akun tester yang dapat digunakan pada api login: <br/>
email: admin@example.com <br/>
password: admin <br/><br/>

Link publish postman dapat dilihat [disini](https://documenter.getpostman.com/view/28365413/2sAXjM4BuC)

