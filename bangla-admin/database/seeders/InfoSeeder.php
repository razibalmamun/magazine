<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keyArray = [
            'total_affected_bd' => 0,
            'total_recover_bd' => 0,
            'total_death_bd' => 0,
            'total_affected_int' => 0,
            'total_recover_int' => 0,
            'total_death_int' => 0,
            'address' => 'Dhaka 1212',
            'phone' => '123456789',
            'newsroom_hotline' => '123456789, 123456789',
            'whatsapp_number' => '123456789',
            'newsroom_email' => 'example@gmail.com, example2@gmail.com',
            'email' => 'main@gmail.com'
        ];
        foreach ($keyArray as $key=>$item) {
            Information::create([
                'info_key' => $key,
                'info_value' => $item
            ]);
        }
    }
}
