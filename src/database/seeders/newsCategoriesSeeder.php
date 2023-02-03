<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsCategories;
class newsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $categories = array('business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology');

        if(empty(NewsCategories::find(1))) {
            foreach ($categories as $category) {


                NewsCategories::create(['title' => $category]);

            }
        }

    }
}
