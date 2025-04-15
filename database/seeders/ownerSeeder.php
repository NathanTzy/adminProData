<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ownerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Nat',
            'email' => 'nat@example.com',
            'password' => Hash::make('123'),
            'email_verified_at' => now(),
            'role' => 'owner'
        ]);  


    }
}
