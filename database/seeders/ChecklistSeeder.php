<?php

namespace Database\Seeders;

use App\Checklist;
use App\StepDefinition;
use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devslate = StepDefinition::where("action","=","DEVSLATE")->get();

        foreach ($devslate as $step_definition){
            Checklist::create([
                'position'=>$step_definition->position,
                'dossier_id'=>1,
                'media_id'=>2,
                'step_id'=>$step_definition->step_id,
                'status'=>'PENDING'
            ]);

            Checklist::create([
                'position'=>$step_definition->position,
                'dossier_id'=>1,
                'media_id'=>4,
                'step_id'=>$step_definition->step_id,
                'status'=>'PENDING'
            ]);


            Checklist::create([
                'position'=>$step_definition->position,
                'dossier_id'=>3,
                'media_id'=>4,
                'step_id'=>$step_definition->step_id,
                'status'=>'PENDING'
            ]);
        }
    }
}
