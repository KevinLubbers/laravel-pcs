<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketTask;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketTask::create([
            'id' => 1,
            'name' => 'After Delivery Issue',
            'specialist_id' => 8,
            'cc_id' => 0,
        ]);
        TicketTask::create([
            'id' => 2,
            'name' => 'Correct / Update PCS Edit',
            'specialist_id' => 0,
            'cc_id' => 0,
        ]);
        TicketTask::create([
            'id' => 3,
            'name' => 'MQII Issue',
            'specialist_id' => 0,
            'cc_id' => 0,
        ]);
        TicketTask::create([
            'id' => 4,
            'name' => 'PC Carbook Quote',
            'specialist_id' => 8,
            'cc_id' => 0,
        ]);
        TicketTask::create([
            'id' => 5,
            'name' => 'Rebates and Incentives',
            'specialist_id' => 7,
            'cc_id' => 1,
        ]);
        TicketTask::create([
            'id' => 6,
            'name' => 'Technical Inquiry',
            'specialist_id' => 0,
            'cc_id' => 0,
        ]);
        TicketTask::create([
            'id' => 7,
            'name' => 'Restrictions / Late Availability',
            'specialist_id' => 0,
            'cc_id' => 0,
        ]);
        TicketTask::create([
            'id' => 8,
            'name' => 'Order Monroney Label (Window Sticker)',
            'specialist_id' => 6,
            'cc_id' => 0,
        ]);
    }
}
