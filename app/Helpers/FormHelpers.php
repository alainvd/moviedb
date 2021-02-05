<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormHelpers
{

    public static function validateTableEditItems($isEditor, $itemsToValidate, $tableEditClass, $nameCallback) {
        $requiredFieldMessages = [];
        // dd($itemsToValidate);
        foreach ($itemsToValidate as $itemToValidate) {
            $req = new Request($itemToValidate);
            $class = new $tableEditClass;
            try{
                // dd($class->tableEditRules($isEditor));
                $req->validate($class->tableEditRules($isEditor));
            }
            catch (ValidationException $e){
                $requiredFieldMessages[] = 'Missing required fields for: ' . $nameCallback($itemToValidate);
            }
        }
        // dd($requiredFieldMessages);
        return $requiredFieldMessages;
    }
    
}