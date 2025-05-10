<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admins')->delete();
        
        \DB::table('admins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$DSSyOFQW7.Rw8Vwp6EZndOgsqq/DmTjlptMp6HcJBcRsvcK30g9sW',
                'country_code' => '1',
                'country_id' => 38,
                'mobile_number' => '254700207417',
                'remember_token' => NULL,
                'status' => 'Active',
                'created_at' => '2021-12-18 15:35:20',
                'updated_at' => '2022-05-20 07:20:11',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}