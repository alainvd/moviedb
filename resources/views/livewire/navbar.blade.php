<nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="w-8 h-8" src="{{ asset('images/vector.svg') }}" alt="Movie DB logo">
                </div>
                <div class="ml-4 text-xl font-bold leading-tight tracking-wide text-white">Media DB</div>
                <div class="hidden md:block">
                    <div class="flex items-baseline ml-10 space-x-4">
                        @foreach($links as $label => $url)
                            <a href="/{{$url}}" class="px-3 py-2 rounded-md text-sm font-medium text-white focus:outline-none focus:text-indigo-500 hover:text-indigo-500 {{ $url === $active ? 'text-indigo-500' : '' }}">
                                {{ ucfirst($label) }}
                            </a>
                        @endforeach

                        @can('access admin')
                            <a href="/admin" class="px-3 py-2 rounded-md text-sm font-medium text-white focus:outline-none focus:text-indigo-500 hover:text-indigo-500 {{ $url === $active ? 'text-indigo-500' : '' }}">
                                Admin
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="z-10 hidden md:block">
                <div class="flex items-center ml-4 md:ml-6">
                    <div class="self-center font-medium tracking-wider text-white text-md">
                        {{ auth()->user()->name ?? '' }}
                    </div>
                    <!-- Profile dropdown -->
                    <div x-data="{ open: false }" @click.away="open = false" class="relative ml-3">
                        <div>
                            <button @click="open = !open" class="flex items-center max-w-xs text-sm text-white rounded-full focus:outline-none focus:shadow-solid" id="user-menu" aria-label="User menu" aria-haspopup="true" x-bind:aria-expanded="open">
                                <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1579935110464-fcd041be62d0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80&flip=h" alt="{{ Auth::user() ? Auth::user()->name : '' }}" title="{{ Auth::user() ? Auth::user()->name : '' }}">
                            </button>
                        </div>
                        <div x-show="open" x-description="Profile dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-48 mt-2 origin-top-right rounded-md shadow-lg" style="display: none;">
                            <div class="py-1 bg-white rounded-md shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>

                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>

                                <a href="{{ route('cas-logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex -mr-2 md:hidden">
                <!-- Mobile menu button -->
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white" x-bind:aria-label="open ? 'Close main menu' : 'Main menu'" x-bind:aria-expanded="open" aria-label="Main menu">
                    <svg :class="{ 'hidden': open, 'block': !open }" class="block w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg :class="{ 'hidden': !open, 'block': open }" class="hidden w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="hidden" x-description="Mobile menu, toggle classes based on menu state." :class="{ 'block': open, 'hidden': !open }">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">

            @foreach($links as $label => $url)
                <a href="/{{ $url }}" class="block px-3 py-2 text-base font-medium text-gray-400 rounded-md focus:outline-none focus:text-white focus:bg-gray-700 {{ $url === $active ? 'bg-gray-900' : '' }}">
                    {{ ucfirst($label) }}
                </a>
            @endforeach

        </div>
        <div class="pt-4 pb-3 border-t border-gray-700">
            <div class="px-2 space-y-1">

                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Your
                    Profile</a>

                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Settings</a>

                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Sign
                    out</a>

            </div>
        </div>
    </div>
</nav>
