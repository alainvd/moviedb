<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\User;
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
use App\Models\Admission;
use App\Models\SalesAgent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SalesDistributor;
use Illuminate\Support\Facades\DB;
use App\Helpers\IntegerEmptyToNull;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class FicheMovieFormBase extends FicheFormBase
{

    use IntegerEmptyToNull;

    // Movie data for Livewire
    public Dossier $dossier;
    public Activity $activity;
    public ?Fiche $fiche = null;
    public ?Movie $movie = null;

    public $standAloneFiche = false;

    public $shootingLanguages;
    public $gameGenres;
    public $gameOptions;
    public $gameModes;
    public $gamePlatforms;

    public $crews = [];
    public $locations = [];
    public $producers = [];
    public $sales_agents = [];
    public $sales_distributors = [];
    public $documents = [];

    public $crewErrorMessages;
    public $producerErrorMessages;

    public $crumbs = [];

    public $admissionsTable = null;
    public $admission = null;
    
    public $hasHistory = false;

    public $routeDetails;
    public $routeDossiers;

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

    protected function refererStandAloneFiche() {
        $referer = request()->headers->get('referer');
        if (Str::contains($referer, '/movie-dist')
        || Str::contains($referer, '/movie-dev-current')
        || Str::contains($referer, '/movie-dev-prev')
        || Str::contains($referer, '/movie-tv')
        || Str::contains($referer, '/vg-prev')) {
            return true;
        }
        return false;
    }

    public function mount(Request $request)
    {
        if ($this->fiche && request()->user()->cannot('update', $this->fiche)) {
            abort(404);
        }

        if (in_array($request->segment(1),['movie-dist', 'movie-dev-current', 'movie-dev-prev', 'movie-tv', 'vg-current', 'vg-prev'])) {
            $this->standAloneFiche = true;
        }

        $this->shootingLanguages = collect([]);
        $this->gameGenres = collect([]);
        $this->gameOptions = collect([]);
        $this->gameModes = collect([]);
        $this->gamePlatforms = collect([]);

        if (!$this->fiche) {
            // Applicant can only submit dist stand alone fiche
            if (Auth::user()->hasRole('applicant') && $this->standAloneFiche && (get_class($this) !== 'App\Http\Livewire\MovieDistForm')) {
                abort(404);
            }
            $this->isNew = true;
            $this->fiche = new Fiche(Fiche::defaultsFiche());
            $this->movie = new Movie(Movie::defaultsMovie());
        } else {
            $this->hasHistory = ActivityLog::forSubject($this->fiche)->count() > 0;
            $this->movie = $this->fiche->movie;
            $this->shootingLanguages = collect($this->movie->languages->map(
                fn ($lang) => ['value' => $lang->id, 'label' => $lang->name]
            ));
            $this->gameGenres = collect($this->movie->gameGenres->map(
                fn ($gameGenre) => ['value' => $gameGenre->id, 'label' => $gameGenre->name]
            ));
            $this->gameOptions = collect($this->movie->gameOptions->map(
                fn ($gameOpt) => ['value' => $gameOpt->id, 'label' => $gameOpt->name]
            ));
            $this->gameModes = collect($this->movie->gameModes->map(
                fn ($gameMode) => ['value' => $gameMode->id, 'label' => $gameMode->name]
            ));
            $this->gamePlatforms = collect($this->movie->gamePlatforms->map(
                fn ($gamePlatform) => ['value' => $gamePlatform->id, 'label' => $gamePlatform->name]
            ));
            // Load them all even if we don't need them on all forms.
            // If TableEdit classes emits items on mount, listeners on this class
            // are not yet ready to receive them.
            // Therefore init values need to be loaded here.
            $this->crews = Crew::with('person')->where('movie_id',$this->movie->id)->get()->toArray();
            array_multisort(array_column($this->crews, 'title_id'), SORT_ASC, $this->crews);
            $this->locations = Location::where('movie_id',$this->movie->id)->get()->toArray();
            $this->producers = Producer::where('movie_id', $this->movie->id)->get()->toArray();
            $this->sales_agents = SalesAgent::where('movie_id', $this->movie->id)->get()->toArray();
            $this->sales_distributors = SalesDistributor::with('countries')->where('movie_id', $this->movie->id)->get()->toArray();
            $this->documents = Document::where('movie_id', $this->movie->id)->get()->toArray();
        }
        if (request()->input('admissionsTable')) $this->admissionsTable = request()->input('admissionsTable');
        if (request()->input('admission')) $this->admission = request()->input('admission');
        parent::mount($request);
    }

    public function updated($name, $value)
    {

        if ($name == 'movie.genre_id') {
            // Update the crews livewire component
            $this->emit('movieCrewsAddDefault', $value);
            // Update the locations livewire component
            $this->emit('movieLocationsAddDefault', $value);
        }
        // clear dependent fields
        if ($name == 'movie.link_applicant_work') {
            if ($value !== 'WRKPERS') {
                $this->movie->link_applicant_work_person_name = NULL;
                $this->movie->link_applicant_work_person_position = NULL;
            }
            if ($value !== 'WRKPERS' && $value !== 'WRKCOPROD') {
                $this->movie->link_applicant_work_person_credit = NULL;
            }
        }
        if ($name == 'movie.rights_origin_of_work') {
            if ($value !== 'ADAPTATION') {
                $this->movie->rights_adapt_author_name = NULL;
                $this->movie->rights_adapt_original_title = NULL;
                $this->movie->rights_adapt_contract_type = NULL;
                $this->movie->rights_adapt_contract_start_date = NULL;
                $this->movie->rights_adapt_contract_end_date = NULL;
                $this->movie->rights_adapt_contract_signature_date = NULL;
            }
        }
        if ($name == 'movie.film_type') {
            if ($value !== 'SERIES') {
                $this->movie->number_of_episodes = NULL;
                $this->movie->length_of_episodes = NULL;
            }
        }
        if ($name == 'movie.dev_support_flag') {
            if ($value !== 1) {
                $this->movie->dev_support_reference = NULL;
            }
        }

    }

    // Save fiche as is (draft), without full validation
    public function saveFiche()
    {

        // if integer field set to empty, make sure it's saved as null
        $this->integerEmptyToNull_All();

        // Bare bones validation
        // Check formatting, but no field is required (except title)
        $this->validate($this->rulesDraft);

        unset($this->movie->shooting_language);
        unset($this->movie->gameOptions);

        if ($this->movie->country_of_origin_points == '') $this->movie->country_of_origin_points = null;
        if ($this->isNew) {
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            $this->movie->gameGenres()->sync(
                $this->gameGenres->map(
                    fn ($gameGenre) => $gameGenre['value']
                )
            );
            $this->movie->gameOptions()->sync(
                $this->gameOptions->map(
                    fn ($gameOpt) => $gameOpt['value']
                )
            );
            $this->movie->gameModes()->sync(
                $this->gameModes->map(
                    fn ($gameMode) => $gameMode['value']
                )
            );
            $this->movie->gamePlatforms()->sync(
                $this->gamePlatforms->map(
                    fn ($gamePlatform) => $gamePlatform['value']
                )
            );

            if (isset($this->activity)) {
                switch ($this->activity->name) {
                    case 'description':
                        $type = 'dist';
                        break;
                    case 'previous-work':
                        if ($this->dossier->action->name == 'DEVVG') {
                            $type = 'vg-prev';
                        } else {
                        $type = 'dev-prev';
                        }
                        break;
                    case 'current-work':
                        if ($this->dossier->action->name == 'TVONLINE') {
                            $type = 'tv';
                        } 
                        else if ($this->dossier->action->name == 'DEVVG') {
                            $type = 'vg-current';
                        } else {
                            $type = 'dev-current';
                        }
                        break;
                    case 'short-films':
                        $type = 'dev-current';
                        break;
                    case 'admissions-tables':
                        $type = 'dist';
                        break;
                }
            }
            $this->fiche->fill([
                'movie_id' => $this->movie->id,
                'type' => $type,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ])->save();

            // Note: this serves:
            // - when the wizard moves to creating a new fiche
            // - when creating new fiche from dossier
            // - when wizard creates new fiche in admission (admissions tables)

            if ($this->activity->name == 'admissions-tables') {
                if ($this->admissionsTable && $this->admission) {
                    $admission = Admission::find($this->admission);
                    if (Auth::user()->can('view', $admission->admissionsTable->dossier)) {
                        $admission->fiche_id = $this->movie->fiche->id;
                        $admission->save();
                    } else {
                        abort(404);
                    }
                }
            } else {
                $rules = $this->dossier->action->activities->where('id', $this->activity->id)->first()->pivot->rules;
                if ($rules && isset($rules['movie_count']) && $rules['movie_count'] == 1) {
                    $this->dossier->fiches()->sync([$this->movie->fiche->id]);
                } else {
                    $this->dossier->fiches()->attach(
                        $this->movie->fiche->id,
                        ['activity_id' => $this->activity->id]
                    );
                }
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
            $this->movie->gameGenres()->sync(
                $this->gameGenres->map(
                    fn ($gameGenre) => $gameGenre['value']
                )
            );
            $this->movie->gameOptions()->sync(
                $this->gameOptions->map(
                    fn ($gameOpt) => $gameOpt['value']
                )
            );
            $this->movie->gameModes()->sync(
                $this->gameModes->map(
                    fn ($gameMode) => $gameMode['value']
                )
            );
            $this->movie->gamePlatforms()->sync(
                $this->gamePlatforms->map(
                    fn ($gamePlatform) => $gamePlatform['value']
                )
            );
            // TODO: this it wrong, right? Update with current user...
            $this->fiche->fill([
                'updated_by' => Auth::user()->id,
            ])->save();
            $this->fiche->touch();
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

        if($errors->count()) {
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

    function fichePostSaveRedirect()
    {
        // admission
        if ($this->admissionsTable && $this->admission) {
            return redirect()->route('admission', [$this->dossier, $this->admissionsTable, $this->admission]);
        }

        // in dossier context, go back to dossier
        // will also work when coming from wizard
        if (isset($this->dossier) && isset($this->activity) && isset($this->fiche)) {
            return redirect()->route('dossiers.show', ['dossier' => $this->dossier]);
        }

        // if editor is viewing stand-alone fiche, go back to movie listing
        if ($this->isEditor && $this->refererStandAloneFiche()) {
            return redirect()->to(route('datatables-movies'));
        }
        // if applicant is viewing stand-alone fiche, go back to homepage
        if ($this->isApplicant && $this->refererStandAloneFiche()) {
            return redirect()->to(route('root'));
        }
        // fallback: redirect to stored previous page
        return redirect()->to($this->previous);
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
