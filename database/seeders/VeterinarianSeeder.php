<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Veterinarian;

class VeterinarianSeeder extends Seeder
{
    public function run(): void
    {
        User::where('role', 'veterinarian')->each(function (User $user) {
            Veterinarian::factory()
                ->for($user, 'user')   // sets user_id only
                ->create();
        });
    }
}