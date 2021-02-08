<?php

namespace App\Helpers;

use App\Models\Crew;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormHelpers
{

    public static function validateTableEditItems($isEditor, $itemsToValidate, $tableEditClass, $nameCallback) {
        $requiredFieldMessages = [];
        foreach ($itemsToValidate as $itemToValidate) {
            $req = new Request($itemToValidate);
            $class = new $tableEditClass;
            try{
                $req->validate($class->tableEditRules($isEditor));
            }
            catch (ValidationException $e){
                $requiredFieldMessages[] = 'Missing required fields for: ' . $nameCallback($itemToValidate);
            }
        }
        return $requiredFieldMessages;
    }
    
    public static function requiredCrew($crews) {
        $requiredTitles = Title::whereIn('code', Crew::requiredMovieCrew())->get();
        $requiredCrewMessages = [];
        foreach ($requiredTitles as $title) {
            if (!array_filter(
                $crews,
                function ($crew) use ($title) {
                    return $crew['title_id'] == $title->id;
                }
            ))
            {
                $requiredCrewMessages[] = 'Required crew member: ' . $title->name;
            }
        }
        return $requiredCrewMessages;
    }

    public static function validateDocumentsFinancingPlan($documents) {
        // check if financing plan document is present
        foreach ($documents as $document) {
            if ($document['document_type'] == 'FINANCING') return [];
        }
        return ['Film financing plan is required.'];
    }
}