<div class="px-4 py-8 md:px-16 lg:px-32 xl:w-3/4 mx-auto mb-32">
    <div class="w-full mb-16">
        <h2 class="text-3xl text-gray-500 tracking-wide leading-4">
            Search {{ count($results) ? "results for {$q}" : "" }}
        </h2>

        <form wire:submit.prevent="submit">
            <input type="text" class="w-full mt-8 border border-indigo-400 px-4 py-2 rounded-sm" placeholder="Film ID, title or director" :key="uuid()" wire:model.defer="q" data-cy="query">

            <div class="my-4 grid gap-4 grid-cols-1 md:grid-cols-3">
                <div class="col-span-1">
                    <label class="block text-md text-indigo-500 tracking-wide leading-8" for="nationality">Media Film Nationality</label>
                    <select class="block w-full bg-white border border-indigo-300 rounded-sm px-4 py-2" id="nationality"
                        wire:model.defer="nationality">
                        <option value="">All</option>
                        @foreach ($countriesGrouped as $group=>$countries)
                            <optgroup label="---">
                                @foreach ($countries as $country)
                                    <option :key="$country['code']" value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-1">
                    <label class="block text-md text-indigo-500 tracking-wide leading-8" for="nationality">Year of Copyright</label>
                    <select class="block w-full bg-white border border-indigo-300 rounded-sm px-4 py-2" id="year"
                        wire:model.defer="year">
                        <option value="">All</option>
                        @foreach ($years as $year)
                            <option :key="$year" value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-1">
                    <label class="block text-md text-indigo-500 tracking-wide leading-8" for="nationality">Status</label>
                    <select class="block w-full bg-white border border-indigo-300 rounded-sm px-4 py-2" id="status"
                        wire:model.defer="status">
                        <option value="">All</option>
                        @foreach ($statuses as $status)
                            <option :key="$status['name']" value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="w-full flex justify-end">
                <x-button.primary type="submit" data-cy="submit">Refine search</x-button.primary>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto search-list">
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
                <div class="text-gray-500 text-lg text-center leading-8">
                    Could not find the Movie you are looking for?
                    &nbsp;
                    <a href="{{ url('/') }}" class="text-indigo-600">
                        Create your Movie Fiche
                    </a>
                </div>
            @endif
        @endif
    </div>

    @if (count($results))
        <div class="my-4">
            {{ $results->links('components.pagination.search-page' )}}
        </div>
    @endif
</div>
