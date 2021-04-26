<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public $statuses = [
        ['name' => 'Draft', 'dossier' => true, 'dist' => true, 'dev' => true],
        ['name' => 'Submitted', 'dossier' => true, 'dist' => true, 'dev' => true],
        ['name' => 'Under processing', 'dossier' => true, 'dist' => true],
        ['name' => 'Rejected', 'dist' => true],
        ['name' => 'Duplicated', 'dist' => true],
        ['name' => 'Processed', 'dist' => true, 'dev' => true],
        ['name' => 'Missing Information', 'dist' => true],
        ['name' => 'Eligible', 'dossier' => true],
        ['name' => 'Ineligible', 'dossier' => true],
        ['name' => 'Reserve list', 'dossier' => true],
        ['name' => 'Selected', 'dossier' => true],
        ['name' => 'Not selected', 'dossier' => true],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $status) {
            Status::create($status);
        }
    }
}
