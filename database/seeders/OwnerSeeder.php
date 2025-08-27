<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Owner;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        User::where('role', 'owner')->each(function (User $user) {
            Owner::factory()
                ->for($user, 'user')
                ->create();
        });
    }
}