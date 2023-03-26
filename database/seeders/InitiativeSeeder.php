<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitiativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Initiative::create([
            'name' => 'مشروع همم ',
            'description' => 'مشروع همم من أهم المشاربع في النظام ',
            'image' =>"kjk",
            'number_volunteer' =>0,
            'id_admin' => 2
            ,'id_project'=>1

         ]);
    }
}
