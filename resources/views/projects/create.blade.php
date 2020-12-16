<x-landing-layout>

    <div class="my-8 py-8 px-4 md:px-8 lg:px-16 bg-white">
        <!-- Title -->
        <h1 class="text-2xl leading-tight font-light">European Slate Development</h1>

        <!-- Dossier details section -->
        <x-layout.section :title="'Application Information'">
            <div class="my-4 grid grid-cols-2 gap-4">
                <div class="col-span-1">
                    <x-form.input
                        :id="'call-reference'"
                        :label="'Call / Topic reference'"
                        :disabled="true"
                        name="call_name"
                        value="{{ $dossier->call->name  }}"></x-form.input>
                </div>
                <div class="col-span-1">
                    <x-form.input
                        :id="'sep-id'"
                        :label="'SEP Project ID'"
                        name="project_ref_id"
                        :disabled="true"
                        value="{{ $dossier->project_ref_id }}"></x-form.input>
                </div>
                <div class="col-span-1">
                    <x-form.input
                        :id="'company-name'"
                        :label="'Company Name'"
                        name="company_name"></x-form.input>
                </div>
                <div class="col-span-1">
                    <x-form.input
                        :id="'contact-person'"
                        :label="'Contact Person'"
                        :disabled="true"
                        name="contact_person"
                        value="{{ $dossier->contact_person }}"></x-form.input>
                </div>
            </div>
        </x-layout.section>

        <!-- Development section -->
        <x-layout.section
            :title="'Development'">

            <!-- Previous works table -->
            <h3 class="text-lg leading-tight font-normal my-4">
                Audiovisual Work - Development - Recent work / previous experience
            </h3>
            <x-table>
                <x-slot name="head">
                    <x-table.heading>TITLE</x-table.heading>
                    <x-table.heading>GENRE</x-table.heading>
                    <x-table.heading>PRODUCTION YEAR</x-table.heading>
                    <x-table.heading>FILM ID</x-table.heading>
                    <x-table.heading>&nbsp;</x-table.heading>
                </x-slot>

                <x-slot name="body">

                </x-slot>
            </x-table>
            <div class="mt-5 text-right">
                <x-anchors.secondary :url="url('fiches/dist')">
                    Add
                </x-anchors.secondary>
            </div>

            <!-- Previous works table -->
            <h3 class="text-lg leading-tight font-normal my-4">
                Audiovisual Work - Development - For grant request
            </h3>
            <x-table>
                <x-slot name="head">
                    <x-table.heading>TITLE</x-table.heading>
                    <x-table.heading>GENRE</x-table.heading>
                    <x-table.heading>PRODUCTION YEAR</x-table.heading>
                    <x-table.heading>FILM ID</x-table.heading>
                    <x-table.heading>&nbsp;</x-table.heading>
                </x-slot>

                <x-slot name="body">

                </x-slot>
            </x-table>
            <div class="mt-5 text-right">
                <x-anchors.secondary :url="url('fiches/dist')">
                    Add
                </x-anchors.secondary>
            </div>
        </x-layout.section>
    </div>
    <!--
    <form>
        <div class="p-4 md:px-8 lg:px-16 mx-auto w-full sm:w-11/12 rounded-md shadow-md bg-white">

        </div>
    </form> -->
</x-landing-layout>
