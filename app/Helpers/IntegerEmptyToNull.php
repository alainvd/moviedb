<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

// Integer fields with "" value should be stored as null
trait IntegerEmptyToNull {

    // check all rules and try to transform all matching class properties
    public function integerEmptyToNull_All() {
        foreach ($this->rules() as $field => $rule) {
            // simple var.atr rules
            // like: 'movie.genre_id' => 'required|integer',
            if (count(explode('.', $field)) == 2) {
                list($var, $atr) = explode('.', $field);
                if (isset($this->{$var}->{$atr})) {
                    if ($this->{$var}->{$atr} === '') {
                        if (Str::contains($rule, 'integer')) {
                            $this->{$var}->{$atr} = NULL;
                        }
                    }
                }
            }
        }
    }

    // check and transform a single class property against all rules
    public function integerEmptyToNull_Single($name) {
        // array/asterisk rules
        // like: 'admissionsTables.*.country_id' => 'required|integer',
        if (count(explode('.', $name)) == 3) {
            list($var, $index, $atr) = explode('.', $name);
            foreach ($this->rules() as $field => $rule) {
                if (isset($this->{$var}[$index]->{$atr})) {
                    if ($this->{$var}[$index]->{$atr} == '') {
                        if (Str::contains($rule, 'integer')) {
                            $this->{$var}[$index]->{$atr} = NULL;
                        }
                    }
                }
            }
        }

    }

}