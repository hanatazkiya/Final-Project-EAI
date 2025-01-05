<?php

namespace Database\Seeders;

use App\Models\PlaceDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlaceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlaceDetail::create([
            'place_id' => 1,
            'admin_username' => 'kangmas_admin',
            'description' => 'Ini adalah deskripsi lengkap mengenai Pasar Beringharjo. Tempat ini sangat indah dan menarik untuk dikunjungi bersama keluarga dan teman-teman. Anda dapat menikmati pemandangan yang menakjubkan, fasilitas yang lengkap, dan berbagai aktivitas menarik yang tersedia di sini. Jangan lewatkan kesempatan untuk mengunjungi tempat ini dan menciptakan kenangan indah bersama orang-orang terdekat Anda.',
            'city' => 'Sleman, Yogyakarta',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3952.9161156785894!2d110.3617084!3d-7.7987057!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a578648be564f%3A0x7c0fcda6bd455d3d!2sPasar%20Beringharjo%20Yogyakarta!5e0!3m2!1sid!2sid!4v1735184704113!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);

        PlaceDetail::create([
            'place_id' => 2,
            'admin_username' => 'kangmas_admin',
            'description' => 'Ini adalah deskripsi lengkap mengenai Tanah Lot. Tempat ini sangat indah dan menarik untuk dikunjungi bersama keluarga dan teman-teman. Anda dapat menikmati pemandangan yang menakjubkan, fasilitas yang lengkap, dan berbagai aktivitas menarik yang tersedia di sini. Jangan lewatkan kesempatan untuk mengunjungi tempat ini dan menciptakan kenangan indah bersama orang-orang terdekat Anda.',
            'city' => 'Denpasar, Bali',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63105.79716915372!2d115.1341587!3d-8.6808676!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd237824f71deab%3A0xcaabe270f7e34d69!2sTanah%20Lot!5e0!3m2!1sid!2sid!4v1735184719280!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);

        PlaceDetail::create([
            'place_id' => 3,
            'admin_username' => 'kangmas_admin',
            'description' => 'Ini adalah deskripsi lengkap mengenai Caub Baturaden. Tempat ini sangat indah dan menarik untuk dikunjungi bersama keluarga dan teman-teman. Anda dapat menikmati pemandangan yang menakjubkan, fasilitas yang lengkap, dan berbagai aktivitas menarik yang tersedia di sini. Jangan lewatkan kesempatan untuk mengunjungi tempat ini dan menciptakan kenangan indah bersama orang-orang terdekat Anda.',
            'city' => 'Baturaden, Purwokerto',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3957.33952072044!2d109.2390172!3d-7.3157037!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ff56e58d8446b%3A0xcb05909ec9c962f6!2sCAUB%20(Camp%20Area%20Umbul%20Bengkok)!5e0!3m2!1sid!2sid!4v1735184731442!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);

        PlaceDetail::create([
            'place_id' => 4,
            'admin_username' => 'kangmas_admin',
            'description' => 'Ini adalah deskripsi lengkap mengenai Terasering Panyaweuyan. Tempat ini sangat indah dan menarik untuk dikunjungi bersama keluarga dan teman-teman. Anda dapat menikmati pemandangan yang menakjubkan, fasilitas yang lengkap, dan berbagai aktivitas menarik yang tersedia di sini. Jangan lewatkan kesempatan untuk mengunjungi tempat ini dan menciptakan kenangan indah bersama orang-orang terdekat Anda.',
            'city' => 'Argapura, Majalengka',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7688861407264!2d108.3451199!3d-6.9182103999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f3cbd246b010d%3A0xb911177c0565c856!2sTerasering%20Panyaweuyan!5e0!3m2!1sid!2sid!4v1735184741106!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);

        PlaceDetail::create([
            'place_id' => 5,
            'admin_username' => 'kangmas_admin',
            'description' => 'Ini adalah deskripsi lengkap mengenai Pantai Widuri. Tempat ini sangat indah dan menarik untuk dikunjungi bersama keluarga dan teman-teman. Anda dapat menikmati pemandangan yang menakjubkan, fasilitas yang lengkap, dan berbagai aktivitas menarik yang tersedia di sini. Jangan lewatkan kesempatan untuk mengunjungi tempat ini dan menciptakan kenangan indah bersama orang-orang terdekat Anda.',
            'city' => 'Widuri, Pemalang',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18842.814101823846!2d109.37233764861573!3d-6.864974293881769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fc4b63c6cf3c9%3A0x59d459c19070a44!2sPantai%20Widuri%20Pemalang!5e0!3m2!1sid!2sid!4v1735185639243!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);
    }
}
