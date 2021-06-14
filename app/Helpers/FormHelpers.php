<?php

namespace App\Helpers;

use App\Models\Crew;
use App\Models\Title;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormHelpers
{

    // Check if all required fields are filled for each item
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

    // Check if the required crew members are present
    public static function requiredCrew($crews, $genre_id) {
        $requiredTitles = Title::whereIn('code', Crew::requiredMovieCrewTypes($genre_id))->get();
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

    // Check if the required locations are present
    public static function requiredLocations($locations, $genre_id) {
        $requiredLocs = Location::whereIn('type', Location::requiredMovieLocationTypes($genre_id))->get();
        $requiredLocationsMessages = [];
        foreach ($requiredLocs as $loc) {
            if (!array_filter(
                $locations,
                function ($location) use ($loc) {
                    return $loc['type'] == $location['type'];
                }
            ))
            {
                $requiredLocationsMessages[] = 'Required location: ' . Location::LOCATION_TYPES[$loc['type']];
            }
        }
        return $requiredLocationsMessages;
    }

    // Check if producer or co-producers are present
    public static function requiredProducers($producers) {
        $coproducers = 0;
        foreach ($producers as $producer) {
            if ($producer['role'] == 'PRODUCER') {
                return [];
            }
            if ($producer['role'] == 'COPRODUCER') {
                if ($coproducers == 1) return [];
                if ($coproducers == 0) $coproducers++;
            }
        }
        return ['One producer or two co-procuers are required.'];
    }

    // Check if sales agent is present
    public static function requiredSalesAgents($sales_agents) {
        if(!empty($sales_agents))
            return [];
        return ['One sales agent is required.'];
    }

    // Check if financing plan document is present
    public static function validateDocumentsFinancingPlan($documents) {
        foreach ($documents as $document) {
            if ($document['document_type'] == 'FINANCING') return [];
        }
        return ['Film financing plan is required.'];
    }

    public static function validateSalesDistributorTerritories($salesDistributors) {
        // TODO: new implementation
        $territories = [];
        foreach($salesDistributors as $salesDistributor) {
            foreach($salesDistributor['countries'] as $country)
            if (!in_array($country['id'], $territories)) {
                $territories[] = $country['id'];
            }
        }
        if (count($territories) < 3) {
            return ['At least three territories are required.'];
        }
        return [];
    }

    // Will also return all "requiredIf" fields as required
    // But those fields are always hidden in the frontend
    public static function isRequired($rules, $field, $context = null) {
        if (isset($rules[$field])) {
            if (Str::contains($rules[$field], 'required')) {
                // Custom rule for currency field
                if ($field == 'movie.total_budget_currency_rate') {
                    if ($context !== 'EUR') {
                        return true;
                    } else {
                        return false;
                    }
                }
                // Default
                return true;
            }
        }
        return false;
    }
}
