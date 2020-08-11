<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'exhibition',
            'tradeshow',
            'conference',
            'offline',
            'online',
        ];

        foreach ($tags as $tag)
            Tag::create(['title' => $tag]);
    }
}
