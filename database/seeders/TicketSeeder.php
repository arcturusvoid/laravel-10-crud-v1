<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory()
        ->count(20)
        ->has(Reply::factory()->count(15))
        ->create();
    }
}
