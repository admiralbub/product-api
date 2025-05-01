<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SeoProduct;
class SeoProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $seo_products = [
            [
                'name_ua'=>"H1 (RU)",
                'name_ru'=>"H1 (RU)",
                'key_meta_tag' => 'h1_ru', 
                'value_meta_tag' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"H1 (UA)",
                'name_ru'=>"H1 (UA)",
                'key_meta_tag' => 'h1_ua', 
                'value_meta_tag' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Meta title (RU)",
                'name_ru'=>"Meta title (RU)",
                'key_meta_tag' => 'meta_title_ru', 
                'value_meta_tag' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Meta title (UA)",
                'name_ru'=>"Meta title (UA)",
                'key_meta_tag' => 'meta_title_ua', 
                'value_meta_tag' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Meta Description (RU)",
                'name_ru'=>"Meta Description (RU)",
                'key_meta_tag' => 'meta_description_ru', 
                'value_meta_tag' => '',
                'type'=>'text'
            ],
            [
                'name_ua'=>"Meta Description (UA)",
                'name_ru'=>"Meta Description (UA)",
                'key_meta_tag' => 'meta_description_ua', 
                'value_meta_tag' => '',
                'type'=>'text'
            ],
            [
                'name_ua'=>"Meta Keywords (RU)",
                'name_ru'=>"Meta Keywords (RU)",
                'key_meta_tag' => 'meta_keywords_ru', 
                'value_meta_tag' => '',
                'type'=>'text'
            ],
            [
                'name_ua'=>"Meta Keywords (UA)",
                'name_ru'=>"Meta Keywords (UA)",
                'key_meta_tag' => 'meta_keywords_ua', 
                'value_meta_tag' => '',
                'type'=>'text'
            ],
            

            

        ];
        SeoProduct::insert($seo_products);
    }
}
