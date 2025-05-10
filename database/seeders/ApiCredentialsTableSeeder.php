<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApiCredentialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('api_credentials')->delete();
        
        \DB::table('api_credentials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'key',
                'value' => '#',
                'site' => 'GoogleMap',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'server_key',
                'value' => '#',
                'site' => 'GoogleMap',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'sid',
                'value' => '#',
                'site' => 'Twillo',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'token',
                'value' => '#',
                'site' => 'Twillo',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'service_sid',
                'value' => '#',
                'site' => 'Twillo',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'from',
                'value' => '#',
                'site' => 'Twillo',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'server_key',
                'value' => '#',
                'site' => 'FCM',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'sender_id',
                'value' => '#',
                'site' => 'FCM',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'client_id',
                'value' => '#',
                'site' => 'Facebook',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'client_secret',
                'value' => '#',
                'site' => 'Facebook',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'client_id',
                'value' => '#',
                'site' => 'Google',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'client_secret',
                'value' => '#',
                'site' => 'Google',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'sinch_key',
                'value' => '55992d18-0a40-44b9-8cf6-456f729031e7',
                'site' => 'Sinch',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'sinch_secret_key',
                'value' => 'yx4js89/Y0KxBNHwJWv+3w==',
                'site' => 'Sinch',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'service_id',
                'value' => '#',
                'site' => 'Apple',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'team_id',
                'value' => '#',
                'site' => 'Apple',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'key_id',
                'value' => '#',
                'site' => 'Apple',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'key_file',
                'value' => '/public/key.txt',
                'site' => 'Apple',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'database_url',
                'value' => 'https://xyz-rtdb.firebaseio.com',
                'site' => 'Firebase',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'service_account',
                'value' => '/resources/credentials//service_account.json',
                'site' => 'Firebase',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'site_key',
                'value' => '6LfJKvoUAAAAAFe8tYNw85mY5Tur-_A4tp865bL3',
                'site' => 'Recaptcha',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'secret_key',
                'value' => '6LfJKvoUAAAAABh-36UFZrtp-_bZEtdgcg0kwWhy',
                'site' => 'Recaptcha',
            ),
        ));
        
        
    }
}