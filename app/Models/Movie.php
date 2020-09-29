<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function getCast(){
        $cast = [];
        if ($this->id == 17271){
            $cast[] = Person::create([
                'role'=>"Actor 1",
                'name'=>"Victor Polster",
                'gender'=>"N/A",
                "nationality1"=>"Belgium",
                "country_of_residence"=>"Belgium"
            ]);

            $cast[] = Person::create([
                'role'=>"Actor 2",
                'name'=>"Arieh Worthalter",
                'gender'=>"N/A",
                "nationality1"=>"Belgium",
                "country_of_residence"=>"Belgium"
            ]);

            $cast[] = Person::create([
                'role'=>"Actor 3",
                'name'=>"Katelijne Damen",
                'gender'=>"N/A",
                "nationality1"=>"Belgium",
                "country_of_residence"=>"Belgium"
            ]);
        }

        if ($this->id == 17916){
            $cast[] = Person::create([
                'role'=>"Actor 1",
                'name'=>"Christos Loulis",
                'gender'=>"Male",
                "nationality1"=>"",
                "country_of_residence"=>"Greece"
            ]);

            $cast[] = Person::create([
                'role'=>"Actor 2",
                'name'=>"Alexandros Bourdoumis ",
                'gender'=>"Male",
                "nationality1"=>"",
                "country_of_residence"=>"Greece"
            ]);

            $cast[] = Person::create([
                'role'=>"Actor 3",
                'name'=>"Ulrich Tukur ",
                'gender'=>"Male",
                "nationality1"=>"",
                "country_of_residence"=>"Germany"
            ]);
        }


        return $cast;

    }
    public function getCrew(){

        $crew = [];
        if ($this->id == 17271){
            $crew[] = Person::create([
                'role'=>"Director",
                'name'=>"Lukas Dhont",
                'gender'=>"",
                "nationality1"=>"Belgian",
                "country_of_residence"=>"Belgium"
            ]);

            $crew[] = Person::create([
                'role'=>"Composer",
                'name'=>"Valentin Hadjadj",
                'gender'=>"",
                "nationality1"=>"French",
                "country_of_residence"=>"France"
            ]);

            $crew[] = Person::create([
                'role'=>"Director of Photography",
                'name'=>"Frank van den Eeden",
                'gender'=>"",
                "nationality1"=>"Dutch",
                "country_of_residence"=>"The Netherlands"
            ]);
        }

        if ($this->id == 17916){
            $crew[] = Person::create([
                'role'=>"Director",
                'name'=>"Costa-Gavras",
                'gender'=>"Male",
                "nationality1"=>"",
                "country_of_residence"=>"France"
            ]);

            $crew[] = Person::create([
                'role'=>"Composer",
                'name'=>"Alexandre Desplat",
                'gender'=>"Male",
                "nationality1"=>"",
                "country_of_residence"=>"France"
            ]);

            $crew[] = Person::create([
                'role'=>"Director of Photography",
                'name'=>"Giorgos Arvanitis",
                'gender'=>"Male",
                "nationality1"=>"",
                "country_of_residence"=>"Greece"
            ]);
        }


        return $crew;
    }


}
