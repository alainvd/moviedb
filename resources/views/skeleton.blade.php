<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Movie DB</title>

    <!--

    Styles

    -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
<div>
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="images/vector.svg"
                             alt="Workflow logo">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline">
                            <a href="#"
                               class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Media</a>
                            <a href="#"
                               class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Projects</a>
                            <a href="#"
                               class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Reports</a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">


                        <span class="inline-flex rounded-md shadow-sm">
                          <button type="button" class="mr-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
    <svg width="24" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20 12H4M12 4V20V4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>


                              New Media
                          </button>
                        </span>

                        <button
                            class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700"
                            aria-label="Notifications">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button>


                        <!-- Profile dropdown -->
                        <div class="ml-3 relative">
                            <div>
                                <button
                                    class="max-w-xs flex items-center text-sm rounded-full text-white focus:outline-none focus:shadow-solid"
                                    id="user-menu" aria-label="User menu" aria-haspopup="true">
                                    <img class="h-10 w-10 rounded-full"
                                         src="https://images.unsplash.com/photo-1579935110464-fcd041be62d0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80&flip=h"
                                         alt="">
                                </button>
                            </div>
                            <!--
                              Profile dropdown panel, show/hide based on dropdown state.

                              Entering: "transition ease-out duration-100"
                                From: "transform opacity-0 scale-95"
                                To: "transform opacity-100 scale-100"
                              Leaving: "transition ease-in duration-75"
                                From: "transform opacity-100 scale-100"
                                To: "transform opacity-0 scale-95"
                            -->
                            {{--                            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">--}}
                            {{--                                <div class="py-1 rounded-md bg-white shadow-xs">--}}
                            {{--                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>--}}
                            {{--                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>--}}
                            {{--                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!--
          Mobile menu, toggle classes based on menu state.

          Open: "block", closed: "hidden"
        -->
        <div class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 sm:px-3">
                <a href="#"
                   class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Dashboard</a>
                <a href="#"
                   class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Team</a>
                <a href="#"
                   class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Projects</a>
                <a href="#"
                   class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Calendar</a>
                <a href="#"
                   class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Reports</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-700">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                             src="https://images.unsplash.com/photo-1499155286265-79a9dc9c6380?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                        <div class="mt-1 text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                    </div>
                </div>
                <div class="mt-3 px-2" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                    <a href="#"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                       role="menuitem">Your Profile</a>
                    <a href="#"
                       class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                       role="menuitem">Settings</a>
                    <a href="#"
                       class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                       role="menuitem">Sign out</a>
                </div>
            </div>
        </div>
    </nav>

{{--    <header class="bg-white shadow-sm">--}}
{{--        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">--}}
{{--            <h1 class="text-lg leading-6 font-semibold text-gray-900">--}}
{{--                Dashboard--}}
{{--            </h1>--}}
{{--        </div>--}}
{{--    </header>--}}
{{--    <main>--}}
{{--        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">--}}
{{--            <!-- Replace with your content -->--}}
{{--            <div class="px-4 py-4 sm:px-0">--}}
{{--                <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">hello</div>--}}
{{--            </div>--}}
{{--            <!-- /End replace -->--}}
{{--        </div>--}}
{{--    </main>--}}

    <div class="h-screen flex overflow-hidden bg-gray-100">
        <!-- Off-canvas menu for mobile -->
        <div class="md:hidden">
            <div class="fixed inset-0 flex z-40">
                <!--
                  Off-canvas menu overlay, show/hide based on off-canvas menu state.

                  Entering: "transition-opacity ease-linear duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "transition-opacity ease-linear duration-300"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0">
                    <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                </div>
                <!--
                  Off-canvas menu, show/hide based on off-canvas menu state.

                  Entering: "transition ease-in-out duration-300 transform"
                    From: "-translate-x-full"
                    To: "translate-x-0"
                  Leaving: "transition ease-in-out duration-300 transform"
                    From: "translate-x-0"
                    To: "-translate-x-full"
                -->
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                    <div class="absolute top-0 right-0 -mr-14 p-1">
                        <button class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600" aria-label="Close sidebar">
                            <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto bg-gray-400">
                        <div class="flex-shrink-0 flex items-center px-4">
                            <img class="h-8 w-auto" src="images/moviedb-logo.svg" alt="Workflow">
                        </div>
                        <nav class="mt-5 px-2">
                            <a href="#" class="group flex items-center px-2 py-2 text-base leading-6 font-medium text-gray-900 rounded-md bg-gray-100 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                                <svg class="mr-4 h-6 w-6 text-gray-800 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Media
                            </a>
                            <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-100 transition ease-in-out duration-150">
                                <svg class="mr-4 h-6 w-6 text-gray-800 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                </svg>
                                Projects
                            </a>
                            <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-100 transition ease-in-out duration-150">
                                <svg class="mr-4 h-6 w-6 text-gray-800 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Reports
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="flex-shrink-0 w-14">
                    <!-- Force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col justify-center bg-grey-lighter w-16 border-r border-gray-200 bg-white">
                <div class="text-grey-darker text-center bg-grey-light py-2">
                    <a href="#"
                       class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:border-red-200 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                        <svg class="ml-2" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <div class="text-grey-darker text-center bg-grey-light py-2">
                    <a href="#"
                       class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 border-r-4 border-indigo-500 hover:border-indigo-300 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                        <svg class="ml-2 text-red-500" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path fill="url(#pattern0)" d="M0 0h24v24H0z" />
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0" transform="scale(.01)"/>
                                </pattern>
                                <image id="image0" width="100" height="100"
                                       xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAFXUlEQVR4Xu2dQXYbNwyGAbp2lk0XVV5X9Q3qniD2CWqfoMrCelnmApFs5wJd5imLyidIeoLYN3BvoKz6rC5iL2NHwz6OpD45iYaACY4wY8x2OCD4f4REgjMkgl2qFEBV3pgzYECUdQIDYkCUKaDMHYsQA6JMAWXuWIQYEGUKKHPHIsSAKFNAmTsWIVqBdAcfHz/yn5562NgJPjr8fPr6+Kcx1d/ng3+2C//d79TybSqXohXC9OITPjofHf9wFTQpI+T54N/dwvu3APB4IZRD3Ht9/OMZVbi5jffU8m0qJ6DV2CE+C3rj4WCygx6CkP/DmEWIAaF2GiGtrhxOf8XD/uU7BPzty8qFKqG2qdHlpLTy4P/CXn/y8cvosAjh9Q8pIABwFYD4FdWfDk86Xaprvf5kBAAP8k8dAMS0qgICiDAqCgxCV17O+a73QIYXs9fE+1JaVQJpojBN99mAKCNoQAwI/O1wus/JAqxDs1nmYeMdAPxSZ/31R4jzB8OjJ6Gh6q/e0eU+FBgyGLVdtQPhjtlrU+IbFYX83pa/DfO02q4qINfew4s3rzrRYe/hy0kXEf4AgO9jnjcJSGhLxTxtualiWlUA8cfDkydHMYEX93v9yyMAHMTKtxOInFYrgXCFo2Z7uXZjgHPfp0QIt01VWhmQCFEDkrvLM+0bEKZguYsbkNwKM+0bEKZguYsbkNwKM+0bEKZguYurAQLMnBM178Mds+cWPGafAkRSq5XzEO/h7M2rzl7M4cX9w5eT94iwGyvfRiCSWsWSi2OA+BIugA/Lt9sxGOF+G4HM2y2iVQwIRWNWmRYDYemwqrABEUidiJCYGzEgBoT3iqpk77uPLdIo6z6GVzxjEdLACDkndICnhDJlkSb9qVPXeJbanqxVRYTgB4efdylvh8y/DTkD8D/HwIQx+63bPFh8DxErv677YT19s7h9S5lbAchpVTUxfEZZT1+aGIZ19T+JAo69B/LHQESbosUQy3kVaW7lPYhpVfuKoahqSoxxf4ZVLeEq0VDUDQMiKme6MQOSrqGoBQMiKme6MQOSrqGoBQMiKme6MQOSrqGohVqASE52vm49fgDwqieGALhNyTyEtklqVZVcHDuc7tFTJxth8wHKzPb8Bjf3m5A62fK34TsWSp5OTKtotjfknmLxTcv3zKxwwztWd8773OSihFZRININbhKQ0HZbD5HuAYn2DEiigNKPGxBpRRPtGZBEAaUfVwYkzBeK6EefAK5LHbO3909dRquqUdb58KQTfTV00SN7/UkYHkfH7C0FIqbVaiD2snXZ10g/WYJa1b6E28YI4bZJ1RIu13npP2muPUqEcNtkQLgUlsobkATxcjxqQHKommDTgCSIl+NRA5JD1QSbBiRBvByPqgECILfl0LJQ3CFiDpE5NilAJLWqSp2E3fpfDE86p7EG9PqTsIFy2MDszv7x33qunUBATCtbMazobdq2+IsFxv3uM/M+96tE5inqZggytc2s1B4hAHDhcHpAeZtFsqFcW/NtYsOOpOUBN3Vd6wCyaJvaj3Y4H+tIg1onEOm2tMKeAVGGMQbk1GF8r5PCl3udPNSzQxZIRbSqAiJ2SImyTpjDHTGtApAwqflqR2ruBI772mUOVdZlU1CrazsUTICiFJDyULD5sXnhjZE7USJViUB71ZsQ0ura4XRn6WBJGC2/WyVUiXoxJRxM1yrsBAHd8mDJhUNl3gZvdqGYzUwdFiPObHo2sw0vzD28K0krBxc3fuvsztGrD09CvS2206KVsTEgBkSZAsrcsQgxIMoUUOaORYgBUaaAMncsQgyIMgWUuWMRYkCUKaDMnf8AFYgc2e4UVtUAAAAASUVORK5CYII="/>
                            </defs>
                        </svg>
                    </a>
                </div>
                <div class="text-grey-darker text-center bg-grey-light py-2">
                    <a href="#"
                       class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:border-indigo-200 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                        <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="24" height="24" fill="url(#pattern1)"/>
                            <defs>
                                <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image1" transform="scale(0.01)"/>
                                </pattern>
                                <image id="image1" width="100" height="100"
                                       xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAADCUlEQVR4Xu2dsW4TQRRF3+SDoOAH6MBGgsamAQlItX9B8hfbBCGlw2mSwqFMQwcF+aAMiqWNCHKkm+zkemY5KVJd731zjsdZp5hNwU9VBFJV0zBMIKSyNwFCEFIZgcrGYYcgpDIClY3DDkFIZQQqG4cdUruQ2aJ7l1K8iIinEfGksnmnMs6vlOP31V78OP/Wf/l7Ubd2yHzRHUSKz1NZdQvryBFn56v+zTDrjZD5ssstLGCqM65X/cbF5tds2Z2miNdTXWwT68pxuD7pD9Lsbbefchw1MfTEh8w53qdXi+4op9if+FpbWd5xmi+7nxHxrJWJJz7n5bUQ/phXZBkhFcnY3GWxQ+oyIgsZ7pPrGr+dadQ3PkJMThFiAq3WIEQlZcohxARarUGISsqUQ4gJtFqDEJWUKYcQE2i1BiEqKVMOISbQag1CVFKmHEJMoNUahKikTDmEmECrNQhRSZlyCDGBVmsQopIy5RBiAq3WIEQlZcohxARarUGISsqUQ4gJtFqDEJWUKYcQE2i1BiEqKVMOISbQag1CVFKmHEJMoNUahKikTDmEmECrNQhRSZlyCDGBVmsQopIy5RBiAq3WIEQlZcohxARarUGISsqUQ4gJtFqDEJWUKYcQE2i1BiEqKVMOISbQag1CVFKmHEJMoNWa4kLUYnLjCMiHz4yr4dUqAYSopEw5zlw0gRZrLjmVVCRlih1zbq+JtFKzObf3OsjJ1gquR84MJ1sPNep98iOP9d9e/tbZ7zdSeDqC/Q1x59MRhkl4fojFifb8EMsoBUrUj9cWj7Zt8pFHCCnwri55CYSUpFngWggpALHkJRByB82Xi+75XooPEfGxJPBmr5Xj8Cri4vtJf/HQNYz6o85T3bZi/7pe9Z92I4SHwWzlPuZ2e9wOQQhCHvpR4HwdO8RJW+hCiADJGUGIk7bQtTsh/Lt+m57d3fbyxfAfH7v+YijsXiL3JDDqe8g9u4gLBBAiQHJGEOKkLXQhRIDkjCDESVvoQogAyRlBiJO20IUQAZIzghAnbaHrD9pHq2huB2ikAAAAAElFTkSuQmCC"/>
                            </defs>
                        </svg>

                    </a>
                </div>
                <div class="text-grey-darker text-center bg-grey-light py-2">
                    <a href="#"
                       class="w-16 flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:border-red-200 hover:bg-gray-300 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                        <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="24" height="24" fill="url(#pattern2)"/>
                            <defs>
                                <pattern id="pattern2" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image2" transform="scale(0.01)"/>
                                </pattern>
                                <image id="image2" width="100" height="100"
                                       xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>


                    </a>
                </div>

            </div>
{{--            <div class="flex flex-col ">--}}
{{--                <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">--}}
{{--                    <!-- Sidebar component, swap this element with another sidebar if you like -->--}}
{{--                    <nav class="mt-5 flex-1 px-2 bg-white justify-between">--}}


{{--                        <a href="#" class="group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 rounded-md hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">--}}
{{--                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="url(#pattern0)" d="M0 0h24v24H0z"/><defs><pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1"><use xlink:href="#image0" transform="scale(.01)"/></pattern><image id="image0" width="100" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAFXUlEQVR4Xu2dQXYbNwyGAbp2lk0XVV5X9Q3qniD2CWqfoMrCelnmApFs5wJd5imLyidIeoLYN3BvoKz6rC5iL2NHwz6OpD45iYaACY4wY8x2OCD4f4REgjMkgl2qFEBV3pgzYECUdQIDYkCUKaDMHYsQA6JMAWXuWIQYEGUKKHPHIsSAKFNAmTsWIVqBdAcfHz/yn5562NgJPjr8fPr6+Kcx1d/ng3+2C//d79TybSqXohXC9OITPjofHf9wFTQpI+T54N/dwvu3APB4IZRD3Ht9/OMZVbi5jffU8m0qJ6DV2CE+C3rj4WCygx6CkP/DmEWIAaF2GiGtrhxOf8XD/uU7BPzty8qFKqG2qdHlpLTy4P/CXn/y8cvosAjh9Q8pIABwFYD4FdWfDk86Xaprvf5kBAAP8k8dAMS0qgICiDAqCgxCV17O+a73QIYXs9fE+1JaVQJpojBN99mAKCNoQAwI/O1wus/JAqxDs1nmYeMdAPxSZ/31R4jzB8OjJ6Gh6q/e0eU+FBgyGLVdtQPhjtlrU+IbFYX83pa/DfO02q4qINfew4s3rzrRYe/hy0kXEf4AgO9jnjcJSGhLxTxtualiWlUA8cfDkydHMYEX93v9yyMAHMTKtxOInFYrgXCFo2Z7uXZjgHPfp0QIt01VWhmQCFEDkrvLM+0bEKZguYsbkNwKM+0bEKZguYsbkNwKM+0bEKZguYurAQLMnBM178Mds+cWPGafAkRSq5XzEO/h7M2rzl7M4cX9w5eT94iwGyvfRiCSWsWSi2OA+BIugA/Lt9sxGOF+G4HM2y2iVQwIRWNWmRYDYemwqrABEUidiJCYGzEgBoT3iqpk77uPLdIo6z6GVzxjEdLACDkndICnhDJlkSb9qVPXeJbanqxVRYTgB4efdylvh8y/DTkD8D/HwIQx+63bPFh8DxErv677YT19s7h9S5lbAchpVTUxfEZZT1+aGIZ19T+JAo69B/LHQESbosUQy3kVaW7lPYhpVfuKoahqSoxxf4ZVLeEq0VDUDQMiKme6MQOSrqGoBQMiKme6MQOSrqGoBQMiKme6MQOSrqGohVqASE52vm49fgDwqieGALhNyTyEtklqVZVcHDuc7tFTJxth8wHKzPb8Bjf3m5A62fK34TsWSp5OTKtotjfknmLxTcv3zKxwwztWd8773OSihFZRININbhKQ0HZbD5HuAYn2DEiigNKPGxBpRRPtGZBEAaUfVwYkzBeK6EefAK5LHbO3909dRquqUdb58KQTfTV00SN7/UkYHkfH7C0FIqbVaiD2snXZ10g/WYJa1b6E28YI4bZJ1RIu13npP2muPUqEcNtkQLgUlsobkATxcjxqQHKommDTgCSIl+NRA5JD1QSbBiRBvByPqgECILfl0LJQ3CFiDpE5NilAJLWqSp2E3fpfDE86p7EG9PqTsIFy2MDszv7x33qunUBATCtbMazobdq2+IsFxv3uM/M+96tE5inqZggytc2s1B4hAHDhcHpAeZtFsqFcW/NtYsOOpOUBN3Vd6wCyaJvaj3Y4H+tIg1onEOm2tMKeAVGGMQbk1GF8r5PCl3udPNSzQxZIRbSqAiJ2SImyTpjDHTGtApAwqflqR2ruBI772mUOVdZlU1CrazsUTICiFJDyULD5sXnhjZE7USJViUB71ZsQ0ura4XRn6WBJGC2/WyVUiXoxJRxM1yrsBAHd8mDJhUNl3gZvdqGYzUwdFiPObHo2sw0vzD28K0krBxc3fuvsztGrD09CvS2206KVsTEgBkSZAsrcsQgxIMoUUOaORYgBUaaAMncsQgyIMgWUuWMRYkCUKaDMnf8AFYgc2e4UVtUAAAAASUVORK5CYII="/></defs></svg>--}}
{{--                        </a>--}}



{{--                        <a href="#" class="group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 rounded-md hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">--}}
{{--                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">--}}
{{--                                <rect width="24" height="24" fill="url(#pattern2)"/>--}}
{{--                                <defs>--}}
{{--                                    <pattern id="pattern2" patternContentUnits="objectBoundingBox" width="1" height="1">--}}
{{--                                        <use xlink:href="#image2" transform="scale(0.01)"/>--}}
{{--                                    </pattern>--}}
{{--                                    <image id="image2" width="100" height="100" xlink:href="data:image/png;base64,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"/>--}}
{{--                                </defs>--}}
{{--                            </svg>--}}


{{--                        </a>--}}


{{--                    </nav>--}}
{{--                </div>--}}



{{--            </div>--}}
        </div>


        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                <button class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150" aria-label="Open sidebar">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="pt-2 pb-6 md:py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <div class="md:flex md:items-center md:justify-between">
                            <div class="flex-1 min-w-0">
                                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                                    Movies List
                                </h2>
                            </div>
                        </div>


                        <div class="flex flex-col mt-4">
                            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                                    <table class="min-w-full">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Title
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Copyright
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Director
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Nationality
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Updated By
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Last Update
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Status
                                            </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Awards
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                                The lives of Others
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                2006
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Florian Henckel von Donnersmarck
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Italy
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Matteo SOLARO
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                30-06-2020
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Complete
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center flex justify-center">
                                                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.208 2.44c.25-.768 1.335-.768 1.585 0l1.265 3.894a.833.833 0 00.792.575h4.096c.807 0 1.142 1.034.49 1.509l-3.313 2.406a.833.833 0 00-.303.932l1.265 3.895c.25.768-.63 1.407-1.282.931l-3.313-2.406a.834.834 0 00-.98 0l-3.313 2.406c-.653.476-1.532-.164-1.282-.931l1.265-3.895a.833.833 0 00-.302-.932L2.564 8.418c-.653-.475-.316-1.509.49-1.509H7.15a.833.833 0 00.793-.575L9.208 2.44v0z" stroke="#D69E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                                A Prophet
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                2009
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Jacques Audiard
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                France
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Vioaine SOMJA
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                30-06-2020
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Incomplete
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">

                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                                The lives of Others
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                2006
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Florian Henckel von Donnersmarck
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                Italy
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                -
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                30-06-2020
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                New
                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center flex justify-center">
                                                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.208 2.44c.25-.768 1.335-.768 1.585 0l1.265 3.894a.833.833 0 00.792.575h4.096c.807 0 1.142 1.034.49 1.509l-3.313 2.406a.833.833 0 00-.303.932l1.265 3.895c.25.768-.63 1.407-1.282.931l-3.313-2.406a.834.834 0 00-.98 0l-3.313 2.406c-.653.476-1.532-.164-1.282-.931l1.265-3.895a.833.833 0 00-.302-.932L2.564 8.418c-.653-.475-.316-1.509.49-1.509H7.15a.833.833 0 00.793-.575L9.208 2.44v0z" stroke="#D69E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.208 2.44c.25-.768 1.335-.768 1.585 0l1.265 3.894a.833.833 0 00.792.575h4.096c.807 0 1.142 1.034.49 1.509l-3.313 2.406a.833.833 0 00-.303.932l1.265 3.895c.25.768-.63 1.407-1.282.931l-3.313-2.406a.834.834 0 00-.98 0l-3.313 2.406c-.653.476-1.532-.164-1.282-.931l1.265-3.895a.833.833 0 00-.302-.932L2.564 8.418c-.653-.475-.316-1.509.49-1.509H7.15a.833.833 0 00.793-.575L9.208 2.44v0z" stroke="#D69E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>


        </div>



    </div>



</div>

</body>
</html>
