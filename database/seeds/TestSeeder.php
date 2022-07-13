<?php

use Illuminate\Database\Seeder;

use App\Category;
use App\Guide;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(["name" => "Equipment", "slug" => "equipment", "description" => "This is the equipment description"]);
        Category::create(["name" => "History", "slug" => "history", "description" => "This is the history description"]);
        Category::create(["name" => "New Player", "slug" => "new-player", "description" => "This is the new player description"]);
        Category::create(["name" => "Software", "slug" => "software", "description" => "This is the software description"]);
        Category::create(["name" => "Strategy", "slug" => "strategy", "description" => "This is the strategy description"]);
        Category::create(["name" => "Streaming", "slug" => "streaming", "description" => "This is the streaming description"]);
        Category::create(["name" => "Tournaments", "slug" => "tournaments", "description" => "This is the tournaments description"]);

        Guide::create(["name" => "join communities", "slug" => "join-communities", "description" => "join communities description", "content" => "join communities content"]);
        Guide::create(["name" => "start streaming", "slug" => "start-streaming", "description" => "start streaming description", "content" => "start streaming content"]);
        Guide::create(["name" => "how to stack", "slug" => "how-to-stack", "description" => "how to stack description", "content" => "how to stack content"]);
        Guide::create(["name" => "learning spintucks", "slug" => "learning-spintucks", "description" => "learning spintucks description", "content" => "learning spintucks content"]);

        Guide::find(1)->categories()->attach([3, 7]);
        Guide::find(2)->categories()->attach([3, 4, 6]);
        Guide::find(3)->categories()->attach([3, 5]);
        Guide::find(4)->categories()->attach([5]);
    }
}
