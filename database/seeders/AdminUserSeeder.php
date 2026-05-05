<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email    = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            $this->command->error('ADMIN_EMAIL and ADMIN_PASSWORD must be set in .env before seeding the admin user.');
            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Admin',
                'email'    => $email,
                'password' => Hash::make($password),
            ]
        );

        $this->command->info("Admin user ready: {$email}");
    }
}
