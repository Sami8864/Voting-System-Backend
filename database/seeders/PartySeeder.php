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
                'image' => '',
                'leader' => 'Nawaz Sharif',

            ], [
                'name' => 'Pakistan People Party(PPP)',
                'image' => '',
                'leader' => 'Bilawal Bhutto',
            ], [
                'name' => 'Pakistan Tehreeke Insaaf(PTI)',
                'image' => '',
                'leader' => 'Imran Khan',
            ], [
                'name' => 'Muttahida Qaumi Movement(MQM)',
                'image' => '',
                'leader' => 'Altaf Hussain',
            ], [
                'name' => 'Jamiat Ulema-e-Islam(JUI-F)',
                'image' => '',
                'leader' => 'Faza-Ur-Rehman',
            ], [
                'name' => 'Jamaat-e-Islami(JI)',
                'image' => '',
                'leader' => 'Siraj-ul-Haq',
            ], [
                'name' => 'Awami National Party(ANP)',
                'image' => '',
                'leader' => 'Asfandyar Wali',
            ], [
                'name' => 'Independent(IND)',
                'image' => '',
                'leader' => 'Anonymous',
            ]
        ]);
    }
}
