<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // TODO: Make this as a factory etc.
    public function getCast(){
        $cast = [];
        $cast[] = Person::create([
            'role'=>"Actor 1",
            'first_name'=>"Victor",
            'last_name'=>"Polster",
            'gender'=>"N/A",
            "nationality1"=>"Belgium",
            "country_of_residence"=>"Belgium"
        ]);

        $cast[] = Person::create([
            'role'=>"Actor 2",
            'first_name'=>"Arieh",
            'last_name'=>"Worthalter",
            'gender'=>"N/A",
            "nationality1"=>"Belgium",
            "country_of_residence"=>"Belgium"
        ]);

        $cast[] = Person::create([
            'role'=>"Actor 3",
            'first_name'=>"Katelijne",
            'last_name'=>"Damen",
            'gender'=>"N/A",
            "nationality1"=>"Belgium",
            "country_of_residence"=>"Belgium"
        ]);

        $cast[] = Person::create([
            'role'=>"Actor 4",
            'first_name'=>"Christos",
            'last_name'=>"Loulis",
            'gender'=>"Male",
            "nationality1"=>"",
            "country_of_residence"=>"Greece"
        ]);

        $cast[] = Person::create([
            'role'=>"Actor 5",
            'first_name'=>"Alexandros",
            'last_name'=>"Bourdoumis",
            'gender'=>"Male",
            "nationality1"=>"",
            "country_of_residence"=>"Greece"
        ]);

        $cast[] = Person::create([
            'role'=>"Actor 6",
            'first_name'=>"Ulrich",
            'last_name'=>"Tukur",
            'gender'=>"Male",
            "nationality1"=>"",
            "country_of_residence"=>"Germany"
        ]);

        return $cast;
    }

    public function getCrew(){

        $crew = [];
        $crew[] = Person::create([
            'role'=>"Director",
            'first_name'=>"Lukas",
            'last_name'=>"Dhont",
            'gender'=>"",
            "nationality1"=>"Belgian",
            "country_of_residence"=>"Belgium"
        ]);

        $crew[] = Person::create([
            'role'=>"Composer",
            'first_name'=>"Valentin",
            'last_name'=>"Hadjadj",
            'gender'=>"",
            "nationality1"=>"French",
            "country_of_residence"=>"France"
        ]);

        $crew[] = Person::create([
            'role'=>"Director of Photography",
            'first_name'=>"Frank",
            'last_name'=>"van den Eeden",
            'gender'=>"",
            "nationality1"=>"Dutch",
            "country_of_residence"=>"The Netherlands"
        ]);

        $crew[] = Person::create([
            'role'=>"Director 2",
            'first_name'=>"Costa",
            'last_name'=>"Gavras",
            'gender'=>"Male",
            "nationality1"=>"",
            "country_of_residence"=>"France"
        ]);

        $crew[] = Person::create([
            'role'=>"Composer 2",
            'first_name'=>"Alexandre",
            'last_name'=>"Desplat",
            'gender'=>"Male",
            "nationality1"=>"",
            "country_of_residence"=>"France"
        ]);

        $crew[] = Person::create([
            'role'=>"Director of Photography 2",
            'first_name'=>"Giorgos",
            'last_name'=>"Arvanitis",
            'gender'=>"Male",
            "nationality1"=>"",
            "country_of_residence"=>"Greece"
        ]);

        return $crew;
    }


}
