<?php

namespace Database\Seeders;

use App\Step;
use App\StepDefinition;
use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data =
            [
                ["Admissibility requirements", "Accompanied by a balanced budget and all other documents referred to in application form", "101"],
                ["Admissibility requirements", "Drafted in one of the EU official languages", "102"],
                ["Admissibility requirements", "Received no later than the deadline", "103"],
                ["Admissibility requirements", "Submitted using the online application form", "104"],
                ["Double Funding", "No grant awarded under the sales agent scheme for the promotion of this film", "201"],
                ["Double Funding", "Only one grant received from the EU budget for the action", "202"],
                ["Double Funding", "Subsidised action may not benefit from Eurimages funding for the same activity.", "203"],
                ["Eligible Activities", "A broadcaster cannot be the majority co-producer of the work in term of rights and its contribution cannot exceed 70% of the total financing of the production", "301"],
                ["Eligible Activities", "A minimum of 7 different distributors must be attached to the project", "302"],
                ["Eligible Activities", "Applicant is not in any of the exclusion  situation established in section 7.1 of the guidelines", "303"],
                ["Eligible Activities", "Application submitted at the latest on first day of principal photography", "304"],
                ["Eligible Activities", "At least 3 distributors of the grouping come from  a high/medium capacity country and at least 2 from small/very small capacity country", "305"],
                ["Eligible Activities", "Eligible category and length of projects", "306"],
                ["Eligible Activities", "EU grant requested not less than 10.000 EUR", "307"],
                ["Eligible Activities", "EU grant requested not less than 70.000 EUR", "308"],
                ["Eligible Activities", "Exploitation rights licenced to the broadcasting companies have to revert to the producer after max 7 years/10 years", "309"],
                ["Eligible Activities", "In case of request of extension to the period of release the maximum  period for request is respected.", "310"],
                ["Eligible Activities", "Maximum duration of projects is 24 months (or 36 months for series of more than 2 episodes)", "311"],
                ["Eligible Activities", "Minimum 50% of the financing of the total estimated production budget must be guaranteed from third party sources", "312"],
                ["Eligible Activities", "Minimum 50% of the total estimated production budget must come from countries participating in the MEDIA sub-programme", "313"],
                ["Eligible Activities", "No on-going Slate Funding grant", "314"],
                ["Eligible Activities", "No Slate Funding Grant signed during year of publication of the call", "315"],
                ["Eligible Activities", "Not an ineligible activity and/or type of project", "316"],
                ["Eligible Activities", "Not an ineligible type of project", "317"],
                ["Eligible Activities", "Not an ineligible type of project or short", "318"],
                ["Eligible Activities", "Only one application per year for Single or Slate calls", "319"],
                ["Eligible Activities", "Potential fund is to be reinvested in eligible costs", "320"],
                ["Eligible Activities", "Principal photography of project not scheduled within 8 months from submission", "321"],
                ["Eligible Activities", "Principal photography of projects not scheduled within 8 months from submission", "322"],
                ["Eligible Activities", "Principal photography of short not before submission", "323"],
                ["Eligible Activities", "Production phase of project not scheduled within 8 months from submission", "324"],
                ["Eligible Activities", "Short by emerging talent and of eligible length", "325"],
                ["Eligible Activities", "The activities to be funded are campaigns for the pan-European distribution of eligible European films, outside their country of origin", "326"],
                ["Eligible Activities", "The admissions are achieved during the reference year as defined in the guidelines", "327"],
                ["Eligible Activities", "The admissions are certified by the Responsible National Authority", "328"],
                ["Eligible Activities", "The admissions are eligible", "329"],
                ["Eligible Activities", "The film does not consist of alternative content (operas, concerts, performances, etc.), advertising, pornographic or racist material or advocate violence", "330"],
                ["Eligible Activities", "The film is a work of fiction (including animated films) or documentary, with a minimum duration of 60 minutes", "331"],
                ["Eligible Activities", "The film is non-national ", "332"],
                ["Eligible Activities", "The film is non-national in the territory applied for", "333"],
                ["Eligible Activities", "The film is produced in majority by producer or producers established in the countries participating in the MEDIA Sub-programme", "334"],
                ["Eligible Activities", "The film is produced in majority by producer or producers established in the countries participating in the MEDIA Sub-programme", "335"],
                ["Eligible Activities", "The film is qualified as European (as defined in the guidelines)", "336"],
                ["Eligible Activities", "The film is released within the period defined in the guidelines ", "337"],
                ["Eligible Activities", "The film's first copyright is established at the earliest in the year defined in the guidelines", "338"],
                ["Eligible Activities", "Work must involve the participation of at least 3 broadcasters from 3 countries participating in MEDIA Sub-programme", "339"],
                ["Eligible Activities", "Work produced with significant participation of professionals nationals/ residents of countries participating in MEDIA Sub-programme", "340"],
                ["Eligible Applicant", "Applicant has been appointed as the sales agent for the film on at least 15 countries participating in the MEDIA Sub-programme. ", "401"],
                ["Eligible Applicant", "Applicant has carried out the theatrical distribution of the film in the country", "402"],
                ["Eligible Applicant", "Applicant is an European sales agent as defined in the guidelines", "403"],
                ["Eligible Applicant", "Applicant is the holder of the theatrical distribution rights for the film in the country concerned", "404"],
                ["Eligible Applicant", "Applicant pays the associated distribution costs", "405"],
                ["Eligible Applicant", "Applicant registered and has theatrical distribution operations in the cournty for which the grant is requested", "406"],
                ["Eligible Applicant", "Audiovisual production company", "407"],
                ["Eligible Applicant", "Company owned in majority by nationals of the countries participating in the MEDIA sub-programme", "408"],
                ["Eligible Applicant", "Company with a recent success", "409"],
                ["Eligible Applicant", "European company", "410"],
                ["Eligible Applicant", "In case of co-distribution, conditions are met", "411"],
                ["Eligible Applicant", "In case of sub-contracting, conditions are met", "412"],
                ["Eligible Applicant", "Independent company", "413"],
                ["Eligible Applicant", "International sales contract provides the right to sell the film in at least 10 countries participating in the MEDIA sub-programme", "414"],
                ["Eligible Applicant", "Legal entity registered in one of the countries participating in the MEDIA sub-programme ", "415"],
                ["Eligible Applicant", "Legally constituted for at least 12 months prior to submission date", "416"],
                ["Eligible Applicant", "Legally constituted for at least 36 months prior to submission date", "417"],
                ["Eligible Applicant", "Majority producer in terms of rights", "418"],
                ["Eligible Applicant", "Owns the majority of rights related to the project", "419"],
                ["Eligible Applicant", "Owns the majority of rights related to the projects", "420"],
                ["Eligible Applicant", "Sales agent is the main activity of the company", "421"],
                ["Eligible Applicant", "The applicant is not a physical distributor", "422"],
                ["Eligible Applicant", "Theatrical distribution is the main activity of the company", "423"],
                ["Eligible Applicant", "The sales agent must have been over the last three years the appointed sales agent of at least 3 films that have been theatrically released in at least five countries", "424"],
                ["Eligible Applicant", "Video game production company", "425"],
                ["Exclusion Criteria", "Declaration on honour signed and dated", "501"],
                ["Exclusion Criteria", "Signed declaration on honour", "502"],
                ["Selection Criteria", "Annual accounts of the last  financial year for which the accounts were closed", "503"],
                ["Selection Criteria", "Financial capacity", "504"],
                ["Selection Criteria", "Financial Capacity", "505"],
                ["Selection Criteria", "Financial Capacity form signed and dated", "506"],
                ["Selection Criteria", "Operational Capacity", "507"]
            ];

        foreach ($data as $line){
            Step::create([
                'category' => $line[0],
                'description' => $line[1],
                'id' => (int)$line[2]
            ]);
        }






    }
}
