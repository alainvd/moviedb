<form id="admission-form" wire:submit.prevent="saveAdmission">

    <div>
        @if ($layout=='components.ecl-layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md md:px-8 lg:px-16">
        @elseif ($layout=='components.layout')
        <div class="w-full p-4 mx-auto my-4 bg-white rounded-md shadow-md">
        @endif

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
                        :id="'territory'"
                        :label="'Distribution Territory'"
                        :disabled="true"
                        value="{{ !empty($this->admissionsTable->country_id) ? $countriesById[$this->admissionsTable->country_id]['name'] : '' }}"
                    ></x-form.input>
                </div>

                <!-- year of admission -->
                <div class="col-span-2 md:col-span-1">
                    <x-form.input
                        :id="'year'"
                        :label="'Year of Admissions'"
                        :disabled="true"
                        value="{{ $this->admissionsTable->year }}"
                    ></x-form.input>
                </div>
            </div>

            <!-- FILM DATA -->
            <div class="mt-12 mb-4 text-lg">
                <h3>Film Data</h3>
            </div>

            <!-- film selection form goes here -->
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-7">
                <div class="col-span-2 md:col-span-3">
                    <x-form.input
                        :id="'film-title'"
                        :label="'Original Title'"
                        :disabled="true"
                        :value="!empty($admission->fiche) ? $admission->fiche->movie->original_title : ''"
                    ></x-form.input>
                </div>

                <div class="col-span-1 print:hidden">
                    <x-anchors.primary
                        class="mt-6"
                        :url="route('movie-wizard', ['dossier' => $dossier, 'activity' => 6, 'admissionsTable' => $this->admissionsTable->id, 'admission' => $this->admission->id])"
                    >
                        Select the Film
                    </x-anchors.primary>
                </div>

                @if($admission && $admission->fiche && request()->user()->can('update', $admission->fiche))
                <div class="m-6">
                    <x-anchors.secondary :url="route('dist-fiche-form', ['dossier'=>$dossier, 'activity'=>6, 'fiche'=>$admission->fiche, 'admissionsTable' => $admissionsTable, 'admission' => $admission])" :disabled="$dossier->call->closed">
                        Edit
                    </x-anchors.secondary>
                </div>
                @elseif($movie && $movie->fiche)
                <x-button.secondary wire:click.prevent="toggleShowDetails" class="mt-6">
                    View details
                </x-button.secondary>
                @endif
            </div>

            @include('dossiers.movie-details')

            <div class="grid grid-cols-2 gap-4 my-4 md:grid-cols-3">
                <div class="col-span-1">
                    <x-form.input
                        :id="'director'"
                        :label="'MEDIA Film Nationality'"
                        :disabled="true"
                        :value="!empty($admission->fiche) ? $admission->fiche->movie->film_country_of_origin : ''"
                    ></x-form.input>
                </div>

                <div class="col-span-1">
                    <x-form.input
                        :id="'country'"
                        :label="'Year of Copyright'"
                        :disabled="true"
                        :value="!empty($admission->fiche) ? $admission->fiche->movie->year_of_copyright : ''"
                    ></x-form.input>
                </div>
                
                <div class="col-span-1">
                    <x-form.input
                        :id="'copyright'"
                        :label="'Status'"
                        :disabled="true"
                        :value="!empty($admission->fiche) ? $admission->fiche->status->name : ''"
                    ></x-form.input>
                </div>
            </div>
            <!-- ----------------------------- -->

            <div class="grid grid-cols-1 my-4">
                <!-- local title -->
                <div class="col-span-1">
                    <x-form.input
                        :id="'local_title'"
                        :label="'Local title'"
                        :hasError="$errors->has('admission.local_title')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.local_title')"
                        wire:model="admission.local_title"
                    ></x-form.input>

                    @error('admission.local_title')
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
                        :id="'release_date'"
                        :label="'Release Date'"
                        :hasError="$errors->has('admission.release_date')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.release_date')"
                        wire:model="admission.release_date"
                    ></x-form.datepicker>

                    @error('admission.release_date')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- running_weeks -->
                <div class="col-span-1 col-start-1 md:col-start-2">
                    <x-form.input
                        :id="'running_weeks'"
                        :label="'Total N° of running weeks'"
                        :isAmount="false"
                        :hasError="$errors->has('admission.running_weeks')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.running_weeks')"
                        wire:model="admission.running_weeks"
                    ></x-form.input>

                    @error('admission.running_weeks')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- certified_admissions -->
                <div class="col-span-1 col-start-1 md:col-start-3">
                    <x-form.input
                        :id="'certified_admissions'"
                        :label="'N° of certified admissions'"
                        :hasError="$errors->has('admission.certified_admissions')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.certified_admissions')"
                        wire:model="admission.certified_admissions"
                    ></x-form.input>

                    @error('admission.certified_admissions')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- screens_first_week -->
                <div class="col-span-1 col-start-1 md:col-start-1">
                    <x-form.input
                        :id="'screens_first_week'"
                        :label="'N° of screens 1st week'"
                        :hasError="$errors->has('admission.screens_first_week')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.screens_first_week')"
                        wire:model="admission.screens_first_week"
                    ></x-form.input>

                    @error('admission.screens_first_week')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- screens_widest_release_week -->
                <div class="col-span-1 col-start-1 md:col-start-2">
                    <x-form.input
                        :id="'screens_widest_release_week'"
                        :label="'N° of screens widest release week'"
                        :hasError="$errors->has('admission.screens_widest_release_week')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.screens_widest_release_week')"
                        wire:model="admission.screens_widest_release_week"
                    ></x-form.input>

                    @error('admission.screens_widest_release_week')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- box_office_receipts -->
                <div class="col-span-1 col-start-1 md:col-start-3">
                    {{-- todo: enable amount --}}
                    {{-- todo: why does this turn to 0, when empty --}}
                    <x-form.input-trailing
                        :id="'box_office_receipts'"
                        :label="'Box office receipts including VAT'"
                        :trailing="'€'"
                        :isAmount="false"
                        :hasError="$errors->has('admission.box_office_receipts')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.box_office_receipts')"
                        wire:model="admission.box_office_receipts"
                    ></x-form.input-trailing>

                    @error('admission.box_office_receipts')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- comments -->
                <div class="col-span-3 lg:col-span-3">
                    <x-form.textarea
                        :id="'comments'"
                        :label="'Comments (optional)'"
                        :hasError="$errors->has('admission.comments')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.comments')"
                        wire:model="admission.comments"
                    ></x-form.textarea>

                    @error('admission.comments')
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
                        :id="'eligibility_european_criteria_film'"
                        :label="'European Criteria of Film'"
                        :hasError="$errors->has('admission.eligibility_european_criteria_film')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_european_criteria_film')"
                        wire:model="admission.eligibility_european_criteria_film"
                    >
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_european_criteria_film')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- eligibility_year_copyright -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_year_copyright'"
                        :label="'Year of Copyright'"
                        :hasError="$errors->has('admission.eligibility_year_copyright')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_year_copyright')"
                        wire:model="admission.eligibility_year_copyright"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_year_copyright')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- eligibility_release_date -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_release_date'"
                        :label="'Release Date'"
                        :hasError="$errors->has('admission.eligibility_release_date')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_release_date')"
                        wire:model="admission.eligibility_release_date"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_release_date')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- eligibility_european_criteria_distributor -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_european_criteria_distributor'"
                        :label="'European Criteria of Distributor'"
                        :hasError="$errors->has('admission.eligibility_european_criteria_distributor')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_european_criteria_distributor')"
                        wire:model="admission.eligibility_european_criteria_distributor"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_european_criteria_distributor')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- eligibility_legal_status -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_legal_status'"
                        :label="'Legal Status'"
                        :hasError="$errors->has('admission.eligibility_legal_status')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_legal_status')"
                        wire:model="admission.eligibility_legal_status"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_legal_status')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- eligibility_length -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_length'"
                        :label="'Length'"
                        :hasError="$errors->has('admission.eligibility_length')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_length')"
                        wire:model="admission.eligibility_length"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_length')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- eligibility_european_nonnational_film -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_european_nonnational_film'"
                        :label="'European non-national Film'"
                        :hasError="$errors->has('admission.eligibility_european_nonnational_film')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_european_nonnational_film')"
                        wire:model="admission.eligibility_european_nonnational_film"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_european_nonnational_film')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- eligibility_other_criteria -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_other_criteria'"
                        :label="'Other Criteria'"
                        :hasError="$errors->has('admission.eligibility_other_criteria')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_other_criteria')"
                        wire:model="admission.eligibility_other_criteria"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_other_criteria')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- eligibility_global_status -->
                <div class="col-span-1">
                    <x-form.select
                        :id="'eligibility_global_status'"
                        :label="'Global Status'"
                        :hasError="$errors->has('admission.eligibility_global_status')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_global_status')"
                        wire:model="admission.eligibility_global_status"
                    >    
                        <option value="1">OK</option>
                        <option value="0">Not OK</option>
                    </x-form.select>

                    @error('admission.eligibility_global_status')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- eligibility_justification -->
                <div class="col-span-1 md:col-span-3">
                    <x-form.input
                        :id="'eligibility_justification'"
                        :label="'Justification'"
                        :hasError="$errors->has('admission.eligibility_justification')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.eligibility_justification')"
                        wire:model="admission.eligibility_justification"
                    ></x-form.input>

                    @error('admission.eligibility_justification')
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
                        :id="'calculation_coefficient'"
                        :label="'Coefficient'"
                        :disabled="true"
                        :hasError="$errors->has('admission.coefficient')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.coefficient')"
                        wire:model="admission.coefficient"
                    ></x-form.input>
            
                    @error('admission.coefficient')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- certified_admissions -->
                <div class="col-span-1 col-start-1 md:col-start-2">
                    <x-form.input
                        :id="'calculation_certified_admissions'"
                        :label="'N° of certified admissions'"
                        :hasError="$errors->has('admission.certified_admissions')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.certified_admissions')"
                        wire:model="admission.certified_admissions"
                    ></x-form.input>
            
                    @error('admission.certified_admissions')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- total -->
                <div class="col-span-1 col-start-1 md:col-start-3">
                    {{-- todo: enable amount --}}
                    <x-form.input-trailing
                        :id="'calculation_total'"
                        :label="'Total'"
                        :trailing="'€'"
                        :isAmount="false"
                        :hasError="$errors->has('admission.total')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.total')"
                        wire:model="admission.total"
                    ></x-form.input-trailing>
            
                    @error('admission.total')
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
                        :id="'eacea_comments'"
                        :label="''"
                        :hasError="$errors->has('admission.comments')"
                        :isRequired="FormHelpers::isRequired($rules, 'admission.comments')"
                        wire:model="admission.comments"
                    >
                    </x-form.textarea>
            
                    @error('admission.comments')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endif

            <!-- buttons -->
            <div id="fiche-form-buttons" class="flex items-center justify-end mt-12 space-x-3 print:hidden">
                <x-button.secondary id="button-discard" >Discard changes</x-button.secondary>
                <x-button.primary id="button-submit" type="submit">Save</x-button.primary>
            </div>

        </div>
    </div>
</form>