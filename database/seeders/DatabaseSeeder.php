<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Roles
         */
        DB::table('roles')->insert([
            'role' => 'admin',
        ]);

        DB::table('roles')->insert([
            'role' => 'pimpinan',
        ]);

        DB::table('roles')->insert([
            'role' => 'keuangan',
        ]);

        DB::table('roles')->insert([
            'role' => 'employee',
        ]);

        /**
         * Position
         */
        DB::table('positions')->insert([
            'position' => 'Pimpinan',
        ]);

        DB::table('positions')->insert([
            'position' => 'Keuangan',
        ]);

        DB::table('positions')->insert([
            'position' => 'Karyawan',
        ]);

        /**
         * Salaries
         */
        DB::table('salaries')->insert([
            'position_id' => 1,
        ]);

        DB::table('salaries')->insert([
            'position_id' => 2,
        ]);

        DB::table('salaries')->insert([
            'position_id' => 3,
        ]);

        /**
         * Salary Cuts
         */
        DB::table('salary_cuts')->insert([
            'attendance' => 'Present',
        ]);

        DB::table('salary_cuts')->insert([
            'attendance' => 'Sick',
        ]);

        DB::table('salary_cuts')->insert([
            'attendance' => 'Absent',
        ]);

        /**
         * User Factory
         */
        User::factory(1)->create();

        /**
         * User Data
         */
        DB::table('user_data')->insert([
            'user_id' => 1,
        ]);
    }
}
