<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Movie DB</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-gray-100 h-screen antialiased leading-none">
    <div>
        <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="{{ asset('images/vector.svg') }}"
                                alt="Movie DB logo">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="#"
                                    class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Media</a>
                                <a href="#"
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Projects</a>
                                <a href="#"
                                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Reports</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end">
                                <div class="max-w-lg w-full lg:max-w-xs">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input id="search"
                                            class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:text-gray-900 sm:text-sm transition duration-150 ease-in-out"
                                            placeholder="Search" type="search">
                                    </div>
                                </div>
                            </div>
                            <button
                                class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700"
                                aria-label="Notifications">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                            <!-- Profile dropdown -->
                            <div @click.away="open = false" class="ml-3 relative">
                                <div>
                                    <button @click="open = !open"
                                        class="max-w-xs flex items-center text-sm rounded-full text-white focus:outline-none focus:shadow-solid"
                                        id="user-menu" aria-label="User menu" aria-haspopup="true"
                                        x-bind:aria-expanded="open">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1579935110464-fcd041be62d0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80&flip=h"
                                            alt="">
                                    </button>
                                </div>
                                <div x-show="open"
                                    x-description="Profile dropdown panel, show/hide based on dropdown state."
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
                                    style="display: none;">
                                    <div class="py-1 rounded-md bg-white shadow-xs" role="menu"
                                        aria-orientation="vertical" aria-labelledby="user-menu">

                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">Your Profile</a>

                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">Settings</a>

                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button @click="open = !open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white"
                            x-bind:aria-label="open ? 'Close main menu' : 'Main menu'" x-bind:aria-expanded="open"
                            aria-label="Main menu">
                            <svg :class="{ 'hidden': open, 'block': !open }" class="h-6 w-6 block" stroke="currentColor"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg :class="{ 'hidden': !open, 'block': open }" class="h-6 w-6 hidden"
                                stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div x-description="Mobile menu, toggle classes based on menu state."
                :class="{ 'block': open, 'hidden': !open }">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">

                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Media</a>

                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Projects</a>

                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Reports</a>

                </div>
                <div class="pt-4 pb-3 border-t border-gray-700">
                    <div class="flex items-center px-5 space-x-3">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full"
                                src="https://images.unsplash.com/photo-1579935110464-fcd041be62d0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80&flip=h"
                                alt="">
                        </div>
                        <div class="space-y-1">
                            <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                            <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                        </div>
                    </div>
                    <div class="mt-3 px-2 space-y-1">

                        <a href="#"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Your
                            Profile</a>

                        <a href="#"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Settings</a>

                        <a href="#"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Sign
                            out</a>

                    </div>
                </div>
            </div>
        </nav>
        <div class="h-screen flex overflow-hidden bg-gray-100">
            <!-- Static sidebar for desktop -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col justify-center bg-grey-lighter w-16 border-r border-gray-200 bg-white">
                    <div class="text-grey-darker text-center bg-grey-light py-2">
                        <a href="#"
                            class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:border-red-200 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                            <svg class="ml-2" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                    <div class="text-grey-darker text-center bg-grey-light py-2">
                        <a href="#"
                            class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 border-r-4 border-indigo-500 hover:border-indigo-300 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                            <svg class="ml-2 text-red-500" width="24" height="24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill="url(#pattern0)" d="M0 0h24v24H0z" />
                                <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0" transform="scale(.01)" />
                                    </pattern>
                                    <image id="image0" width="100" height="100"
                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAFXUlEQVR4Xu2dQXYbNwyGAbp2lk0XVV5X9Q3qniD2CWqfoMrCelnmApFs5wJd5imLyidIeoLYN3BvoKz6rC5iL2NHwz6OpD45iYaACY4wY8x2OCD4f4REgjMkgl2qFEBV3pgzYECUdQIDYkCUKaDMHYsQA6JMAWXuWIQYEGUKKHPHIsSAKFNAmTsWIVqBdAcfHz/yn5562NgJPjr8fPr6+Kcx1d/ng3+2C//d79TybSqXohXC9OITPjofHf9wFTQpI+T54N/dwvu3APB4IZRD3Ht9/OMZVbi5jffU8m0qJ6DV2CE+C3rj4WCygx6CkP/DmEWIAaF2GiGtrhxOf8XD/uU7BPzty8qFKqG2qdHlpLTy4P/CXn/y8cvosAjh9Q8pIABwFYD4FdWfDk86Xaprvf5kBAAP8k8dAMS0qgICiDAqCgxCV17O+a73QIYXs9fE+1JaVQJpojBN99mAKCNoQAwI/O1wus/JAqxDs1nmYeMdAPxSZ/31R4jzB8OjJ6Gh6q/e0eU+FBgyGLVdtQPhjtlrU+IbFYX83pa/DfO02q4qINfew4s3rzrRYe/hy0kXEf4AgO9jnjcJSGhLxTxtualiWlUA8cfDkydHMYEX93v9yyMAHMTKtxOInFYrgXCFo2Z7uXZjgHPfp0QIt01VWhmQCFEDkrvLM+0bEKZguYsbkNwKM+0bEKZguYsbkNwKM+0bEKZguYurAQLMnBM178Mds+cWPGafAkRSq5XzEO/h7M2rzl7M4cX9w5eT94iwGyvfRiCSWsWSi2OA+BIugA/Lt9sxGOF+G4HM2y2iVQwIRWNWmRYDYemwqrABEUidiJCYGzEgBoT3iqpk77uPLdIo6z6GVzxjEdLACDkndICnhDJlkSb9qVPXeJbanqxVRYTgB4efdylvh8y/DTkD8D/HwIQx+63bPFh8DxErv677YT19s7h9S5lbAchpVTUxfEZZT1+aGIZ19T+JAo69B/LHQESbosUQy3kVaW7lPYhpVfuKoahqSoxxf4ZVLeEq0VDUDQMiKme6MQOSrqGoBQMiKme6MQOSrqGoBQMiKme6MQOSrqGohVqASE52vm49fgDwqieGALhNyTyEtklqVZVcHDuc7tFTJxth8wHKzPb8Bjf3m5A62fK34TsWSp5OTKtotjfknmLxTcv3zKxwwztWd8773OSihFZRININbhKQ0HZbD5HuAYn2DEiigNKPGxBpRRPtGZBEAaUfVwYkzBeK6EefAK5LHbO3909dRquqUdb58KQTfTV00SN7/UkYHkfH7C0FIqbVaiD2snXZ10g/WYJa1b6E28YI4bZJ1RIu13npP2muPUqEcNtkQLgUlsobkATxcjxqQHKommDTgCSIl+NRA5JD1QSbBiRBvByPqgECILfl0LJQ3CFiDpE5NilAJLWqSp2E3fpfDE86p7EG9PqTsIFy2MDszv7x33qunUBATCtbMazobdq2+IsFxv3uM/M+96tE5inqZggytc2s1B4hAHDhcHpAeZtFsqFcW/NtYsOOpOUBN3Vd6wCyaJvaj3Y4H+tIg1onEOm2tMKeAVGGMQbk1GF8r5PCl3udPNSzQxZIRbSqAiJ2SImyTpjDHTGtApAwqflqR2ruBI772mUOVdZlU1CrazsUTICiFJDyULD5sXnhjZE7USJViUB71ZsQ0ura4XRn6WBJGC2/WyVUiXoxJRxM1yrsBAHd8mDJhUNl3gZvdqGYzUwdFiPObHo2sw0vzD28K0krBxc3fuvsztGrD09CvS2206KVsTEgBkSZAsrcsQgxIMoUUOaORYgBUaaAMncsQgyIMgWUuWMRYkCUKaDMnf8AFYgc2e4UVtUAAAAASUVORK5CYII=" />
                                </defs>
                            </svg>
                        </a>
                    </div>
                    <div class="text-grey-darker text-center bg-grey-light py-2">
                        <a href="#"
                            class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:border-indigo-200 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                            <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="24" height="24" fill="url(#pattern1)" />
                                <defs>
                                    <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image1" transform="scale(0.01)" />
                                    </pattern>
                                    <image id="image1" width="100" height="100"
                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAADCUlEQVR4Xu2dsW4TQRRF3+SDoOAH6MBGgsamAQlItX9B8hfbBCGlw2mSwqFMQwcF+aAMiqWNCHKkm+zkemY5KVJd731zjsdZp5hNwU9VBFJV0zBMIKSyNwFCEFIZgcrGYYcgpDIClY3DDkFIZQQqG4cdUruQ2aJ7l1K8iIinEfGksnmnMs6vlOP31V78OP/Wf/l7Ubd2yHzRHUSKz1NZdQvryBFn56v+zTDrjZD5ssstLGCqM65X/cbF5tds2Z2miNdTXWwT68pxuD7pD9Lsbbefchw1MfTEh8w53qdXi+4op9if+FpbWd5xmi+7nxHxrJWJJz7n5bUQ/phXZBkhFcnY3GWxQ+oyIgsZ7pPrGr+dadQ3PkJMThFiAq3WIEQlZcohxARarUGISsqUQ4gJtFqDEJWUKYcQE2i1BiEqKVMOISbQag1CVFKmHEJMoNUahKikTDmEmECrNQhRSZlyCDGBVmsQopIy5RBiAq3WIEQlZcohxARarUGISsqUQ4gJtFqDEJWUKYcQE2i1BiEqKVMOISbQag1CVFKmHEJMoNUahKikTDmEmECrNQhRSZlyCDGBVmsQopIy5RBiAq3WIEQlZcohxARarUGISsqUQ4gJtFqDEJWUKYcQE2i1BiEqKVMOISbQag1CVFKmHEJMoNWa4kLUYnLjCMiHz4yr4dUqAYSopEw5zlw0gRZrLjmVVCRlih1zbq+JtFKzObf3OsjJ1gquR84MJ1sPNep98iOP9d9e/tbZ7zdSeDqC/Q1x59MRhkl4fojFifb8EMsoBUrUj9cWj7Zt8pFHCCnwri55CYSUpFngWggpALHkJRByB82Xi+75XooPEfGxJPBmr5Xj8Cri4vtJf/HQNYz6o85T3bZi/7pe9Z92I4SHwWzlPuZ2e9wOQQhCHvpR4HwdO8RJW+hCiADJGUGIk7bQtTsh/Lt+m57d3fbyxfAfH7v+YijsXiL3JDDqe8g9u4gLBBAiQHJGEOKkLXQhRIDkjCDESVvoQogAyRlBiJO20IUQAZIzghAnbaHrD9pHq2huB2ikAAAAAElFTkSuQmCC" />
                                </defs>
                            </svg>
                        </a>
                    </div>
                    <div class="text-grey-darker text-center bg-grey-light py-2">
                        <a href="#"
                            class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:border-red-200 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                            <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="24" height="24" fill="url(#pattern2)" />
                                <defs>
                                    <pattern id="pattern2" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image2" transform="scale(0.01)" />
                                    </pattern>
                                    <image id="image2" width="100" height="100"
                                        xlink:href="data:image/png;base64,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" />
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150"
                        aria-label="Open sidebar">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- The page content -->
                <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>
