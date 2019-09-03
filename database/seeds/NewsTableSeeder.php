<?php

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::truncate(); // 先清理数据

        $faker = app(Faker\Generator::class);
        $news = factory(News::class)->times(10)->make()->each(function($news) use ($faker){
        });
        News::insert($news->toArray());
    }
}
