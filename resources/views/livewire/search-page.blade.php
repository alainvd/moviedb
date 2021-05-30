@extends('layouts.public')

@section('content')
<div class="px-4 py-8 mx-auto mb-32 md:px-16 lg:px-32 xl:w-3/4">
    <div class="w-full mb-16">
        <h2 class="text-3xl leading-4 tracking-wide text-gray-500">
            Search results
        </h2>

        <form method="GET" action="{{ route('search') }}" wire:submit.prevent="submit">
            <input type="text"
                class="w-full px-4 py-2 mt-8 border border-indigo-400 rounded-sm"
                placeholder="Film ID, title or director"
                name="q" data-cy="query"
                value="{{ isset($params['q']) ? $params['q'] : '' }}">

            <div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-3">
                <div class="col-span-1">
                    <label class="block leading-8 tracking-wide text-indigo-500 text-md" for="nationality">Media Film Nationality</label>
                    <select class="block w-full px-4 py-2 bg-white border border-indigo-300 rounded-sm" id="nationality"
                        name="nationality">
                        <option value="">All</option>
                        @foreach ($countriesGrouped as $group=>$countries)
                            <optgroup label="---">
                                @foreach ($countries as $country)
                                    <option
                                        :key="$country['code']"
                                        value="{{ $country['code'] }}"
                                        {{ isset($params['nationality']) && $params['nationality'] == $country['code'] ? 'selected' : '' }}>
                                            {{ $country['name'] }}
                                        </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-1">
                    <label class="block leading-8 tracking-wide text-indigo-500 text-md" for="nationality">Year of Copyright</label>
                    <select class="block w-full px-4 py-2 bg-white border border-indigo-300 rounded-sm" id="year"
                        name="year">
                        <option value="">All</option>
                        @foreach ($years as $year)
                            <option :key="$year" value="{{ $year }}" {{ isset($params['year']) && $params['year'] == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-1">
                    <label class="block leading-8 tracking-wide text-indigo-500 text-md" for="nationality">Status</label>
                    <select class="block w-full px-4 py-2 bg-white border border-indigo-300 rounded-sm" id="status"
                        name="status">
                        <option value="">All</option>
                        @foreach ($statuses as $status)
                            <option :key="$status['name']" value="{{ $status['id'] }}" {{ isset($params['status']) && $params['status'] == $status['id'] ? 'selected' : '' }}>{{ $status['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end w-full">
                <x-button.primary type="submit" data-cy="submit">Refine search</x-button.primary>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto search-list" style="min-height: 80px;">
        @if (count($results))
            <x-table-public>
                <x-slot name="head">
                    <x-table-public.heading>Film ID</x-table-public.heading>
                    <x-table-public.heading>Original Title</x-table-public.heading>
                    <x-table-public.heading>Director</x-table-public.heading>
                    <x-table-public.heading>Media Film Nationality</x-table-public.heading>
                    <x-table-public.heading>Media Film Nationality 2014-2020</x-table-public.heading>
                    <x-table-public.heading>Year of Copyright</x-table-public.heading>
                    <x-table-public.heading>Status</x-table-public.heading>
                </x-slot>

                <x-slot name="body">
                    @foreach ($results as $result)
                        @if ($loop->odd)
                            <tr class="bg-white hover:bg-gray-300">
                        @else
                            <tr class="bg-gray-200 hover:bg-gray-300">
                        @endif
                            <x-table-public.cell>
                                {{ $result['id'] }}
                            </x-table-public.cell>
                            <x-table-public.cell>
                                {{ $result['original_title'] }}
                            </x-table-public.cell>
                            <x-table-public.cell>
                                {{ $result['director'] }}
                            </x-table-public.cell>
                            <x-table-public.cell>
                                {{ $result['film_country_of_origin'] }}
                            </x-table-public.cell>
                            <x-table-public.cell>
                                {{ $result['film_country_of_origin_2014_2020'] }}
                            </x-table-public.cell>
                            <x-table-public.cell>
                                {{ $result['year_of_copyright'] }}
                            </x-table-public.cell>
                            <x-table-public.cell>
                                {{ $result['status'] ? $result['status']['name'] : 'Undefined' }}
                            </x-table-public.cell>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table-public>
        @else
            @if ($hasSearch)
                <div class="text-lg leading-8 text-center text-gray-500">
                    Could not find the Movie you are looking for?
                    &nbsp;
                    <a href="{{ route('movie-dist') }}" class="text-indigo-600">
                        Create your Movie Fiche
                    </a>
                </div>
            @endif
        @endif
    </div>

    @if (count($results))
        <div class="my-4">
            {{ $results->links('components.pagination.search-page' ) }}
        </div>
    @endif
</div>

<script>
    const table = document.querySelector('.search-list table');
    if ({{ $results->count() }}) {
        table.scrollIntoView();
    }
</script>
@endsection
