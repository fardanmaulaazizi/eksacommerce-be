<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Monitor Samsung 27" Inch C27R500 Curved FHD LED FREESYNC | C27R500FHE - 27',
            'description' => 'The Samsung C27R500 and C32R500 monitors offer a VA Curved panel in 27 and 32 inches with a 1920 x 1080 resolution and a 16:9 aspect ratio. These displays feature 250 cd/㎡ brightness, 4 ms response time, and a 60/75 Hz refresh rate with AMD FreeSync™ support for smooth visuals. Connectivity includes HDMI 1.4 and D-Sub inputs, with a 3.5 mm audio out port but no built-in speakers. They support VESA mounting (75x75 mm) but lack an ergonomic stand. The panels have an 8-bit color depth, with 72% NTSC color coverage. Maximum power consumption is 35W for the C27R500 and 48W for the C32R500. The monitors weigh 4.3 kg and 5.9 kg, respectively, and come with an adapter, power cable, and HDMI cable.',
            'category_id' => 1,
            'store_id' => 1,
            'price' => 1685000,
            'image' => 'images/products/monitor.png',
        ]);
        DB::table('products')->insert([
            'name' => 'Xiaomi 14T',
            'description' => 'In collaboration with Leica, the Xiaomi 14T is now equipped with the New Generation Leica Optical Lens and a professional lens set, delivering remarkable photography performance, especially in low-light conditions. You can optimize the lighting to capture the best results anytime, anywhere. As a result, photos become more detailed, sharp, and lifelike in dimension.',
            'category_id' => 1,
            'store_id' => 1,
            'price' => 1685000,
            'image' => 'images/products/hp-xiaomi.png',
        ]);
        DB::table('products')->insert([
            'name' => 'Celana Chino Panjang Pria Civity Original',
            'description' => 'The Elana Chino by Civity offers a stylish, slim-fit design made from stretchable twill fabric, providing both comfort and flexibility. Available in sizes 28 to 38, these chinos feature pre-cut buttonholes and size-specific dimensions for a perfect fit. Lengths range from 101 cm to 106 cm, with waist measurements from 78 cm to 98 cm and thigh circumferences from 52 cm to 64 cm, with a tolerance of +/- 1 cm. Civity guarantees a 100% money-back guarantee if the product is received damaged or does not match the order specifications.',
            'category_id' => 2,
            'store_id' => 2,
            'price' => 117000,
            'image' => 'images/products/celana.png',
        ]);
        DB::table('products')->insert([
            'name' => 'Heavyweight T-Shirt Manta Crypto',
            'description' => 'The Manta Network Bullrun 2024/2025 T-Shirt by New States Apparel is a perfect casual choice, featuring the Manta logo and ticker for crypto enthusiasts. Made from 100% soft 20s cotton, it offers comfort with sweat-absorbent fabric, reinforced circular stitching at the shoulder and collar, and a seamless shape without edge stitching. Available in sizes S to 2XL (S: 45.7 cm x 69.5 cm, M: 50.8 cm x 72 cm, L: 55.9 cm x 74.5 cm, XL: 61 cm x 77 cm, 2XL: 66 cm x 80 cm), this heavyweight tee is designed with double-stitched sleeves and hem. For care, avoid machine washing, limit soaking time to under 10 minutes, use low-temperature washing without bleach, avoid harsh scrubbing, air dry inside-out away from direct sunlight, and iron at low heat.',
            'category_id' => 2,
            'store_id' => 2,
            'price' => 117000,
            'image' => 'images/products/baju-manta.png',
        ]);
        DB::table('products')->insert([
            'name' => 'Building a Second Brain',
            'description' => 'Building a Second Brain: is a self-improvement book by Tiago Forte that teaches you how to manage your digital life to be more productive and creative. The book introduces the concept of a second brain, a system for storing and organizing digital information so you can easily access, arrange, and use it whenever you need. Divided into three parts, the first section covers the foundations of a second brain, including its history, philosophy, and benefits. The second part explains the four-step methodology: capture, organize, distill, and express. The final section guides you on how to use your second brain to boost productivity, achieve goals, and develop your skills.',
            'category_id' => 5,
            'store_id' => 3,
            'price' => 90000,
            'image' => 'images/products/buku-second-brain.png',
        ]);
        DB::table('products')->insert([
            'name' => 'Muhammad Alfatih Konstatinopel Series',
            'description' => 'Muhammad Al-Fatih Constantinople Comics: This series is a package of 3 Muhammad Al-Fatih comic books, complete with an exclusive box to keep the books safe, offered at the same price as a single book.',
            'category_id' => 5,
            'store_id' => 3,
            'price' => 299000,
            'image' => 'images/products/buku-muhammad-al-fatih.png',
        ]);
    }
}
