<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Movie;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPage extends Component
{
    use WithPagination;

    public $nationality;
    public $q;
    public $status;
    public $year;

    public $hasSearch = false;

    protected $query;

    protected $queryString = ['q', 'page'];

    // Pagination
    protected $perPage = 10;

    public function mount()
    {
        if ($this->q) {
            $this->hasSearch = true;
        }
    }

    public function updatingYear()
    {
        $this->hasSearch = false;
    }

    public function submit()
    {
        $this->resetPage();
        $this->hasSearch = true;
    }

    public function search()
    {
        $q = $this->q;
        $query = Movie::query();

        if (is_numeric($q)) {
            $query->where('id', $q);
        } else {
            if ($this->nationality) {
                $query->where('film_country_of_origin', $this->nationality);
            }

            if ($this->year) {
                $query->where('year_of_copyright', $this->year);
            }

            if ($this->status) {
                $query->forStatusId($this->status);
            }

            if ($q) {
                $query->where(function ($query) use ($q) {
                    $query->forDirector($q)
                        ->orWhere(function ($query) use ($q) {
                            $query->where('original_title', 'like', "%{$q}%");
                        });
                    });
            }
        }

        $this->query = $query;
    }

    public function render()
    {
        $countriesGrouped = Country::countriesGrouped();
        $years = range(2006, date('Y'));
        $statuses = Status::forFiche()->get();
        $results = collect([]);

        if ($this->hasSearch) {
            $this->search();
            $results = $this->query->with('status')
                ->simplePaginate($this->perPage);
        }

        return view(
            'livewire.search-page',
            compact('countriesGrouped', 'results', 'statuses', 'years')
        )->layout('layouts.public');
    }
}
