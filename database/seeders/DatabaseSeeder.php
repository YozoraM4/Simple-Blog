<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            "name" => "Yozora",
            "email" => "yozora@gmail.com"
        ]);

        \App\Models\User::factory()->create([
            "name" => "Hoshikuzu",
            "email" => "hoshikuzu@gmail.com"
        ]);

        Article::factory(20)->create();
        Comment::factory(10)->create();

        $list = ["News", "Reviews", "Technologies", "Weathering", "Breaking News"];
        foreach($list as $category) {
            Category::create(['name' => $category]);
        }
    }
}
