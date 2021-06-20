<div class="grid grid-cols-1 fiche-details-component" id="fdc-link-applicant-work">

    <div class="col-span-1">
        <x-form.select
            :print="$print"
            :id="'link_applicant_work'"
            :label="'Link between Applicant company and Work'"
            :hasError="$errors->has('movie.link_applicant_work')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.link_applicant_work')"
            wire:model="movie.link_applicant_work"
            value="{{ isset($linkApplicantWork[$movie->link_applicant_work]) ? $linkApplicantWork[$movie->link_applicant_work] : '' }}"
        >

            @foreach ($linkApplicantWork as $id=>$value)
                <option value="{{ $id }}">{{ $value }}</option>
            @endforeach

        </x-form.select>

        @error('movie.link_applicant_work')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>

<!-- dependent fields -->
<div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-3">
    <!-- link_applicant_work_person_name -->
    <div class="col-span-1" x-data="{ show: false }" x-show="$wire.movie.link_applicant_work == 'WRKPERS'">
        <x-form.input
            :print="$print"
            :id="'link_applicant_work_person_name'"
            :label="'Name of the Person for the Personal Credit'"
            :hasError="$errors->has('movie.link_applicant_work_person_name')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.link_applicant_work_person_name')"
            wire:model="movie.link_applicant_work_person_name"
            value="{{ $movie->link_applicant_work_person_name }}"
        ></x-form.input>

        @error('movie.link_applicant_work_person_name')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- link_applicant_work_person_position -->
    <div class="col-span-1" x-data="{ show: false }" x-show="$wire.movie.link_applicant_work == 'WRKPERS'">
        <x-form.input
            :print="$print"
            :id="'link_applicant_work_person_position'"
            :label="'Position of the Person of Personal Credit'"
            :hasError="$errors->has('movie.link_applicant_work_person_position')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.link_applicant_work_person_position')"
            wire:model="movie.link_applicant_work_person_position"
            value="{{ $movie->link_applicant_work_person_position }}"
        ></x-form.input>

        @error('movie.link_applicant_work_person_position')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- link_applicant_work_person_credit -->
    <div class="col-span-1" x-data="{ show: false }" x-show="$wire.movie.link_applicant_work == 'WRKPERS' || $wire.movie.link_applicant_work == 'WRKCOPROD'">
        <x-form.input
            :print="$print"
            :id="'link_applicant_work_person_credit'"
            :label="'On-screen Credit'"
            :hasError="$errors->has('movie.link_applicant_work_person_credit')"
            :isRequired="FormHelpers::isRequired($rules, 'movie.link_applicant_work_person_credit')"
            wire:model="movie.link_applicant_work_person_credit"
            value="{{ $movie->link_applicant_work_person_credit }}"
        ></x-form.input>

        @error('movie.link_applicant_work_person_credit')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

</div>
