<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Gallery;
use Faker\Factory as Faker;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $imageCount = 25;
        for ($i = 1; $i <= $imageCount; $i++) {
            $url = 'https://picsum.photos/1920/1080';
            $imageContent = file_get_contents($url);
            $fileName = Str::uuid() . '.jpg';
            Storage::disk('public')->put("images/{$fileName}", $imageContent);

            Gallery::create([
                'name' => $faker->words(2, true),
                'image' => "images/{$fileName}",
                'description' => $faker->sentence(),
            ]);
        }
    }
}
