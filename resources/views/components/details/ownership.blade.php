<div class="grid grid-cols-2 gap-4 fiche-details-component md:grid-cols-3" id="fdc-ownership">

    <div class="col-span-2 mb-4 text-lg">
        Ownership of Rights
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.select
            :print="$print"
            :id="'rights_origin_of_work'"
            :label="'Origin of Work'"
            :hasError="$errors->has('movie.rights_origin_of_work')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_origin_of_work')"
            wire:model="movie.rights_origin_of_work"
            value="{{ isset($movie->rights_origin_of_work) ? $workOrigins[$movie->rights_origin_of_work] : '' }}"
        >

            @foreach ($workOrigins as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.rights_origin_of_work')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-2">
        <x-form.select
            :print="$print"
            :id="'rights_contract_type'"
            :label="'Type of contract with Author'"
            :hasError="$errors->has('movie.rights_contract_type')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_contract_type')"
            wire:model="movie.rights_contract_type"
            value="{{ $movie->rights_contract_type ? $workContractTypes[$movie->rights_contract_type] : '' }}"
        >

            @foreach ($workContractTypes as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.rights_contract_type')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-1">
        <x-form.datepicker
            :print="$print"
            :id="'rights_contract_start_date'"
            :label="'Start Date of the Ownership'"
            :hasError="$errors->has('movie.rights_contract_start_date')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_contract_start_date')"
            wire:model.lazy="movie.rights_contract_start_date"
            value="{{ $movie->rights_contract_start_date }}"
        ></x-form.datepicker>

        @error('movie.rights_contract_start_date')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-2">
        <x-form.datepicker
            :print="$print"
            :id="'rights_contract_end_date'"
            :label="'End Date of the Ownership'"
            :hasError="$errors->has('movie.rights_contract_end_date')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_contract_end_date')"
            wire:model.lazy="movie.rights_contract_end_date"
            value="{{ $movie->rights_contract_end_date }}"
        ></x-form.datepicker>

        @error('movie.rights_contract_end_date')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-3">
        <x-form.datepicker
            :print="$print"
            :id="'rights_contract_signature_date'"
            :label="'Date of signature of the agreement'"
            :hasError="$errors->has('movie.rights_contract_signature_date')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_contract_signature_date')"
            wire:model.lazy="movie.rights_contract_signature_date"
            value="{{ $movie->rights_contract_signature_date }}"
        ></x-form.datepicker>

        @error('movie.rights_contract_signature_date')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- dependant fields -->
    <div class="col-span-1 col-start-1" x-data="{ show: false }" x-show="$wire.movie.rights_origin_of_work == 'ADAPTATION'">
        <x-form.input
            :print="$print"
            :id="'rights_adapt_author_name'"
            :label="'Name of Author'"
            :hasError="$errors->has('movie.rights_adapt_author_name')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_adapt_author_name')"
            wire:model="movie.rights_adapt_author_name"
            value="{{ $movie->rights_adapt_author_name }}"
        ></x-form.input>

        @error('movie.rights_adapt_author_name')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-2" x-data="{ show: false }" x-show="$wire.movie.rights_origin_of_work == 'ADAPTATION'">
        <x-form.input
            :print="$print"        
            :id="'rights_adapt_original_title'"
            :label="'Original Title'"
            :hasError="$errors->has('movie.rights_adapt_original_title')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_adapt_original_title')"
            wire:model="movie.rights_adapt_original_title"
            value="{{ $movie->rights_adapt_original_title }}"
        ></x-form.input>

        @error('movie.rights_adapt_original_title')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-3" x-data="{ show: false }" x-show="$wire.movie.rights_origin_of_work == 'ADAPTATION'">
        <x-form.select
            :print="$print"        
            :id="'rights_adapt_contract_type'"
            :label="'Type of contract with original Author'"
            :hasError="$errors->has('movie.rights_adapt_contract_type')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_adapt_contract_type')"
            wire:model="movie.rights_adapt_contract_type"
            value="{{ isset($movie->rights_adapt_contract_type) ? $workContractTypes[$movie->rights_adapt_contract_type] : '' }}"
        >

            @foreach ($workContractTypes as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach

        </x-form.select>

        @error('movie.rights_adapt_contract_type')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-1" x-data="{ show: false }" x-show="$wire.movie.rights_origin_of_work == 'ADAPTATION'">
        <x-form.datepicker
            :print="$print"
            :id="'rights_adapt_contract_start_date'"
            :label="'Start Date of the Ownership'"
            :hasError="$errors->has('movie.rights_adapt_contract_start_date')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_adapt_contract_start_date')"
            wire:model.lazy="movie.rights_adapt_contract_start_date"
            value="{{ $movie->rights_adapt_contract_start_date }}"
        ></x-form.datepicker>

        @error('movie.rights_adapt_contract_start_date')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-2" x-data="{ show: false }" x-show="$wire.movie.rights_origin_of_work == 'ADAPTATION'">
        <x-form.datepicker
            :print="$print"
            :id="'rights_adapt_contract_end_date'"
            :label="'End Date of the Ownership'"
            :hasError="$errors->has('movie.rights_adapt_contract_end_date')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_adapt_contract_end_date')"
            wire:model.lazy="movie.rights_adapt_contract_end_date"
            value="{{ $movie->rights_adapt_contract_end_date }}"
        ></x-form.datepicker>

        @error('movie.rights_adapt_contract_end_date')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-span-1 col-start-3" x-data="{ show: false }" x-show="$wire.movie.rights_origin_of_work == 'ADAPTATION'">
        <x-form.datepicker
            :print="$print"
            :id="'rights_adapt_contract_signature_date'"
            :label="'Date of signature of the agreement'"
            :hasError="$errors->has('movie.rights_adapt_contract_signature_date')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.rights_adapt_contract_signature_date')"
            wire:model.lazy="movie.rights_adapt_contract_signature_date"
            value="{{ $movie->rights_adapt_contract_signature_date }}"
        ></x-form.datepicker>

        @error('movie.rights_adapt_contract_signature_date')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
    
</div>