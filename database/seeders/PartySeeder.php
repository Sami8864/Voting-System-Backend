<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parties')->insert([
            [
                'name' => 'Muslim League Noon(PMLN)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715612378.jpg',
                'leader' => 'Nawaz Sharif',

            ], [
                'name' => 'Pakistan People Party(PPP)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715612355.jpg',
                'leader' => 'Bilawal Bhutto',
            ], [
                'name' => 'Pakistan Tehreeke Insaaf(PTI)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715611781.jpg',
                'leader' => 'Imran Khan',
            ], [
                'name' => 'Muttahida Qaumi Movement(MQM)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715611716.jpg',
                'leader' => 'Altaf Hussain',
            ], [
                'name' => 'Jamiat Ulema-e-Islam(JUI-F)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715612146.jpg',
                'leader' => 'Faza-Ur-Rehman',
            ], [
                'name' => 'Jamaat-e-Islami(JI)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715611733.jpg',
                'leader' => 'Siraj-ul-Haq',
            ], [
                'name' => 'Awami National Party(ANP)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715611583.jpg',
                'leader' => 'Asfandyar Wali',
            ], [
                'name' => 'Independent(IND)',
                'image' => 'https://casttypes-v2-bucket.nyc3.digitaloceanspaces.com/temp_images/1715611382/1715611611.jpg',
                'leader' => 'Anonymous',
            ]
        ]);
    }
}
