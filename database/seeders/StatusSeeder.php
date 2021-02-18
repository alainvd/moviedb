<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public $statuses = [
        ['name' => 'Draft', 'public' => false],
        ['name' => 'New', 'public' => false],
        ['name' => 'Accepted', 'public' => false],
        ['name' => 'Rejected', 'public' => false],
        ['name' => 'Duplicated', 'public' => false],
        ['name' => 'Distinct', 'public_name' => 'Under processing'],
        ['name' => 'Missing Information'],
        ['name' => 'Validated'],
        ['name' => 'OK', 'public_name' => 'European'],
        ['name' => 'Not OK', 'public_name' => 'Not European'],
        ['name' => 'Qualified AO'],
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
