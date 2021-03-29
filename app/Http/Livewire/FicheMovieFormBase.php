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
use App\Models\SalesDistributor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    public $sales_distributors = [];
    public $documents = [];

    public $crewErrorMessages;
    public $producerErrorMessages;

    public $crumbs = [];

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
                fn ($lang) => ['value' => $lang->id, 'label' => $lang->name]
            ));
            // Load them all even if we don't need them on all forms.
            // If TableEdit classes emits items on mount, listeners on this class
            // are not yet ready to receive them.
            // Therefore init values need to be loaded here.
            $this->crews = Crew::with('person')->where('movie_id',$this->movie->id)->get()->toArray();
            $this->locations = Location::where('movie_id',$this->movie->id)->get()->toArray();
            $this->producers = Producer::where('movie_id', $this->movie->id)->get()->toArray();
            $this->sales_agents = SalesAgent::where('movie_id', $this->movie->id)->get()->toArray();
            $this->sales_distributors = SalesDistributor::with('countries')->where('movie_id', $this->movie->id)->get()->toArray();
            $this->documents = Document::where('movie_id', $this->movie->id)->get()->toArray();
        }
        parent::mount($request);
    }

    public function updated($name, $value)
    {
        if ($name == 'movie.genre_id') {
            // Update the crews livewire component
            $this->emit('movieCrewsAddRequired', $value);
            // Update the locations livewire component
            $this->emit('movieLocationsAddRequired', $value);
        }
    }

    // Save fiche as is (draft), without full validation
    public function saveFiche()
    {
        // Bare bones validation
        $this->validate([
            'movie.original_title' => 'required',
            'fiche.status_id' => 'required',
            'movie.genre_id' => 'required',
        ]);
        unset($this->movie->shooting_language);
        if ($this->movie->country_of_origin_points == '') $this->movie->country_of_origin_points = null;
        if ($this->isNew) {
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            switch ($this->activity->name) {
                case 'description':
                    $type = 'dist';
                    break;
                case 'previous-work':
                    $type = 'dev-prev';
                    break;
                case 'current-work':
                    if ($this->dossier->action->name == 'TV') {
                        $type = 'tv';
                    } else {
                        $type = 'dev-current';
                    }
                    break;
                case 'short-films':
                    $type = 'dev-current';
                    break;
            }
            $this->fiche->fill([
                'movie_id' => $this->movie->id,
                'type' => $type,
                'created_by' => 1,
            ])->save();

            // TODO: code dublication with MovieWizard.php
            $rules = $this->dossier->action->activities->where('id', $this->activity->id)->first()->pivot->rules;
            if ($rules && isset($rules['movie_count']) && $rules['movie_count'] == 1) {
                $this->dossier->fiches()->sync([$this->movie->fiche->id]);
            } else {
                $this->dossier->fiches()->attach(
                    $this->movie->fiche->id,
                    ['activity_id' => $this->activity->id]
                );
            }

            // TODO: this will not show if we redirect away
            $this->notify('Fiche is created');
        } else {
            // When saving existing fiche
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            $this->fiche->fill([
                'updated_by' => 1,
            ])->save();
            $this->notify('Fiche is saved');
        }
        $this->fichePostSave();
    }

    // Fully validate and change status
    function submitFiche()
    {

        $this->movie->shooting_language = $this->shootingLanguages;

        // 1. REGULAR VALIDATION
        try{
            $this->validate();
        }
        catch (ValidationException $e){
            $errors = $e->validator->getMessageBag();
        }

        // 2. SPECIAL VALIDATION
        $specialErrors = $this->specialValidation();
        if (isset($errors)) {
            $errors->merge($specialErrors);
        } else {
            $errors = $specialErrors;
        }

        if($errors) {
            $this->setErrorBag($errors);
            return;
        }

        $this->fiche->status_id = 2;
        $this->saveFiche();
    }

    function specialValidation()
    {
        // perform validation and return message bag
    }

    function fichePostSave()
    {
        // post save operations
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
                } elseif ($saving_class == 'sales_distributor_country') {
                    DB::table('sales_distributor_country')
                        ->where('sales_distributor_id', '=', $existing_item['id'])
                        ->delete();
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
                } elseif ($saving_class == 'sales_distributor_country') {
                    // update salesDistributor with countries
                    $salesDist = SalesDistributor::find($item['id']);
                    $salesDist->update($item);
                    $salesDist->countries()->sync(collect($item['countries'])->pluck('id'));
                } else {
                    $saving_class::find($item['id'])->update($item);
                }
            } else {
                if ($saving_class == 'person_crew') {
                    // TODO: is there an 'create with' thing?
                    $person = Person::create($item['person']);
                    Crew::create($item + ['person_id' => $person->id]);
                } elseif ($saving_class == 'sales_distributor_country') {
                    // create salesDistributor with countries
                    $salesDist = SalesDistributor::create($item);
                    $salesDist->countries()->sync(collect($item['countries'])->pluck('id'));
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

    public function updateMovieSalesDistributors($items)
    {
        $this->sales_distributors = $items;
    }

    public function updateMovieDocuments($items)
    {
        $this->documents = $items;
    }

}
