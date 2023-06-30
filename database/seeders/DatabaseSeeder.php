<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\User::factory()->create([
            'role' => 'admin',
            'name' => 'Jeremy Aliparo',
            'email' => 'arcturusvoid09@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'avatar' => 'avatars/t1E6Hd8gFS1tgJc9l9AkNlesXICj93QWjSqVaf9h.jpg',
        ]);
    }
}
