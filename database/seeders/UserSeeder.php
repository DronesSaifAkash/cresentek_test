<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $batchSize = 10; // Number of records per batch
        $totalRecords = 100000; // Total records to insert

        Log::info('Seeder started');

        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            Log::info('Starting batch ' . (($i / $batchSize) + 1));

            $records = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $recordId = $i + $j + 1;
                $email = 'user' . $recordId . '@example.com'; // Ensure unique email
                $records[] = [
                    'name' => 'User ' . $recordId,
                    'email' => $email,
                    'password' => bcrypt('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            try {
                DB::table('users')->insert($records);
                Log::info("Inserted batch " . (($i / $batchSize) + 1) . " of " . ($totalRecords / $batchSize));
            } catch (\Exception $e) {
                Log::error('Error inserting batch ' . (($i / $batchSize) + 1) . ': ' . $e->getMessage());
            }
        }

        Log::info('Seeder completed');
    }
}
