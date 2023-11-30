<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 20 sample tasks
        for ($i = 1; $i <= 20; $i++) {
            DB::table('tasks')->insert([
                'title' => "Task $i",
                'description' => "Description for Task $i",
                'deadline' => now()->addDays($i),
                'progress' => 'Assigned',
                'is_completed' => 0,
                'created_at' => Carbon::parse('2023-11-30 08:57:20'),
                'updated_at' => Carbon::parse('2023-11-30 08:57:20'),
                'deleted_at' => null,
            ]);
        }
    }
}
