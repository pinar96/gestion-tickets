<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Abierto', 'En Progreso', 'Cerrado'];

        foreach ($statuses as $status) {
            TicketStatus::firstOrCreate(['name' => $status]);
        }
    }
}
