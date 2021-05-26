<?php

namespace App\Imports;

use App\Models\Dossier;
use App\Models\Call;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DossiersImportDevSlate implements ToCollection, WithHeadingRow, WithChunkReading
{

    public function chunkSize(): int
	{
		return 500;
	}

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            //Get Call
            $call = $this->getCall($row);

            //Create the Dossier
            $dossier = new Dossier([
                'call_id' =>$call->id,
                'action_id' => 1,
                'status_id' => 11,
                'year' => $row["application_year"],
                'project_ref_id' => $row["project_reference_number"],
                'company' => $row["participant_organisation_name"],
                'contact_person' => 'n/a',
                'created_by' => 1,
            ]);
            $dossier->save();
           
        }
    }
  
    private function getCall($row)
    {
        $callName = $row["call_ref"];
        $call = Call::where("name", "=", $callName)->first();
        return $call;
    }

}
