<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DvisionWeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $division = [
            ['name'=>'আমরা','order'=>1],
            ['name'=>'রিপোর্টিং বিভাগ','order'=>2],
            ['name'=>'সেন্ট্রাল বিভাগ','order'=>3],
            ['name'=>'সারাদেশ বিভাগ','order'=>4],
            ['name'=>'ফিচার বিভাগ','order'=>5],
            ['name'=>'খেলা বিভাগ','order'=>6],
            ['name'=>'আন্তর্জাতিক বিভাগ','order'=>7],
            ['name'=>'সম্পাদকীয় ও গবেষণা','order'=>8],
            ['name'=>'বিজনেস ডেভেলপমেন্ট অ্যান্ড মার্কেটিং বিভাগ','order'=>9],
            ['name'=>'ওয়েব বিভাগ','order'=>10],
            ['name'=>'সোশ্যাল মিডিয়া বিভাগ','order'=>11],
            ['name'=>'ভিডিও বিভাগ','order'=>12],
            ['name'=>'প্রশাসন বিভাগ','order'=>13],
            ['name'=>'অন্যান্য','order'=>14],
        ];
        \DB::table('division_wes')->insert($division);
    }
}
