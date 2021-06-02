<?php

namespace App\Imports;

use App\Models\Call;
use App\Models\Action;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CallsImport implements ToModel, WithHeadingRow
{
    private function formatDate($date, $id)
    {
        try {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
        } catch (\ErrorException $e) {
            echo 'Caught exception in date transformation: ', $e->getMessage(), "\n";
            echo 'Call Ref: ', $id, "\n";
            Log::error("Caught exception in date transformation of Call {$id}: " . $e->getMessage());
            return null;
        }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Get Action
        $action = $this->getAction($row);

        return new Call([
            'name' => $row['call_ref'],
            'action_id' => $action->id,
            'year' => $row['year'],
            'published_at' => $row['call_publication_date'] ? $this->formatDate($row['call_publication_date'], $row['call_ref']) : now(),            
            'deadline1' => $row['deadline_1'] ? $this->formatDate($row['deadline_1']) : null,
            'deadline2' => NULL,
            'status' => $row['status'],

        ]);
        // echo($row['call_ref']."\n");
    }

    private function getAction($row)
    {
        // echo($row['call_ref']."\n");
        return Action::firstWhere("name", "=", $row["action_code"]);
    }
}
