<?php


namespace App\Helpers;


class MoviesHelpers
{
    public static function addCrewMember($person, $points, $title_id, $movie_id)
    {
        $person = \App\Person::create($person);

        $crew = Crew::create([
            'points' => $points,
            'person_id' => $person->id,
            'title_id' => $title_id,
            'movie_id' => $movie_id
        ]);
        return $person;
    }
}
