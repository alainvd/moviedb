<div class="my-8">
    <h3 class="my-4 text-lg font-normal leading-tight">
        Declaration of Admissions
    </h3>

    <!-- ADMISSIONS TABLES -->
    @foreach ($admissionsTables as $index => $admissionsTable)
    <div wire:key="admissionsTable-{{ $index }}">

        <!-- TOP FIELDS -->
        <div class="grid grid-cols-2 gap-4 my-4 md:grid-cols-3">
            <!-- territory -->
            <div class="col-span-2 md:col-span-1">
                Distribution Territory
                <x-form.select
                    :print="$print"
                    :id="'country_id_'.$index"
                    :label="''"
                    :disabled="!$admissionsTable->admissions->isEmpty()"
                    wire:model="admissionsTables.{{ $index }}.country_id"
                    value="{{ !empty($admissionsTables[$index]->country_id) ? $countriesById[$admissionsTables[$index]->country_id]['name'] : '' }}"
                >
                    @foreach ($countriesGrouped as $group=>$countries)
                        <optgroup label="---">
                            @foreach ($countries as $country)
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </x-form.select>
            </div>

            <!-- year of admissions -->
            <div class="col-span-2 md:col-span-1">
                Year of Admissions
                <x-form.select
                    :print="$print"
                    :id="'year_'.$index"
                    :label="''"
                    :disabled="!$admissionsTable->admissions->isEmpty()"
                    wire:model="admissionsTables.{{ $index }}.year"
                    value="{{ $admissionsTable->year }}"
                >
                    @foreach($years as $year)
                        <option value="{{$year}}">{{ $year }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <!-- ADMISSIONS  -->
        <x-table>
            <x-slot name="head">
                <x-table.heading>ORIGINAL TITLE</x-table.heading>
                <x-table.heading>MEDIA FILM NATIONALITY</x-table.heading>
                <x-table.heading>YEAR OF COPYRIGHT</x-table.heading>
                <x-table.heading>ADMISSIONS</x-table.heading>
                @if(empty($print))<x-table.heading>&nbsp;</x-table.heading>@endif
            </x-slot>

            <x-slot name="body">
                @if (!empty($admissionsTable->admissions))
                    <x-dossiers.admissions-table-rows
                        :dossier="$dossier"
                        :admissions="$admissionsTable->admissions"
                        :countriesById="$countriesById"
                        :print="$print"
                    >
                    </x-dossiers.admissions-table-rows>
                @else
                <x-table.row>
                    <x-table.cell class="text-center" colspan="5">No declarations yet</x-table.cell>
                </x-table.row>
                @endif
            </x-slot>
        </x-table>
        <!-- /ADMISSIONS -->

        @if(empty($print))
        <div class="mt-5 text-right print:hidden">
            <x-anchors.secondary
                :url="'/admission/'.$this->dossier->project_ref_id.'/'.$admissionsTable->id"
                :disabled="empty($admissionsTable->country_id) || empty($admissionsTable->year)"
            >
                Add a line
            </x-anchors.secondary>
        </div>
        @endif

    </div>
    @endforeach
    <!-- /ADMISSIONS TABLES -->

    @if(empty($print))
    <div class="mt-5 text-right print:hidden">
        <x-button.primary
            wire:click="addTable"
        >
            Add a new Territory/Year Table
        </x-button.primary>
    </div>
    @endif

    <!-- not sure where this should no, probably in a template with admission rows -->
    <x-modal.confirmation wire:model.defer="showDeleteModal">
        <x-slot name="title">Remove Declaration</x-slot>

        <x-slot name="content">
            <div class="py-8 text-xl">
                Are you sure you want to remove this declaration from the dossier?
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-3">
                <x-button.primary wire:click="delete">Yes</x-button>

                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button>
            </div>
        </x-slot>
    </x-modal.confirmation>

</div>