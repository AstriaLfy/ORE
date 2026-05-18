<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            [
                'user_id'     => 2,
                'name'        => 'Laptop Asus VivoBook 14',
                'description' => 'Laptop second kondisi baik. Spek: Intel Core i5 gen 10, RAM 8GB, SSD 512GB. Layar 14 inch FHD. Baterai masih awet 4-5 jam. Mulus, tidak ada dead pixel. Cocok untuk kuliah atau kerja.',
                'price'       => 4800000,
                'stock'       => 1,
                'category'    => 'Elektronik',
                'condition'   => 'good',
                'status'      => 'available',
            ],
            [
                'user_id'     => 2,
                'name'        => 'iPhone 11 128GB Black',
                'description' => 'iPhone 11 second mulus. Baterai health 87%. Tidak ada goresan berarti di layar. Lengkap dengan dus original. Face ID normal.',
                'price'       => 3200000,
                'stock'       => 1,
                'category'    => 'Elektronik',
                'condition'   => 'like_new',
                'status'      => 'available',
            ],
            [
                'user_id'     => 2,
                'name'        => 'Headphone Sony WH-1000XM3',
                'description' => 'Headphone noise cancelling Sony second. Suara jernih, ANC masih berfungsi dengan baik. Bantalan telinga masih empuk. Jual karena upgrade.',
                'price'       => 1350000,
                'stock'       => 1,
                'category'    => 'Elektronik',
                'condition'   => 'good',
                'status'      => 'available',
            ],
            [
                'user_id'     => 3,
                'name'        => 'Kamera Canon EOS 200D',
                'description' => 'DSLR Canon 200D bekas pakai pribadi. Shutter count sekitar 5000. Lensa kit 18-55mm included. Kondisi mulus, hasil foto tajam. Cocok untuk pemula fotografi.',
                'price'       => 4200000,
                'stock'       => 1,
                'category'    => 'Elektronik',
                'condition'   => 'good',
                'status'      => 'available',
            ],
            [
                'user_id'     => 3,
                'name'        => 'Nintendo Switch Lite Turquoise',
                'description' => 'Switch Lite bekas, kondisi sangat baik. Layar tidak ada goresan. Sudah dipasang tempered glass sejak hari pertama. Jual karena jarang dimainkan.',
                'price'       => 2100000,
                'stock'       => 1,
                'category'    => 'Elektronik',
                'condition'   => 'like_new',
                'status'      => 'available',
            ],

            [
                'user_id'     => 3,
                'name'        => 'Tas Ransel Eiger Second',
                'description' => 'Ransel Eiger 30L bekas pakai 1 tahun. Kondisi masih bagus, tidak ada robek. Warna hitam. Cocok untuk hiking atau kuliah.',
                'price'       => 280000,
                'stock'       => 1,
                'category'    => 'Fashion',
                'condition'   => 'good',
                'status'      => 'available',
            ],
            [
                'user_id'     => 3,
                'name'        => 'Sepatu Nike Air Max 270 Size 42',
                'description' => 'Nike Air Max 270 original second. Dipakai hanya beberapa kali. Kondisi 90% mulus, sol masih tebal. Warna putih hitam.',
                'price'       => 650000,
                'stock'       => 1,
                'category'    => 'Fashion',
                'condition'   => 'like_new',
                'status'      => 'available',
            ],
            [
                'user_id'     => 2,
                'name'        => 'Jaket Outdoor The North Face',
                'description' => 'Jaket gunung The North Face second. Waterproof masih berfungsi. Ukuran M. Warna navy. Dipakai 3x hiking. Jual karena beli ukuran baru.',
                'price'       => 450000,
                'stock'       => 1,
                'category'    => 'Fashion',
                'condition'   => 'good',
                'status'      => 'available',
            ],

            [
                'user_id'     => 2,
                'name'        => 'Kursi Gaming Rexus second',
                'description' => 'Kursi gaming Rexus bekas pakai 1.5 tahun. Sandaran masih tegak, busa belum kempes. Warna hitam merah. Bongkar pasang sendiri.',
                'price'       => 600000,
                'stock'       => 1,
                'category'    => 'Perabot Rumah',
                'condition'   => 'good',
                'status'      => 'available',
            ],
            [
                'user_id'     => 3,
                'name'        => 'Lemari Pakaian 2 Pintu',
                'description' => 'Lemari kayu second ukuran 90x180cm. Kondisi masih kokoh, cat masih bagus. Engsel pintu normal semua. Bisa diambil sendiri, lokasi Malang.',
                'price'       => 500000,
                'stock'       => 1,
                'category'    => 'Perabot Rumah',
                'condition'   => 'fair',
                'status'      => 'available',
            ],
            [
                'user_id'     => 2,
                'name'        => 'Rice Cooker Miyako 1.8L',
                'description' => 'Rice cooker Miyako second, masih normal. Hemat listrik. Dilengkapi sendok dan gelas takar. Cocok untuk kos atau keluarga kecil.',
                'price'       => 120000,
                'stock'       => 2,
                'category'    => 'Perabot Rumah',
                'condition'   => 'good',
                'status'      => 'available',
            ],

            [
                'user_id'     => 3,
                'name'        => 'Sepeda Lipat Polygon Urbano 3',
                'description' => 'Sepeda lipat Polygon Urbano second. Kondisi masih sangat baik. Ban baru diganti 3 bulan lalu. Rem dan gigi berfungsi normal. Warna putih.',
                'price'       => 1800000,
                'stock'       => 1,
                'category'    => 'Olahraga',
                'condition'   => 'good',
                'status'      => 'available',
            ],
            [
                'user_id'     => 2,
                'name'        => 'Barbel Set 20KG Adjustable',
                'description' => 'Set barbel 20kg bekas, semua plat lengkap. Kondisi masih bagus, tidak ada retak. Cocok untuk home gym. Jual karena pindah rumah.',
                'price'       => 320000,
                'stock'       => 1,
                'category'    => 'Olahraga',
                'condition'   => 'good',
                'status'      => 'available',
            ],

            [
                'user_id'     => 3,
                'name'        => 'Buku Clean Code - Robert C. Martin',
                'description' => 'Buku Clean Code edisi bahasa Inggris. Kondisi baik, tidak ada coret-coretan. Beberapa halaman awal ada lipatan kecil. Wajib baca untuk developer.',
                'price'       => 95000,
                'stock'       => 1,
                'category'    => 'Buku',
                'condition'   => 'good',
                'status'      => 'available',
            ],
            [
                'user_id'     => 2,
                'name'        => 'Paket Buku Laravel & PHP (3 buku)',
                'description' => 'Paket 3 buku: Laravel Up & Running, PHP 8 Objects Patterns, Modern PHP. Semua kondisi baik, tidak ada sobekan. Cocok untuk belajar backend.',
                'price'       => 210000,
                'stock'       => 1,
                'category'    => 'Buku',
                'condition'   => 'good',
                'status'      => 'available',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}