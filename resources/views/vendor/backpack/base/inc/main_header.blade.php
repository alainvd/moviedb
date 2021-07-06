<header class="{{ config('backpack.base.header_class') }} px-4 flex justify-between align-middle" style="background-color: #2d3748 !important">
    <div class="flex items-center">
        <button class="navbar-toggler sidebar-toggler outline-none focus:outline-none" type="button" data-toggle="sidebar-lg-show">
            <img src="{{ asset('images/vector.svg') }}" alt="Movie DB logo">
        </button>
        <div class=" text-white font-sans font-bold leading-tight tracking-wide text-xl">Media DB</div>
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto ml-3" type="button" data-toggle="sidebar-show" aria-label="{{ trans('backpack::base.toggle_navigation')}}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    @include(backpack_view('inc.menu'))
</header>
