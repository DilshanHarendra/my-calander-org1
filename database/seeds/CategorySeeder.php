<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\MetaTemplate;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $onlineCategory = Category::create([
            'title'=> 'online'
        ]);

        $offlineCategory = Category::create([
            'title'=> 'offline'
        ]);


        $categoryMetas = [
            [
                'category' => $onlineCategory,
                'key' => 'html_link',
                'type' => 'link',
            ],
            [
                'category' => $offlineCategory,
                'key' => 'location',
                'type' => 'address',
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
