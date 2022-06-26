<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'heading' => 'We develop',
            'name' => 'Website',
            'slug' => 'website',
            'lottie_src' => 'https://assets10.lottiefiles.com/packages/lf20_4VvdIQ.json',
        ]);

        Service::create([
            'heading' => 'We build',
            'name' => 'Mobile App',
            'slug' => 'mobile-app',
            'lottie_src' => 'https://assets6.lottiefiles.com/packages/lf20_r6lfrga3.json',
        ]);

        Service::create([
            'heading' => 'We make',
            'name' => '3D Design',
            'slug' => '3d-design',
            'lottie_src' => 'https://assets6.lottiefiles.com/packages/lf20_ihg7zmol.json',
        ]);

        Service::create([
            'heading' => 'We do',
            'name' => '3D Printing',
            'slug' => '3d-printing',
            'lottie_src' => 'https://assets6.lottiefiles.com/packages/lf20_vu2p4il8.json',
        ]);
    }
}
