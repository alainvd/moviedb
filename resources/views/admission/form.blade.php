<x-dynamic-component
    :component="$layout"
    :crumbs="$crumbs"
    :title="'Distribution Automatic - Declaration of Admissions'"
    :class="'admission-form'">

    <div class="px-4">

        <div class="bg-white">

            @if (Auth::user()->hasRole('applicant'))
            <div class="w-full mt-8">
                <div class="grid grid-cols-4 gap-8 p-8 my-4 bg-blue-200 border-t-2 border-b-2 border-blue-400">
                    <div class="col-span-4 text-gray-800 text-md">
                        Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus.
                    </div>
                </div>            
            </div>
            @endif

        </div>

        <!-- TOP FIELDS -->
        <div class="grid grid-cols-2 gap-4 my-4 md:grid-cols-3">
            <!-- territory -->
            <div class="col-span-2 md:col-span-1">
                <x-form.input
                    :print="$print"
                    :id="'territory'"
                    :label="'Distribution Territory'"
                    :hasError="$errors->has('territory')"
                    :disabled="true"
                    value="NL"
                ></x-form.input>

                @error('movie.original_title')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- year of admission -->
            <div class="col-span-2 md:col-span-1">
                <x-form.input
                    :print="$print"
                    :id="'year'"
                    :label="'Year of Admissions'"
                    :hasError="$errors->has('year')"
                    :disabled="true"
                    value="2020"
                ></x-form.input>

                @error('movie.original_title')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- FILM DATA -->
        <div class="mt-12 mb-4 text-lg">
            <h3>Film Data</h3>
        </div>    

        <!-- film selection form goes here -->
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-7">
            <input type="hidden" name="movie_id" wire:model="movie.id">

            <div class="col-span-2 md:col-span-3">
                <x-form.input
                    :print="$print"
                    :id="'film-title'"
                    :label="'Original Title'"
                    :hasError="$errors->has('film_title')"
                    :disabled="true"
                    wire:model="movie.original_title"
                    value="Dikkenek">
                </x-form.input>
                @error('film_title')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-1 print:hidden">
                <x-anchors.primary
                    class="mt-6"
                    :url="'test'"
                    {{--
                    :url="route('movie-wizard', ['dossier' => $dossier, 'activity' => 1])"
                    --}}
                    >
                    Select the Film
                </x-anchors.primary>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 my-4 md:grid-cols-3">

            <div class="col-span-1">
                <x-form.input
                    :print="$print"
                    :id="'director'"
                    :label="'MEDIA Film Nationality'"
                    :disabled="true"
                    wire:model="movie.director"
                    value="BE">
                </x-form.input>
            </div>

            <div class="col-span-1">
                <x-form.input
                    :print="$print"
                    :id="'country'"
                    :label="'Year of Copyright'"
                    :disabled="true"
                    wire:model="movie.film_country_of_origin"
                    value="2006">
                </x-form.input>
            </div>
            
            <div class="col-span-1">
                <x-form.input
                    :print="$print"
                    :id="'copyright'"
                    :label="'Status'"
                    :disabled="true"
                    wire:model="movie.year_of_copyright"
                    value="">
                </x-form.input>
            </div>
        </div>
        <!-- ----------------------------- -->

        <div class="grid grid-cols-1 my-4">
            <!-- local title -->
            <div class="col-span-1">
                <x-form.input
                    :print="$print"
                    :id="'local_title'"
                    :label="'Local title'"
                    :hasError="$errors->has('local_title')"
                    value="Dikkenek"
                ></x-form.input>

                @error('movie.original_title')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- FILM PERFORMANCE-->
        <div class="mt-12 mb-4 text-lg">
            <h3>Film Performance</h3>
        </div>    

        <div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-3">
            <!-- release_date -->
            <div class="col-span-1 col-start-1 md:col-start-1">
                <x-form.datepicker
                    :print="$print"
                    :id="'release_date'"
                    :label="'Release Date'"
                    :hasError="$errors->has('movie.photography_start')"
                    value="04/09/2018"
                ></x-form.datepicker>
        
                @error('movie.photography_start')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- running_weeks -->
            <div class="col-span-1 col-start-1 md:col-start-2">
                <x-form.input
                    :print="$print"
                    :id="'running_weeks'"
                    :label="'Total N° of running weeks'"
                    :isAmount="false"
                    :hasError="$errors->has('movie.film_length')"
                    value="12"
                ></x-form.input>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- certified_admissions -->
            <div class="col-span-1 col-start-1 md:col-start-3">
                <x-form.input
                    :print="$print"
                    :id="'certified_admissions'"
                    :label="'N° of certified admissions'"
                    :isAmount="false"
                    :hasError="$errors->has('movie.film_length')"
                    value="12"
                ></x-form.input>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- screens_first_week -->
            <div class="col-span-1 col-start-1 md:col-start-1">
                <x-form.input
                    :print="$print"
                    :id="'screens_first_week'"
                    :label="'N° of screens 1st week'"
                    :isAmount="false"
                    :hasError="$errors->has('movie.film_length')"
                    value="12"
                ></x-form.input>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- screens_widest_release_week -->
            <div class="col-span-1 col-start-1 md:col-start-2">
                <x-form.input
                    :print="$print"
                    :id="'screens_widest_release_week'"
                    :label="'N° of screens widest release week'"
                    :isAmount="false"
                    :hasError="$errors->has('movie.film_length')"
                    value="12"
                ></x-form.input>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- box_office_receipts -->
            <div class="col-span-1 col-start-1 md:col-start-3">
                {{-- todo: enable amount --}}
                <x-form.input-trailing
                    :print="$print"
                    :id="'film_length'"
                    :label="'Box office receipts including VAT'"
                    :trailing="'€'"
                    :isAmount="false"
                    :hasError="$errors->has('movie.film_length')"
                    value="12"
                ></x-form.input-trailing>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- comments -->
            <div class="col-span-3 lg:col-span-3">
                <x-form.textarea
                    :print="$print"
                    :id="'comments'"
                    :label="'Comments (optional)'"
                    :hasError="$errors->has('movie.synopsis')"
                    value="">
                </x-form.textarea>
        
                @error('movie.synopsis')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- ELIGIBILITY (internal) -->
        @if (Auth::user()->hasRole('editor'))
        <div class="mt-12 mb-4 text-lg">
            <h3>Eligibility (internal)</h3>
        </div>    

        <div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-3">

            <!-- todo: should these be checkboxes? -->
            
            <!-- eligibility_european_criteria_film -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_european_criteria_film'"
                    :label="'European Criteria of Film'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- eligibility_year_copyright -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_year_copyright'"
                    :label="'Year of Copyright'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- eligibility_release_date -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_release_date'"
                    :label="'Release Date'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- eligibility_european_criteria_distributor -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_european_criteria_distributor'"
                    :label="'European Criteria of Distributor'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- eligibility_legal_status -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_legal_status'"
                    :label="'Legal Status'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- eligibility_length -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_length'"
                    :label="'Length'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- eligibility_european_nonnational_film -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_european_nonnational_film'"
                    :label="'European non-national Film'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- eligibility_other_criteria -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_other_criteria'"
                    :label="'Other Criteria'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- eligibility_global_status -->
            <div class="col-span-1">
                <x-form.select
                    :print="$print"
                    :id="'eligibility_global_status'"
                    :label="'Global Status'"
                    :hasError="$errors->has('fiche.status_id')"
                    value=""
                >    
                    <option value="1">OK</option>
                    <option value="0">Not OK</option>
                </x-form.select>

                @error('fiche.status_id')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- eligibility_justification -->
            <div class="col-span-1 md:col-span-3">
                <x-form.input
                    :print="$print"
                    :id="'eligibility_justification'"
                    :label="'Justification'"
                    :hasError="$errors->has('local_title')"
                    value=""
                ></x-form.input>

                @error('movie.original_title')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
        </div>
        @endif

        <!-- CALCULATION (internal) -->
        @if (Auth::user()->hasRole('editor'))
        <div class="mt-12 mb-4 text-lg">
            <h3>Calculation (internal)</h3>
        </div>    

        <div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-3">
            <!-- coefficient -->
            <div class="col-span-1 col-start-1 md:col-start-1">
                <x-form.input
                    :print="$print"
                    :id="'coefficient'"
                    :label="'Coefficient'"
                    :isAmount="false"
                    :disabled="true"
                    :hasError="$errors->has('movie.film_length')"
                    value="0,75"
                ></x-form.input>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- certified_admissions -->
            <div class="col-span-1 col-start-1 md:col-start-2">
                <x-form.input
                    :print="$print"
                    :id="'certified_admissions'"
                    :label="'N° of certified admissions'"
                    :isAmount="false"
                    :hasError="$errors->has('movie.film_length')"
                    value="1.119"
                ></x-form.input>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- total -->
            <div class="col-span-1 col-start-1 md:col-start-3">
                {{-- todo: enable amount --}}
                <x-form.input-trailing
                    :print="$print"
                    :id="'total'"
                    :label="'Total'"
                    :trailing="'€'"
                    :isAmount="false"
                    :hasError="$errors->has('movie.film_length')"
                    value="345,25"
                ></x-form.input-trailing>
        
                @error('movie.film_length')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endif

        @if (Auth::user()->hasRole('editor'))
        <div class="mt-12 mb-4 text-lg">
            <h3>EACEA Comments (internal)</h3>
        </div>    

        <div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-3">
            <!-- comments -->
            <div class="col-span-3 lg:col-span-3">
                <x-form.textarea
                    :print="$print"
                    :id="'comments'"
                    :label="''"
                    :hasError="$errors->has('movie.synopsis')"
                    value="">
                </x-form.textarea>
        
                @error('movie.synopsis')
                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endif

        <!-- buttons -->
        <div id="fiche-form-buttons" class="flex items-center justify-end mt-12 space-x-3 print:hidden">
            <x-button.secondary id="button-save" wire:click="saveFiche">Discard changes</x-button.primary>
            <x-button.primary id="button-submit" type="submit">Save</x-button.primary>
        </div>

    </div>

</x-component>