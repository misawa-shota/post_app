<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //カテゴリー名を記載
        $food_categories = [
            '和食', '中華', '洋食', '丼物', '海鮮料理', '焼き鳥', '鍋料理', 'ラーメン', 'デザート', 'スイーツ', 'ステーキ', '焼肉', 'ハンバーガー', 'パン', '揚げ物'
        ];

        foreach($food_categories as $food_category){
            Category::create([
                'name' => $food_category
            ]);
        };
    }
}
