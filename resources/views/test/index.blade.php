<x-ecl-layout>
    <div class="pt-2 pb-6 md:py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        Test Links
                    </h2>
                </div>
            </div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="overflow-hidden bg-white rounded-md shadow">
                <ul class="divide-y divide-gray-200">
                    <li class="px-6 py-4">
                        <a href="/tables/movies">DataTable: Movies</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/tables/dossiers">DataTable: Dossiers</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/browse/movies">Browse Movies</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/dashboard">Dashboard (for Access Rights)</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/browse/movies">Movies List</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/browse/movies/1">Movies View Fiche</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/browse/audience">Audiences List</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/browse/crew">Browse Crew Sample</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/demo">Demo page (SEP mock page)</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="/pic">PIC Search</a>
                    </li>
                    <li class="px-6 py-4">
                        <a href="{{ route('sep', $sepParams) }}">SEP Landing Page</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</x-ecl-layout>
