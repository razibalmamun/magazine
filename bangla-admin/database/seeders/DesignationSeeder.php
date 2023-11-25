<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations =[
            ['name'=>'সম্পাদক'],
            ['name'=>'বিশেষ প্রতিবেদক'],
            ['name'=>'জ্যেষ্ঠ প্রতিবেদক'],
            ['name'=>'নিজস্ব প্রতিবেদক'],
            ['name'=>'নিজস্ব প্রতিবেদক'],
            ['name'=>'যুগ্ম বার্তা সম্পাদক'],
            ['name'=>'সহকারী বার্তা সম্পাদক'],
            ['name'=>'সহকারী বার্তা সম্পাদক'],
            ['name'=>'সহ-সম্পাদক'],
            ['name'=>'ক্রীড়া প্রতিবেদক'],
            ['name'=>'রিলিজিয়াস এডিটর'],
        ];

        \DB::table('designations')->insert($designations);
    }
}
