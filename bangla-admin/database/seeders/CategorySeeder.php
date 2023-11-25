<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catArray = ['প্রচ্ছদ','রাজনীতি','জাতীয়','খেলা','আন্তর্জাতিক','বিনোদন','স্বাস্থ্য','ফিচার','আইন আদালত','প্রবাস','অর্থনীতি','লাইফ-স্টাইল','জবস','তথ্য-প্রযুক্তি','ধর্ম','সারাদেশ','মতামত','শিক্ষা'];

        foreach($catArray as $key=>$item){
            Category::create([
                'name' => $item,
                'order' => $key+1
            ]);
        }

    }
}
