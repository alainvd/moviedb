<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\Fiche;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Title;
use App\Models\Person;
use App\Models\Country;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Audience;
use App\Models\Document;
use App\Models\Language;
use App\Models\Location;
use App\Models\Producer;
use App\Models\SalesAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FicheMovieFormBase extends FicheFormBase
{

    // Movie data for Livewire
    public Dossier $dossier;
    public Activity $activity;
    public ?Fiche $fiche = null;
    public ?Movie $movie = null;

    public $shootingLanguages;

    public $crews = [];
    public $locations = [];
    public $producers = [];
    public $sales_agents = [];
    public $documents = [];

    public function validationAttributes()
    {
        // todo: finish for all fields
        return [
            'movie.rights_adapt_author_name' => 'Name of Author',
            'movie.rights_adapt_original_title' => 'Start Date of the Ownership',
            'movie.rights_adapt_contract_type' => 'Original Title',
            'movie.rights_adapt_contract_start_date' => 'End Date of the Ownership',
            'movie.rights_adapt_contract_end_date' => 'Type of contract with original Author',
            'movie.rights_adapt_contract_signature_date' => 'Date of signature of the agreement',
        ];
    }

    public function mount(Request $request)
    {
        $this->shootingLanguages = collect([]);
        if (!$this->fiche) {
            $this->isNew = true;
            $this->fiche = new Fiche;
            $this->movie = new Movie(Movie::defaultsMovie());
        } else {
            $this->movie = $this->fiche->movie;
            $this->shootingLanguages = collect($this->movie->languages->map(
                fn ($lang) => ['value' => $lang->id, 'label' => $lang->name],
            ));
            // Load them all even if we don't need them on all forms.
            // If TableEdit classes emits items on mount, listeners on this class 
            // are not yet ready to receive them.
            // Therefore init values need to be loaded here.
            $this->crews = Crew::with('person')->where('movie_id',$this->movie->id)->get()->toArray();
            $this->locations = Location::where('movie_id',$this->movie->id)->get()->toArray();
            $this->producers = Producer::where('movie_id', $this->movie->id)->get()->toArray();
            $this->sales_agents = SalesAgent::where('movie_id', $this->movie->id)->get()->toArray();
            $this->documents = Document::where('movie_id', $this->movie->id)->get()->toArray();
        }
        parent::mount($request);
    }

    public function updated($name, $value)
    {
        if ($name == 'movie.genre_id') {
            // Update the crews livewire component
            $this->emit('movieCrewsAddRequired', $value);
        }
    }

    public function submit()
    {
        $this->movie->shooting_language = $this->shootingLanguages;
        $this->validate();
        unset($this->movie->shooting_language);

        if ($this->movie->country_of_origin_points == '') $this->movie->country_of_origin_points = null;
        if ($this->isNew) {
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            $this->fiche->fill([
                'movie_id' => $this->movie->id,
                'created_by' => 1,
            ])->save();
            $this->dossier->fiches()->attach(
                $this->fiche->id,
                ['activity_id' => $this->activity->id]
            );
            $this->notify('Fiche is created');
        } else {
            // When saving existing fiche
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            $this->fiche->save();
            $this->notify('Fiche is saved');
        }
    }

    public function saveItems($existing_items, $saving_items, $saving_class)
    {
        // delete first
        foreach($existing_items as $existing_item) {
            $missing = true;
            foreach($saving_items as $item) {
                if (isset($item['id'])) {
                    if ($existing_item->id == $item['id']) {
                        $missing = false;
                    }
                }
            }
            if ($missing) {
                if ($saving_class=='person_crew') {
                    Person::find($existing_item->person_id)->delete();
                    $existing_item->delete();
                } else {
                    $existing_item->delete();
                }
            }
        }
        // create/update
        foreach ($saving_items as $item) {
            unset($item['key']);
            unset($item['created_at']);
            unset($item['updated_at']);
            $item['movie_id'] = $this->movie->id;
            if (isset($item['id'])) {
                if ($saving_class == 'person_crew') {
                    // TODO: is there an 'update with' thing?
                    Crew::find($item['id'])->update($item);
                    Person::find($item['person_id'])->update($item['person']);
                } else {
                    $saving_class::find($item['id'])->update($item);
                }
            } else {
                if ($saving_class == 'person_crew') {
                    // TODO: is there an 'create with' thing?
                    $person = Person::create($item['person']);
                    Crew::create($item + ['person_id' => $person->id]);
                } else {
                    $saving_class::create($item);
                }
            }
        }
    }

    public function updateMovieCrews($items)
    {
        $this->crews = $items;
    }

    public function updateMovieLocations($items)
    {
        $this->locations = $items;
    }

    public function updateMovieProducers($items)
    {
        $this->producers = $items;
    }

    public function updateMovieSalesAgents($items)
    {
        $this->sales_agents = $items;
    }

    public function updateMovieDocuments($items)
    {
        $this->documents = $items;
    }

}