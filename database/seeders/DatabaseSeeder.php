<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@info.com',
            'user_type'=>'admin',
            'password' => '$2y$10$OUePcdEqaI/W88vQE2GYj.DQQTk68DaWNky8ZnX6ArwOPTlVrHTR6', // admin@4427
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('company_subscription_plans')->insert([
            [
                'plan' => 'Basic Plan',
                'charges' => 49.99,
                'purchase_date' => Carbon::now()->subDays(10)->toDateString(),
                'recurring_date' => Carbon::now()->addMonth()->toDateString(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan' => 'Standard Plan',
                'charges' => 99.99,
                'purchase_date' => Carbon::now()->subDays(20)->toDateString(),
                'recurring_date' => Carbon::now()->addMonth()->toDateString(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan' => 'Premium Plan',
                'charges' => 199.99,
                'purchase_date' => Carbon::now()->subDays(30)->toDateString(),
                'recurring_date' => null,
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('jurisdictions')->insert([
            [
                'title' => 'Magistrate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Superior',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Federal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'State',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

      
        DB::table('courts')->insert([
            [
                'nature_of_court_date'=>'option 1',
                'name' => 'Superior',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nature_of_court_date'=>'option 2',
                'name' => 'State',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nature_of_court_date'=>'option 3',
                'name' => 'Probate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

     

    }
}