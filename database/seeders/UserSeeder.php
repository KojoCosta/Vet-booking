<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 5 admins
        User::factory()
            ->count(5)
            ->state(['role' => 'admin'])
            ->create();

        // 20 owners
        User::factory()
            ->count(20)
            ->state(['role' => 'owner'])
            ->create();

        // 15 veterinarians
        User::factory()
            ->count(15)
            ->state(['role' => 'veterinarian'])
            ->create();
    }
}