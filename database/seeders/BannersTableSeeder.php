<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banners')->delete();
        
        \DB::table('banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'NewTaxi',
                'description' => 'NewTaxi',
                'url' => 'https://new.newtaxi.co/images/banner/category-image1687645046.jpg',
                'link' => 'https://new.newtaxi.co/public/images/banner/category-image1687643916.jpg',
                'status' => 'Active',
                'created_at' => '2023-06-24 23:36:28',
                'updated_at' => '2023-06-25 01:17:26',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'NewTaxi',
                'description' => 'NewTaxi',
                'url' => 'https://new.newtaxi.co/images/banner/category-image1687644945.jpg',
                'link' => 'https://new.newtaxi.co/',
                'status' => 'Active',
                'created_at' => '2023-06-24 23:36:28',
                'updated_at' => '2023-06-25 01:15:45',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'New Ride',
                'description' => 'New Ride',
                'url' => 'https://new.newtaxi.co/public/images/banner/category-image1687643916.jpg',
                'link' => 'https://new.newtaxi.co/',
                'status' => 'Active',
                'created_at' => '2023-06-25 00:58:36',
                'updated_at' => '2023-06-25 00:59:58',
            ),
        ));
        
        
    }
}