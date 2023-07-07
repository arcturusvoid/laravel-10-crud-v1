<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticket_categories = [
            'General Inquiry',
            'Technical Support',
            'Account/Billing',
            'Feature Request',
            'Feedback',
            'Sales/Marketing',
            'Training/Documentation',
            'Urgent/High Priority',

        ];
        foreach ($ticket_categories as $category) {
            TicketCategory::create([
                'name' => $category,
            ]);
        }
    }
}
