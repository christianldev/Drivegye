<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppVersionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('app_version')->delete();
        
        
        
    }
}