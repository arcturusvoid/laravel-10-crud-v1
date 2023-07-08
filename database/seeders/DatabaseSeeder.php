<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'role' => 'admin',
            'name' => 'Jeremy Aliparo',
            'email' => 'arcturusvoid09@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'avatar' => 'avatars/t1E6Hd8gFS1tgJc9l9AkNlesXICj93QWjSqVaf9h.jpg',
        ]);

        $this->call([
            TicketCategorySeeder::class,
            TicketSeeder::class,
        ]);
    }
}
