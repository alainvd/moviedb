<?php

namespace App\Http\Livewire;

class TableEditMovieSalesAgentsDevPrevious extends TableEditMovieSalesAgents
{

    static function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.country_id' => 'required',
            'editing.contact_person' => '',
            'editing.email' => '',
            'editing.distribution_date' => 'required|date:d.m.Y',
        ] + TableEditBase::rules();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-sales-agents', ['fiche' => 'devPrev']);
    }

    // public function mount($movie_id = null)
    // {
    //     parent::mount();
    //     if ($movie_id) {
    //         $this->movie_id = $movie_id;
    //         $this->peopleOnForm = Movie::find($this->movie_id)->media->people->toArray();
    //         // Add title value, add points, count total points
    //         $this->peopleOnForm = array_map(
    //             function ($a) {
    //                 $a['title_id'] = Person::find($a['id'])->crew->title->id;
    //                 $a['points'] = Person::find($a['id'])->crew->points;
    //                 $this->points_total += Person::find($a['id'])->crew->points;
    //                 return $a;
    //             },
    //             $this->peopleOnForm
    //         );
    // }
    
}
