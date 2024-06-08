<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            'videoId' => "DI71FIdguUs",
            'title' => "Tiago PZK, Ke Personajes - Piel (Video Oficial)",
            'thumbnails_default' => "https://i.ytimg.com/vi/DI71FIdguUs/default.jpg",
            'thumbnails_medium' => "https://i.ytimg.com/vi/DI71FIdguUs/mqdefault.jpg",
            'thumbnails_heigh' => "https://i.ytimg.com/vi/DI71FIdguUs/hqdefault.jpg"
        ]);

        Video::create([
            'videoId' => "Dcow-Jp3Ak4",
            'title' => "Ke Personajes Ft  Onda Sabanera | Pobre Corazón",
            'thumbnails_default' => "https://i.ytimg.com/vi/Dcow-Jp3Ak4/default.jpg",
            'thumbnails_medium' => "https://i.ytimg.com/vi/Dcow-Jp3Ak4/mqdefault.jpg",
            'thumbnails_heigh' => "https://i.ytimg.com/vi/Dcow-Jp3Ak4/hqdefault.jpg"
        ]);
    }
}
