<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MetaTemplate;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exhibitionCategory = Category::create([
            'title'=> 'exhibition'
        ]);

        $tradeCategory = Category::create([
            'title'=> 'tradeshow'
        ]);

        $conferenceCateogry = Category::create([
            'title'=> 'conference'
        ]);

        $categoryMetas = [
            [
                'category' => $exhibitionCategory,
                'key' => 'ticketing_link',
                'type' => 'link',
            ],
        ];

        foreach ($categoryMetas as $meta)
            MetaTemplate::create(
                [
                    'category_id' => $meta['category']->id,
                    'key' => $meta['key'],
                    'type' => $meta['type'],
                ]
            );
    }
}
