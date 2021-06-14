<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $params = request()->only('q', 'nationality', 'status', 'year', 'page');

        $page = isset($params['page']) ? $params['page'] : 1;
        $hasSearch = false;
        $results = collect([]);

        if (count($params)) {
            $hasSearch = true;
            $results = $this->getQuery($params)->simplePaginate(10)
                ->appends(request()->query());
        }

        return view('livewire.search-page', compact('hasSearch', 'params', 'results'));
    }

    protected function getQuery(array $params)
    {
        $query = Movie::query();

        if (isset($params['q'])) {
            $q = $params['q'];

            if (is_numeric($params['q'])) {
                $query->where('id', $params['q']);
                return $query;
            }

            $query->where(function ($query) use ($q) {
                $q = strip_tags(addslashes($q));
                $query->forDirector($q)
                    ->orWhere(function ($query) use ($q) {
                        $query->where('original_title', 'like', "%{$q}%");
                    });
                });
        }

        if (isset($params['nationality'])) {
            $query->where('film_country_of_origin', $params['nationality']);
        }

        if (isset($params['year'])) {
            $query->where('year_of_copyright', $params['year']);
        }

        if (isset($params['status'])) {
            $query->forStatusId($params['status']);
        }

        return $query;
    }
}
