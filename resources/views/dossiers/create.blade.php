<x-dynamic-component
    :component="$layout"
    :crumbs="$crumbs"
    :title="$pageTitles[$dossier->action->name]"
    :class="'dossier-page'">

    <x-slot name="slotAbove">
        <a href="{{ url()->previous() }}" class="flex mt-8 ml-4 font-normal tracking-wide text-blue-500 align-middle outline-none text-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            Go back
        </a>
    </x-slot>

    <div class="px-4 bg-white">

        @if (session()->has('error'))
            <x-alerts.error>
                {{ session()->get('error')}}
            </x-alerts.error>
        @endif

        @if(empty($print))
        @include('dossiers.instructions.index', ['dossier' => $dossier])
        @endif

        <form id="dossier-form" action="{{ route('dossiers.update', $dossier->id) }}" method="POST">
            @csrf
            {{ method_field('PATCH') }}
            <!-- Dossier details section -->
            <x-layout.section :title="'Application Information'">
                <div class="grid grid-cols-2 gap-4 my-4">
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'call-reference'"
                            :label="'Call / Topic reference'"
                            :disabled="true"
                            name="call_name"
                            value="{{ $dossier->call->name }}"></x-form.input>
                    </div>
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'sep-id'"
                            :label="'SEP Project ID'"
                            name="project_ref_id"
                            :disabled="true"
                            value="{{ $dossier->project_ref_id }}"></x-form.input>
                    </div>
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'company-name'"
                            :label="'Company Name'"
                            :hasError="$errors->has('company')"
                            :disabled="true"
                            name="company"
                            value="{{$dossier->company}}"></x-form.input>

                        @error('company')
                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <x-form.input
                            :print="$print"
                            :id="'contact-person'"
                            :label="'Contact Person'"
                            :disabled="true"
                            name="contact_person"
                            value="{{ $dossier->contact_person }}"></x-form.input>
                    </div>
                </div>
            </x-layout.section>



            <x-layout.section>
                @foreach ($dossier->action->activities as $activity)

                    @if ($activity->pivot->rules)
                        @foreach($activity->pivot->rules as $ruleName => $rule)
                            <input type="hidden" name="{{ $ruleName }}" value="{{ $rule }}">
                        @endforeach
                    @endif

                    @if (Auth::user()->hasRole('editor') || $activity->name!=='reinvestments')
                        @livewire(
                            "dossiers.activities.$activity->name",
                            [
                                'activity' => $activity,
                                'dossier' => $dossier,
                                'print' => $print,
                            ]
                        )
                    @endif
                @endforeach
            </x-layout.section>

            @if(empty($print))
            <div x-data class="flex items-center justify-end mt-32 space-x-3 print:hidden">
                @if ($hasHistory)
                    <a href="{{ route('dossier-history', $dossier) }}" class="block text-indigo-700 text-md hover:text-indigo-400">
                        View history
                    </a>
                @endif
                @if($dossier->status->id !== App\Models\Status::DRAFT)
                <x-button.download :dossier="$dossier"></x-button.download>
                @endif
                <x-button.primary :disabled="$dossier->call->closed" type="submit">Save</x-button.primary>
            </div>
            @endif
        </form>
    </div>

    <script>
        const form = document.getElementById('dossier-form');
        if ({{ $errors->count() }}) {
            form.scrollIntoView();
        }
    </script>
</x-dynamic-component>
