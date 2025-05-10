<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CancelReasonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cancel_reasons')->delete();
        
        \DB::table('cancel_reasons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reason' => 'Driver Not Available',
                'cancelled_by' => 'Rider',
                'status' => 'Active',
            ),
            1 => 
            array (
                'id' => 2,
                'reason' => 'Driver not respond proper	',
                'cancelled_by' => 'Rider',
                'status' => 'Active',
            ),
            2 => 
            array (
                'id' => 3,
                'reason' => 'Wrong Route',
                'cancelled_by' => 'Rider',
                'status' => 'Active',
            ),
            3 => 
            array (
                'id' => 4,
                'reason' => 'Rider Not Available',
                'cancelled_by' => 'Driver',
                'status' => 'Active',
            ),
            4 => 
            array (
                'id' => 5,
                'reason' => 'Rider not respond proper',
                'cancelled_by' => 'Driver',
                'status' => 'Active',
            ),
            5 => 
            array (
                'id' => 6,
                'reason' => 'Rider not yet come',
                'cancelled_by' => 'Driver',
                'status' => 'Active',
            ),
            6 => 
            array (
                'id' => 7,
                'reason' => 'Rider ask for Cancel',
                'cancelled_by' => 'Admin',
                'status' => 'Active',
            ),
            7 => 
            array (
                'id' => 8,
                'reason' => 'Other Reasons',
                'cancelled_by' => 'Admin',
                'status' => 'Active',
            ),
            8 => 
            array (
                'id' => 9,
                'reason' => 'Rider Cancelled',
                'cancelled_by' => 'Company',
                'status' => 'Active',
            ),
        ));
        
        
    }
}