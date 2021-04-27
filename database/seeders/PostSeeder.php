<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$faker = Faker\Factory::create('tr_TR');

        for($i=0; $i<10; $i++) {
            /*Post::create([
                'title'             => $faker->title(5),
                'slug'              => slug($faker->title(5)),
                'detail'            => $faker->paragraph(10),
                'category_id'       => '1',
                'tags'              => join(',', $faker->words(3)),
            ]);*/

            Post::create([
                'title' => 'What is Lorem Ipsum?',
                'slug' => Str::slug('What is Lorem Ipsum?' . $i),
                'category_id' => '1',
                'detail' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>',
            ]);
        }
    }
}
